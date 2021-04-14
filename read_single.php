<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('config.php');

include_once('post.php');


$post = new Post($db);

$result = $post->read_single();
$num = $result->rowCount();

$post->id = isset($_GET['id']) ? $_GET['id'] : die();
$post->read_single();


$response['result'] = "";
$response['data'] = array(
    'id' => $post->id,
    'title' => $post->title,
);
    
    echo json_encode($response);
?>