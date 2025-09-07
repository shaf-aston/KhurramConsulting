<?php
// Include configuration
require_once 'config.php';

// Create uploads directory if it doesn't exist
$uploadsDir = '../uploads';
if (!file_exists($uploadsDir)) {
  mkdir($uploadsDir, 0755, true);
}

// Create or open the images database file
$imagesDbFile = 'images.json';
if (!file_exists($imagesDbFile)) {
  file_put_contents($imagesDbFile, json_encode(['images' => []]));
}

// Response array
$response = [
  'success' => false,
  'message' => '',
  'image_id' => null
];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate inputs
  if (empty($_POST['title'])) {
    $response['message'] = 'Image title is required';
    echo json_encode($response);
    exit;
  }

  if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $response['message'] = 'Image upload failed: ' . ($_FILES['image']['error'] ?? 'Unknown error');
    echo json_encode($response);
    exit;
  }

  // Get file information
  $file = $_FILES['image'];
  $fileName = $file['name'];
  $fileTmpPath = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileType = $file['type'];

  // Validate file type
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
  if (!in_array($fileType, $allowedTypes)) {
    $response['message'] = 'Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.';
    echo json_encode($response);
    exit;
  }

  // Validate file size (max 5MB)
  $maxSize = 5 * 1024 * 1024; // 5MB in bytes
  if ($fileSize > $maxSize) {
    $response['message'] = 'File is too large. Maximum size is 5MB.';
    echo json_encode($response);
    exit;
  }

  // Generate unique filename
  $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
  $newFileName = uniqid() . '.' . $fileExtension;
  $uploadFilePath = $uploadsDir . '/' . $newFileName;

  // Move uploaded file
  if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
    // Get current images data
    $imagesData = json_decode(file_get_contents($imagesDbFile), true);

    // Create new image entry
    $newImage = [
      'id' => uniqid(),
      'title' => $_POST['title'],
      'description' => $_POST['description'] ?? '',
      'filename' => $newFileName,
      'original_filename' => $fileName,
      'status' => $_POST['status'] ?? 'draft',
      'uploaded_at' => date('Y-m-d H:i:s')
    ];

    // Add to images array
    $imagesData['images'][] = $newImage;

    // Save updated data
    if (file_put_contents($imagesDbFile, json_encode($imagesData, JSON_PRETTY_PRINT))) {
      $response['success'] = true;
      $response['message'] = 'Image uploaded successfully';
      $response['image_id'] = $newImage['id'];
    } else {
      $response['message'] = 'Failed to save image data';
      // Remove uploaded file if data couldn't be saved
      @unlink($uploadFilePath);
    }
  } else {
    $response['message'] = 'Failed to move uploaded file';
  }
} else {
  $response['message'] = 'Invalid request method';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
