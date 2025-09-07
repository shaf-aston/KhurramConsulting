<?php
// Include configuration
require_once 'config.php';

// Response array
$response = [
  'success' => false,
  'message' => '',
  'images' => []
];

// Images database file
$imagesDbFile = 'images.json';

// Check if file exists
if (file_exists($imagesDbFile)) {
  // Get images data
  $imagesData = json_decode(file_get_contents($imagesDbFile), true);

  if ($imagesData && isset($imagesData['images'])) {
    // Filter only published images
    $publishedImages = array_filter($imagesData['images'], function ($image) {
      return isset($image['status']) && $image['status'] === 'published';
    });

    // Sort images by upload date (newest first)
    usort($publishedImages, function ($a, $b) {
      return strtotime($b['uploaded_at']) - strtotime($a['uploaded_at']);
    });

    $response['success'] = true;
    $response['images'] = array_values($publishedImages);
  } else {
    $response['message'] = 'No images found or invalid data format';
  }
} else {
  $response['message'] = 'Images database not found';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
