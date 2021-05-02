<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('config.php');

include_once('post.php');

$post = new Post($db);
$data = json_decode(file_get_contents("php://input"));

$post->category = $data->category;
$f_category = $post->category;

$result = $post->feed($f_category);
$num = $result->rowCount();
$response = array();

if($num >0) {
    $response['data'] = array();
    $response['result'] = true;
    $response['messages'] = array();
    $i=0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $response['data'][$i]['post_id'] = $row['post_id'];
        $response['data'][$i]['group_id'] = $row['group_id'];
        $response['data'][$i]['creator_id'] = $row['creator_id'];
        $response['data'][$i]['category'] = $row['category'];
        $response['data'][$i]['platform'] = $row['platform'];
        $response['data'][$i]['seek_date'] = $row['seek_date'];
        $response['data'][$i]['title'] = $row['title'];
        $response['data'][$i]['sub_title'] = $row['sub_title'];
        $response['data'][$i]['member_count'] = $row['member_count'];
        $i++;
    }
    echo json_encode($response);
}else{
    $response['result'] = false;
    $response['data'] = array();
    $response['messages'] = array('No element in this category');
    echo json_encode($response);
}

?>