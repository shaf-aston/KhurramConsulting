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
if (!isset($data['id'])) {
    $response['message'] = 'Missing image ID';
    echo json_encode($response);
    exit;
}

// Images database file
$imagesDbFile = 'images.json';
$uploadsDir = '../uploads';

// Check if file exists
if (file_exists($imagesDbFile)) {
    // Get images data
    $imagesData = json_decode(file_get_contents($imagesDbFile), true);
    
    if ($imagesData && isset($imagesData['images'])) {
        $imageFound = false;
        $imageFilename = '';
        
        // Find image to delete
        foreach ($imagesData['images'] as $key => $image) {
            if ($image['id'] === $data['id']) {
                $imageFilename = $image['filename'];
                // Remove from array
                unset($imagesData['images'][$key]);
                $imageFound = true;
                break;
            }
        }
        
        // Reindex array
        $imagesData['images'] = array_values($imagesData['images']);
        
        if ($imageFound) {
            // Delete image file
            $imagePath = $uploadsDir . '/' . $imageFilename;
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
            
            // Save updated data
            if (file_put_contents($imagesDbFile, json_encode($imagesData, JSON_PRETTY_PRINT))) {
                $response['success'] = true;
                $response['message'] = 'Image deleted successfully';
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