<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('config.php');

include_once('post.php');


$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));


$post->email = $data->email;

$post->logged();
if(empty($post->id)){
$response['result'] = false;
$response['messages'] = array('Not logged in');
$response['data'] = array();
} else {
$response['result'] = true;
$response['messages'] = array();
$response['data'] = array(
    'id' => $post->id,
    'first_name' => $post->first_name,
    'last_name' => $post->last_name,
    'nick_name' => $post->nick_name,
    'gender' => $post->gender,
    'country' => $post->country,
    'city' => $post->city,
    'bio' => $post->bio,
    'mobile_number' => $post->mobile_number,
    'email' => $post->email,
    'dc_adress' => $post->dc_adress,
    'has_approved_terms' => $post->has_approved_terms,
);
}
echo json_encode($response);
?>