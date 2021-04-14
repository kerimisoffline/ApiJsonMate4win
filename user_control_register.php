<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('config.php');

include_once('post.php');


$post = new Post($db);
$result = $post->read_user();
$num = $result->rowCount();

if(isset($_POST['email'],$_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if(!empty($email) && !empty($pass)){
        $encrypted_password = md5($pass);
        $post-> register($email,$encrypted_password);
    } else {
        echo json_encode("You must fill both fields ");
    }
}

?>