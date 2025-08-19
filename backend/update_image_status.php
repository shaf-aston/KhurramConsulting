<?php
// Include configuration
require_once 'config.php';

// Response array
$response = [
    'success' => false,
    'message' => ''
];

// Get JSON data from request
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if (!isset($data['id']) || !isset($data['status'])) {
    $response['message'] = 'Missing required parameters';
    echo json_encode($response);
    exit;
}

// Validate status
if (!in_array($data['status'], ['draft', 'published'])) {
    $response['message'] = 'Invalid status value';
    echo json_encode($response);
    exit;
}

// Images database file
$imagesDbFile = 'images.json';

// Check if file exists
if (file_exists($imagesDbFile)) {
    // Get images data
    $imagesData = json_decode(file_get_contents($imagesDbFile), true);
    
    if ($imagesData && isset($imagesData['images'])) {
        $imageFound = false;
        
        // Update image status
        foreach ($imagesData['images'] as &$image) {
            if ($image['id'] === $data['id']) {
                $image['status'] = $data['status'];
                $imageFound = true;
                break;
            }
        }
        
        if ($imageFound) {
            // Save updated data
            if (file_put_contents($imagesDbFile, json_encode($imagesData, JSON_PRETTY_PRINT))) {
                $response['success'] = true;
                $response['message'] = 'Image status updated successfully';
            } else {
                $response['message'] = 'Failed to save image data';
            }
        } else {
            $response['message'] = 'Image not found';
        }
    } else {
        $response['message'] = 'No images found or invalid data format';
    }
} else {
    $response['message'] = 'Images database not found';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);