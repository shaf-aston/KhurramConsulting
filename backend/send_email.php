<?php

// Add error logging to a file
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log.txt');

// Log unexpected errors
set_error_handler(function ($severity, $message, $file, $line) {
  error_log("Error: [$severity] $message in $file on line $line");
});

set_exception_handler(function ($exception) {
  error_log("Uncaught Exception: " . $exception->getMessage());
});

// Security headers
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// CORS headers for frontend integration
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

function sendJsonResponse($success, $message, $data = null)
{
  echo json_encode([
    'success' => $success,
    'message' => $message,
    'data' => $data,
    'timestamp' => date('Y-m-d H:i:s')
  ]);
  exit();
}

function validateInput($data)
{
  $errors = [];

  // Validate name
  if (empty($data['name']) || strlen(trim($data['name'])) < 2) {
    $errors[] = 'Name must be at least 2 characters long';
  }

  // Validate email
  if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email address is required';
  }

  // Validate message
  if (empty($data['message']) || strlen(trim($data['message'])) < 10) {
    $errors[] = 'Message must be at least 10 characters long';
  }

  return $errors;
}

function saveToFile($name, $email, $message)
{
  $data = [
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
  ];

  $jsonData = json_encode($data, JSON_PRETTY_PRINT) . "\n";

  // Save to a file instead of sending email
  $filename = __DIR__ . '/contact_submissions.json';
  file_put_contents($filename, $jsonData, FILE_APPEND | LOCK_EX);

  return true;
}

function sendEmail($name, $email, $message)
{
  // For local development, save to file instead of sending email
  if (saveToFile($name, $email, $message)) {
    return true;
  }

  return false;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  sendJsonResponse(false, 'Only POST method allowed');
}

try {
  // Get and sanitize input
  $input = json_decode(file_get_contents('php://input'), true);
  if (!is_array($input)) {
    $input = $_POST;
  }

  $name = htmlspecialchars(trim($input['name'] ?? ''), ENT_QUOTES, 'UTF-8');
  $email = filter_var(trim($input['email'] ?? ''), FILTER_SANITIZE_EMAIL);
  $message = htmlspecialchars(trim($input['message'] ?? ''), ENT_QUOTES, 'UTF-8');

  // Validate input
  $validationErrors = validateInput(['name' => $name, 'email' => $email, 'message' => $message]);
  if (!empty($validationErrors)) {
    sendJsonResponse(false, 'Validation failed', ['errors' => $validationErrors]);
  }

  // Send email (save to file for local development)
  if (sendEmail($name, $email, $message)) {
    sendJsonResponse(true, 'Thank you for your message! We will get back to you soon.');
  } else {
    sendJsonResponse(false, 'Failed to send your message. Please try again later.');
  }
} catch (Exception $e) {
  sendJsonResponse(false, 'An unexpected error occurred. Please try again later.', ['error' => $e->getMessage()]);
}
