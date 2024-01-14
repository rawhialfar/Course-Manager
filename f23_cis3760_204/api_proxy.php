<?php
header("Access-Control-Allow-Origin: *"); // Allow cross-origin requests

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['url'])) {
        $url = urldecode($_GET['url']);
        $response = file_get_contents($url);
        echo $response;
    } else {
        echo 'Invalid request';
    }
}
?>