<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('config.php');

include_once('post.php');


$post = new Post($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));


$post->g_id = $data->group_id;

if(!empty($post->g_id)){
    $result = $post->delete_group($post->g_id);
    if($result== 1){
        //$post->add_new_group_member($post->g_creator_id);
        
        $json['result'] = true;
        $json['messages'] = array('Group successfuly deleted');
        $json['data'] = array();

    // LOGGED ACTIVITY TRIGGER
    } else {
        $json['result'] = true;
        $json['messages'] = array('Group cannot deleted');
        $json['data'] = array();
    }
    echo json_encode($json);

} else {
    $json['result'] = false;
    $json['messages'] = array('Deleting Problems');
    $json['data'] = array();
    echo json_encode($json);
}

?>