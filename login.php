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
$post->password = $data->password;

$email = $post->email;
$pass = $post->password;

if(!empty($email) && !empty($pass)){
    $encrypted_password = md5($pass);
    $post-> login($email,$encrypted_password);
} else {
    $json['result'] = false;
    $json['messages'] = array('You must fill both fields');
    $json['data'] = array();
    echo json_encode($json);
}

?>