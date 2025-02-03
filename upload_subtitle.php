<?php
header('Content-Type: application/json');

$authHeader = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';
$validToken = 'dfdsgfgds455dgdfgdfhfd54564dgdfgdgfdg8886fgfgh564gg';

if ($authHeader !== 'Bearer ' . $validToken) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$uploadDir = 'subtitles/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

function getUniqueFilename($uploadDir, $fileName) {
    $filePath = $uploadDir . $fileName;
    if (file_exists($filePath)) {
        return false;
    }
    return $fileName;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
		if ($_FILES['file']['size'] > 1048576) { // 1 MB = 1048576 bytes
            echo json_encode(['error' => 'File size exceeds the 1 MB limit.']);
            exit;
        }
		
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];

        $fileInfo = pathinfo($fileName);
        $extension = strtolower($fileInfo['extension']);

        if ($extension !== 'srt') {
            echo json_encode(['error' => 'Only .srt files are allowed.']);
            exit;
        }

        $uniqueFileName = getUniqueFilename($uploadDir, $fileName);
        if ($uniqueFileName === false) {
            echo json_encode(['path' => '/subtitles/' . $fileName]);
            exit;
        }
		
        $mimeType = mime_content_type($fileTmpPath);
        if ($mimeType !== 'text/plain') {
            echo json_encode(['error' => 'Invalid file type. Only SRT subtitle files are allowed.']);
            exit;
        }
		
        $filePath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            echo json_encode(['path' => '/subtitles/' . $uniqueFileName]);
        } else {
            echo json_encode(['error' => 'Failed to move uploaded file.']);
        }
    } else {
        echo json_encode(['error' => 'No file uploaded or upload error.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>