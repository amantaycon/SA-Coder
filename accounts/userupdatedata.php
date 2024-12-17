<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['server_username'])&&isset($_COOKIE['server_username'])){if($_SESSION['server_username'] == "yes"&&$_COOKIE['server_username'] == "yes"){if($_SERVER['REQUEST_METHOD'] == "POST"){
    require_once "config.wma";
    $id = $_SESSION['id'];
    if(isset($_SESSION['newuser'])){
        $username = $_SESSION['newuser'];
        unset($_SESSION['newuser']);
        if(isset($_POST['username']) && $_POST['username'] != "" && strlen($_POST['username']) > 2){
            $username = $_POST['username'];
        }
        $username = preg_replace('/\s+/', '', $username);
        if($username[0] != '@'){
            $username = "@".$username;
        }
        $username = strtolower($username);;
        $ft = 0;
        if($username != $_SESSION['username']){
            $sql = "SELECT * FROM `root_users` WHERE username = '$username';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 1) {
                echo "sorry this username is already taken";
                $ft = 1;
                exit;
            }
        }
        if($ft == 0){
            $sql = "UPDATE `root_users` SET `username` = '$username' WHERE `root_users`.`id` = '$id';";
            $result = mysqli_query($conn, $sql);
            $_SESSION['username'] = $username;
            exit;
        }
    }
    $first = $_POST['fname'];
    $last = $_POST['lname'];
    $bio = $_POST['bio'];
    if($first != ""){
        $sql = "UPDATE `root_users` SET `first` = '$first' WHERE `root_users`.`id` = '$id';";
        $result = mysqli_query($conn, $sql);
        $_SESSION['first'] = $first;
    }
    if($last != ""){
        $sql = "UPDATE `root_users` SET `last` = '$last' WHERE `root_users`.`id` = '$id';";
        $result = mysqli_query($conn, $sql);
        $_SESSION['last'] = $last;
    }
    if($bio != ""){
        $sql = "UPDATE `root_users` SET `bio` = '$bio' WHERE `root_users`.`id` = '$id';";
        $result = mysqli_query($conn, $sql);
        $_SESSION['bio'] = $bio;
    }
       mysqli_close($conn); 
        
 }}} ?>