<?php

$con = mysqli_connect("localhost","root","root","API_DATA");
$response = array();
if($con){
    $sql = "select * from category";
    $result = mysqli_query($con,$sql);
    if($result){
        $response['result'] = "";
        header("Content-Type: JSON");
        $i=0;
        while($row = mysqli_fetch_assoc($result)){
            $response['data'][$i]['id'] = $row['id'];
            $response['data'][$i]['title'] = $row['title'];
            $i++;
        }
        //array_push($post_arr, $response);
        echo json_encode($response);
    }
}
else{
    echo "Database Connection Failed";
}
?>