<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('config.php');

include_once('post.php');

$post = new Post($db);

$result = $post->read_img();
$num = $result->rowCount();
$response = array();

if($num >0) {

    $response['result'] = "";
    $response['data'] = array();
    $i=0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $response['data'][$i]['id'] = $row['id'];
        $response['data'][$i]['img'] = $row['img'];
        $response['data'][$i]['platform'] = $row['platform'];
        $i++;
    }
    echo json_encode($response);
}else{
    echo json_encode(array('message' => 'Post bulunamadı.'));
}

?>