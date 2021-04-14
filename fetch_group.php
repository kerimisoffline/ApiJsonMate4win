<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('config.php');

include_once('post.php');


$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$g_id = $post->id;
$result = $post->fetch_group($g_id);
$num = $result->rowCount();

if($num>0){
    $response['result'] = true;
    $response['messages'] = array();
    $j=0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $post->fetch_id = $row['id'];
        //echo "$post->fetch_id";
        $post->get_group_from_group_id($post->fetch_id);
        $res = $post->fetch_group_member($post->fetch_id);
    $t=0;
    while($col = $res->fetch(PDO::FETCH_ASSOC)){
        $member[$t] = array(
            'id' => $col['id'],
            'first_name' => $col['first_name'],
            'last_name' => $col['last_name'],
            'nick_name' => $col['nick_name'],
            'gender' => $col['gender'],
            'country' => $col['country'],
            'city' => $col['city'],
            'bio' => $col['bio'],
            'mobile_number' => $col['mobile_number'],
            'email' => $col['email'],
            'dc_adress' => $col['dc_adress'],
            'has_approved_terms' => $col['has_approved_terms'],
        );
        $t++;
    }
        $response['data'][$j] = array(
            'id' => $post->g_id,
            'title' => $post->g_title,
            'sub_title' => $post->g_sub_title,
            'creator_id' => $post->g_creator_id,
            'description' => $post->g_description,
            'email' => $post->g_email,
            'country' => $post->g_country,
            'city' => $post->g_city,
            'telegram' =>$post->g_telegram,
            'dc_adress' => $post->g_dc_adress,
            'insta_adress' =>$post->g_insta_adress,
            'ts_adress' =>$post->g_ts_adress,
            'skype_adress' =>$post->g_skype_adress,
            'group_platform' =>$post->g_group_platform,
            'categories' =>$post->g_categories,
            'member_count' =>$post->g_member_count,
            'members' => $member,
        );
        $j++;
    }
} else {
    $response['result'] = false;
    $response['messages'] = array('There is no group you in');
    $response['data'] = array();
}
echo json_encode($response);
?>