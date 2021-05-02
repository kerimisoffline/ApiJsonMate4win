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
$post->g_title = $data->title;
$post->g_sub_title = $data->sub_title;
$post->g_creator_id = $data->creator_id;
$post->g_description = $data->description;
$post->g_platform = $data->group_platform;
$post->g_categories = $data->categories;
$post->g_email = $data->email;
$post->g_telegram = $data->telegram;
$post->g_dc_adress = $data->dc_adress;
$post->g_ts_adress = $data->ts_adress;
$post->g_skype_adress = $data->skype_adress;
$post->g_insta_adress = $data->insta_adress;
$post->g_member_count = $data->member_count;
$post->g_situation = $data->situation;
$post->g_country = $data->country;
$post->g_city = $data->city;

if(!empty($data->command)){
    if(!empty($post->g_id)) {
        $result = $post->update_post($post->g_id,$post->g_situation);

        if($result== 1){
            $json['result'] = true;
            $json['messages'] = array('Post situation successfuly updated');
            $json['data'] = array();
    
        // LOGGED ACTIVITY TRIGGER
        } else {
            $json['result'] = true;
            $json['messages'] = array('Post situation cannot updated');
            $json['data'] = array();
        }
        echo json_encode($json);
    }

} else { 
    if(!empty($post->g_id)){
    
        $result = $post->update_group($post->g_id,$post->g_title,$post->g_sub_title,$post->g_member_count,$post->g_situation,$post->g_country,$post->g_city,$post->g_ts_adress,$post->g_description,$post->g_creator_id,$post->g_platform,$post->g_categories,$post->g_email,$post->g_telegram,$post->g_dc_adress,$post->g_skype_adress,$post->g_insta_adress);
    
        if($result== 1){
            $json['result'] = true;
            $json['messages'] = array('Group successfuly updated');
            $json['data'] = array();
    
        // LOGGED ACTIVITY TRIGGER
        } else {
            $json['result'] = true;
            $json['messages'] = array('Group cannot updated');
            $json['data'] = array();
        }
        echo json_encode($json);
    
    } else {
        $json['result'] = false;
        $json['messages'] = array('You must fill group id');
        $json['data'] = array();
        echo json_encode($json);
    }
}


?>