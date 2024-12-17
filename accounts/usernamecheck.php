<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['server_username'])&&isset($_COOKIE['server_username'])){if($_SESSION['server_username'] == "yes"&&$_COOKIE['server_username'] == "yes"){if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    require_once "config.wma";
    if($username != "" && !preg_match('/\s/', $username)){
        $username = preg_replace('/\s+/', '', $username);
        $username = trim($username);
        if($username[0] != '@')
        $username = "@".$username;
        $username = strtolower($username);
        $sql = "SELECT * FROM `root_users` WHERE username = '$username';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            echo "no";
        }
        else{
            if(strlen($username) <= 2){
                echo "no";
            }
            else{
                echo "yes";
            }
        }
    }
    else{
        echo "no";
    }
       mysqli_close($conn); 
        
 }}} ?>