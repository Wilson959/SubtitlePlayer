<?php
include 'url.php';
$apiUrl = $url . 'upload_subtitle.php';
$authToken = 'dfdsgfgds455dgdfgdfhfd54564dgdfgdgfdg8886fgfgh564gg';
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $authToken
]);

$fileData = $_FILES['file'];
$uploadFile = curl_file_create($fileData['tmp_name'], $fileData['type'], $fileData['name']);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $uploadFile]);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
}
curl_close($ch);

header('Content-Type: application/json');
echo $response;
?>