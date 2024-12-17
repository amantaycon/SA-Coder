<?php
$url = '/';
if(isset($_GET['redirect'])){
    $url = $_GET['redirect'];
}
if (session_status() == PHP_SESSION_NONE) {
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
}
$_SESSION = array();
session_destroy();
setcookie("con1", "", time() - 2500, "/", "sacoder.com", true, true);
setcookie("con2", "", time() - 2500, "/", "sacoder.com", true, true);
setcookie("con3", "", time() - 2500, "/", "sacoder.com", true, true);
setcookie("con4", "", time() - 2500, "/", "sacoder.com", true, true);
setcookie('server_username', "no", time() - 2500, "/", "sacoder.com", true, true);
header("location: $url");
?>