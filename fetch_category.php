<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('config.php');

include_once('post.php');

$post = new Post($db);
$data = json_decode(file_get_contents("php://input"));

$post->platform = $data->platform;
$f_platform = $post->platform;

$result = $post->fetch_category($f_platform);
$num = $result->rowCount();
$response = array();

if($num >0) {
    $response['data'] = array();
    $response['result'] = true;
    $response['messages'] = array();
    $i=0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $response['data'][$i]['id'] = $row['id'];
        $response['data'][$i]['title'] = $row['title'];
        $response['data'][$i]['img'] = $row['img'];
        $i++;
    }
    echo json_encode($response);
}else{
    $response['result'] = false;
    $response['data'] = array();
    $response['messages'] = array('No element in this platform');
    echo json_encode($response);
}

?>