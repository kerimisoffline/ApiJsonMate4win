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
$post->m_id = $data->member_id;

if(!empty($data->command)){
    $result = $post->delete_pending($post->g_id,$post->m_id);
    
    if($result== 1){
        $json['result'] = true;
        $json['messages'] = array('Pending successfuly deleted');
        $json['data'] = array();

    // LOGGED ACTIVITY TRIGGER
    } else {
        $json['result'] = true;
        $json['messages'] = array('Pending cannot deleted');
        $json['data'] = array();
    }
    echo json_encode($json);
}
else if(!empty($post->g_id) && !empty($post->m_id)){
    $result = $post->add_pending($post->g_id,$post->m_id);
    
    if($result== 1){
        $json['result'] = true;
        $json['messages'] = array('Pending successfuly added');
        $json['data'] = array();

    // LOGGED ACTIVITY TRIGGER
    } else {
        $json['result'] = true;
        $json['messages'] = array('Pending cannot added');
        $json['data'] = array();
    }
    echo json_encode($json);

} else {
    $json['result'] = false;
    $json['messages'] = array('You must fill both group id and member id');
    $json['data'] = array();
    echo json_encode($json);
}

?>