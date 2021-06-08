<?php
$postData = file_get_contents('php://input');
$json = json_decode($postData);

if ($json->status == 'DONE') {
    // handle deposit result
}

// echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>