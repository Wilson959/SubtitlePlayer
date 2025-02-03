<?php
$url = 'https://tommy0412.great-site.net/SubtitlePlayer/upload_subtitle.php';
$token = 'dfdsgfgds455dgdfgdfhfd54564dgdfgdgfdg8886fgfgh564gg';
$filePath = 'file.srt';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token
]);

$cfile = new CURLFile($filePath, 'text/plain', basename($filePath));
$postFields = [
    'file' => $cfile
];
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    echo 'Response: ' . $response;
}

curl_close($ch);
?>
