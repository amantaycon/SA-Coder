<?php
require_once "verify_cookies.wma";
//This script will handle login

// check if the user is already logged in
require_once("config_google.wma");

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);


        $_SESSION['access_token'] = $token['access_token'];


        $google_service = new Google_Service_Oauth2($google_client);


        $data = $google_service->userinfo->get();


        if (!empty($data['given_name'])) {
            $_SESSION['first'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['last'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['email'] = $data['email'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['plink'] = $data['picture'];
        }
    }
}

if (isset($_SESSION['access_token'])) {
    $_SESSION['next'] = "google";
    header("location: /accounts/finalauthentication");
    exit;
}
else{
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $_SESSION = array();
    session_destroy();
        
    $_SESSION['err'] = "something wrong";
    header("location: /accounts/");
    exit;
}

?>