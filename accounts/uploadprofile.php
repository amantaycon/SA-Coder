<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['server_username']) && isset($_COOKIE['server_username'])){if($_SESSION['server_username'] == "yes" && $_COOKIE['server_username'] == "yes"){if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_SESSION['id'];
    require_once "config.wma";
    
    
    $folderPath = 'profilepicture/';
    $image_parts = explode(";base64,", $_POST['image']);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = $folderPath . uniqid() . '.png';
    file_put_contents($file, $image_base64);
    
    $sql = "SELECT p_link FROM `root_users` WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(file_exists($row['p_link'])){
        clearstatcache();
        unlink($row['p_link']);
    }
    
    $sql = "UPDATE `root_users` SET `p_link` = '$file' WHERE `root_users`.`id` = '$id';";
    $result = mysqli_query($conn, $sql);
    $sql = "SELECT p_link FROM `root_users` WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['plink'] = $row["p_link"];
    mysqli_close($conn); 
    echo json_encode(["image uploaded successfully."]);
    
 }}} ?>