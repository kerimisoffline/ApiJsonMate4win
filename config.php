<?php

try{
    $db_user = 'root';
    $db_password = 'root';
    $db_servername= 'localhost';
    $db_name = 'API_DATA';
    $charset = 'utf8mb4';
    $dsn = 'mysql:host=localhost;dbname=API_DATA;charset=utf8';


    $db = new PDO($dsn,$db_user,$db_password);

    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}
?>