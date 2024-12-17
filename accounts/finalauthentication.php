<?php
require_once "verify_cookies.wma";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// check if the user is already logged in
require_once "config.wma";
require_once "pass.wma";
$folderPath = 'profilepicture/';
if(isset($_SESSION['next'])){
    $result;
    if($_SESSION['next'] == "next"){
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            random($_SESSION['pass']);
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $passmain = password_hash($x, PASSWORD_DEFAULT);
            $passcookies = password_hash($y, PASSWORD_DEFAULT);
            random("".$y."sa");
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $a = password_hash($y, PASSWORD_DEFAULT);
            $b = password_hash($x.$y, PASSWORD_DEFAULT);
            
            $sql = "UPDATE `root_users` SET `pass` = '$passmain', `cookies` = '$passcookies', `privacy_data` = '$a', `more`='$b' WHERE `root_users`.`id` = '$id';";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM `root_users` WHERE `id` = '$id';";
            $result = mysqli_query($conn, $sql);
        }
        else{
            $email = $_SESSION['email'];
            random($_SESSION['pass']);
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $passmain = password_hash($x, PASSWORD_DEFAULT);
            $passcookies = password_hash($y, PASSWORD_DEFAULT);
            random("".$y."sa");
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $a = password_hash($y, PASSWORD_DEFAULT);
            $b = password_hash($x.$y, PASSWORD_DEFAULT);
            $username1 = str_replace("@gmail.com", "", $email);
            $username1 = '@'.$username1;
            while(1){
                $sql = "SELECT `id` FROM `root_users` WHERE `username` = '$username1';";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $username1 .= '1';
                    continue;
                }
                else{
                    break;
                }
            }

            $sql = "INSERT INTO `root_users` (`email`, `pass`,`username`,`cookies`,`privacy_data`, `themes`, `premium`, `more`) VALUES ('$email','$passmain','$username1','$passcookies', '$a', '0',  '0', '$b');";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM `root_users` WHERE `email` = '$email';";
            $result = mysqli_query($conn, $sql);
            $_SESSION['newuser'] = '1';
        }
    }
    elseif($_SESSION['next'] == "skip"){
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM `root_users` WHERE `id` = '$id';";
            $result = mysqli_query($conn, $sql);
        }
        else{
            $email = $_SESSION['email'];
            random(time());
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $passmain = password_hash($x, PASSWORD_DEFAULT);
            $passcookies = password_hash($y, PASSWORD_DEFAULT);
            random("".$y."sa");
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $a = password_hash($y, PASSWORD_DEFAULT);
            $b = password_hash($x.$y, PASSWORD_DEFAULT);
            $username1 = str_replace("@gmail.com", "", $email);
            $username1 = '@'.$username1;
            while(1){
                $sql = "SELECT `id` FROM `root_users` WHERE `username` = '$username1';";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $username1 .= '1';
                    continue;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO `root_users` (`email`, `pass`,`username`,`cookies`,`privacy_data`, `themes`, `premium`, `more`) VALUES ('$email','$passmain','$username1','$passcookies', '$a', '0',  '0', '$b');";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM `root_users` WHERE `email` = '$email';";
            $result = mysqli_query($conn, $sql);
            $_SESSION['newuser'] = '1';
        }
    }
    elseif($_SESSION['next'] == "google"){
        $email = $_SESSION['email'];
        $first = $_SESSION['first'];
        $last = $_SESSION['last'];
        $plink = $_SESSION['plink'];
        $sql = "SELECT * FROM `root_users` WHERE `email` = '$email';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){
            $_SESSION['next'] = "finise";
        }
        else{
            random(time());
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $passmain = password_hash($x, PASSWORD_DEFAULT);
            $passcookies = password_hash($y, PASSWORD_DEFAULT);
            random("".$y."sa");
            $x = $GLOBALS['pass2'];
            $y = $GLOBALS['fpass2'];
            $a = password_hash($y, PASSWORD_DEFAULT);
            $b = password_hash($x.$y, PASSWORD_DEFAULT);
            $file = $folderPath . uniqid() . '.png';
            file_put_contents($file, file_get_contents($plink));
            $plink = $file;
            $username1 = str_replace("@gmail.com", "", $email);
            $username1 = '@'.$username1;
            while(1){
                $sql = "SELECT `id` FROM `root_users` WHERE `username` = '$username1';";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $username1 .= '1';
                    continue;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO `root_users` (`email`, `pass`,`username`, `cookies`,`privacy_data`,`first`, `last`, `p_link`, `themes`, `premium`, `more`) VALUES ('$email', '$passmain','$username1', '$passcookies', '$a', '$first', '$last', '$plink', '0',  '0', '$b');";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM `root_users` WHERE `email` = '$email';";
            $result = mysqli_query($conn, $sql);
            $_SESSION['newuser'] = '1';
        }
    }
    
    if (mysqli_num_rows($result) > 0) {
        $f = "";
        $l = "";
        $p = "";
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        if($row["first"] == ""){
            $f = "f";
        }
        if($row["p_link"] == ""){
            $p = "p";
        }
        if($_SESSION['next'] == "finise"){
            $first = $_SESSION['first'];
            $last = $_SESSION['last'];
            $plink = $_SESSION['plink'];
            if($f == "f"){
                $sql = "UPDATE `root_users` SET `first` = '$first', `last` = '$last' WHERE `root_users`.`id` = '$id';";
                $result = mysqli_query($conn, $sql);
            }
            if($p == "p"){
                $file = $folderPath . uniqid() . '.png';
                file_put_contents($file, file_get_contents($plink));
                $plink = $file;
                $sql = "UPDATE `root_users` SET `p_link` = '$plink' WHERE `root_users`.`id` = '$id';";
                $result = mysqli_query($conn, $sql);
            }
            
            $sql = "SELECT * FROM `root_users` WHERE `id` = '$id';";
            $result = mysqli_query($conn, $sql);
        }
        $temp = "";
        if(isset($_SESSION['method'])){
            $temp = $_SESSION['method'];
        }
        $nuc = '0';
        if(isset($_SESSION['newuser'])){
            $nuc = $_SESSION['newuser'];
        }
        $_SESSION = array();
        session_destroy();
        // all session and cookies set
        if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
        $_SESSION['id'] = $row["id"];
        $_SESSION['email'] = $row["email"];
        $_SESSION['server_username'] = "yes";
        $_SESSION['first'] = $row["first"];
        $_SESSION['last'] = $row["last"];
        $_SESSION['plink'] = $row["p_link"];
        $_SESSION['bio'] = $row["bio"];
        if($nuc == '1'){
            $_SESSION['newuser'] = $row["username"];
            $_SESSION['username'] = '';
        }
        else{
            $_SESSION['username'] = $row["username"];
        }
        
        if($url != ""){
            $_SESSION['url'] = $url;
        }
        if($temp == "back"){
            exit;
        }
        else{
        header("location: /accounts/profile");
        exit;
        }
    }
    else{
        
        if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
        $_SESSION = array();
        session_destroy();
        header("location: /accounts/");
        exit;
    }
}
else{
    header("location: /accounts/");
    exit;
}
?>