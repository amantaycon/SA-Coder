<?php
require_once "verify_cookies.wma";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Import the necessary libraries 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
//This script will handle login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$err = "";
// check if the user is already logged in

if(isset($_SESSION['back'])){
    
    if($_SESSION['back'] == "main"){
        
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            
        require_once "config.wma";
        $username = "";
        
        
        if($_POST['next'] == "next"){
            if(empty(trim($_POST['email'])))
            {
                $err = "Please enter username or email ";
                $_SESSION['err'] = $err;
                header("location: /accounts/");
                exit;
            }
            else{
                $username = trim($_POST['email']);
            }
            if(empty($err))
            {
                $username = strtolower($username);
                $sql = "";
                $result;
                $flag = "";
                if(strpos($username, "@") !== false && strpos($username, ".") !== false){
                    $sql = "SELECT id, username FROM root_users WHERE email = '$username'";
                    $flag = "email";
                }
                else{
                    $sql = "SELECT id, email FROM root_users WHERE username = '$username'";
                    $flag = "username";
                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    // if found username
                    $_SESSION['id'] = $row["id"];
                    if($flag == "email"){
                        $_SESSION['username'] = $row["username"];
                        $_SESSION['email'] = $username;
                    }
                    else if($flag == "username"){
                        $_SESSION['email'] = $row["email"];
                        $_SESSION['username'] = $username;
                    }
                    $_SESSION['back'] = "authentication";
                    header("location: /accounts/password");
                    exit;
                }
                else{
                    if($flag == "email"){
                        $_SESSION['err'] = "Your email doesn't exist in database";
                        $_SESSION['back'] = "main";
                        $_SESSION['email'] = $username;
                        header("location: /accounts/create_account");
                        exit;
                    }
                    else{
                        $_SESSION['err'] = "please enter your email for create new account";
                        header("location: /accounts/");
                        exit;
                    }
                }
            }  
        }
    
        elseif($_POST['next'] == "create_account"){
            
            if(empty(trim($_POST['email'])))
            {
                $err = "Please enter username or email ";
                $_SESSION['err'] = $err;
                header("location: /accounts/");
                mysqli_close($conn);
                exit;
            }
            else
            {
                $username = $_POST['email'];
                $username = strtolower($username);
                $sql = "";
                $result;
                $flag = "";
                if(strpos($username, "@") !== false && strpos($username, ".com") !== false){
                    $sql = "SELECT id, username FROM root_users WHERE email = '$username'";
                    $flag = "email";
                }
                else{
                    $sql = "SELECT id, email FROM root_users WHERE username = '$username'";
                    $flag = "username";
                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    // if found username
                    $_SESSION['id'] = $row["id"];
                    if($flag == "email"){
                        $_SESSION['username'] = $row["username"];
                        $_SESSION['email'] = $username;
                    }
                    else if($flag == "username"){
                        $_SESSION['email'] = $row["email"];
                        $_SESSION['username'] = $username;
                    }
                    $_SESSION['err'] = "This username is already taken";
                    $_SESSION['back'] = "authentication";
                    header("location: /accounts/password");
                    exit;
                }
                else{
                    if($flag == "email"){
                        $_SESSION['email'] = $username;
                        $_SESSION['back'] = "main";
                        header("location: /accounts/create_account");
                        mysqli_close($conn);
                        exit;
                    }
                    else{
                        $_SESSION['err'] = "please enter your email for create new account";
                        header("location: /accounts/");
                        mysqli_close($conn);
                        exit;
                    }
                    
                }
            }
        }
        else{
            $_SESSION['err'] = "Something went wrong";
            header("location: /accounts/");
            exit;
        }
        mysqli_close($conn);
        }
        else{
            header("location: /accounts/");
            exit;
        }
    }
    
    elseif($_SESSION['back'] == "password"){
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            require_once "config.wma";
            $username = "";
            $password = "";
            if($_POST['next'] == "next"){
                require_once "pass.wma";
                $err = "";
                if(empty(trim($_POST['pass'])))
                {
                    $err = "Please enter your password";
                    $_SESSION['back'] = "authentication";
                    $_SESSION['err'] = $err;
                    header("location: /accounts/password");
                    exit;
                }
                else
                {
                    $password = trim($_POST['pass']);
                }
                if(empty($err))
                {
                    sleep(2);
                    $id = $_SESSION['id'];
                    $sql = "SELECT pass, cookies FROM root_users WHERE id = '$id';";
                    $result = mysqli_query($conn, $sql);
                
                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                    
                        random($password);
                        $x = $GLOBALS['pass2'];
                        $y = $GLOBALS['fpass2'];
                    
                        if(password_verify($x, $row["pass"]) && password_verify($y, $row["cookies"])){
                            $url = "";
                            if(isset($_SESSION['url'])){
                                $url = $_SESSION['url'];
                            }
                            // all session and cookies destroy
                            if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
                            $_SESSION = array();
                            session_destroy();
        
                            if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
                        
                            $_SESSION['next'] = "skip";
                            $_SESSION['id'] = $id;
                            $_SESSION['method'] = "password";
                            if($url != ""){
                                $_SESSION['url'] = $url;
                            }
                            header("location: /accounts/finalauthentication");
                            exit;
                        }
                        else{
                            $_SESSION['err'] = " Wrong password ";
                            $_SESSION['back'] = "authentication";
                            header("location: /accounts/password");
                            exit;
                        }
                    }
                    else{
                        header("location: /accounts/");
                        exit;
                    }
                }  
            }
            elseif($_POST['next'] == "withotp"){
                unset($_SESSION["otp"]);
                $email = $_SESSION['email'];
                require_once "check_email.wma";
                if($otpvalid == true){
                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';

                    // Generate a random OTP
                    $otp = rand(100000, 999999);

                    // Instantiate a new PHPMailer object
                    $mail = new PHPMailer(true);
                    try {
                        // Server settings
                        $mail->SMTPDebug = 0;                               // Enable verbose debug output
                        $mail->isSMTP();                                    // Send using SMTP
                        $mail->Host       = 'smtp.hostinger.com';           // Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                           // Enable SMTP authentication
                        $mail->Username   = 'noreply@sacoder.com';          // SMTP username
                        $mail->Password   = '12345678';    // SMTP password
                        $mail->SMTPSecure = 'ssl';                          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                        $mail->Port       = 465;                            // TCP port to connect to

                        // Recipients
                        $mail->setFrom('noreply@sacoder.com', 'SA Coder');
                        $mail->addAddress($email, 'User');     // Add a recipient
                        $mail->addReplyTo('help@sacoder.com', 'SA Coder');
   

                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Verify your email address';
                        $mail->Body    = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>SA Coder</title></head><body  style="margin: 0; padding: 0;"><center style="margin: 5px; padding: 5px;"><div style="padding: 10px;"><h1 style="color: rgb(255, 123, 0); font-size: 35px;">SA Coder</h1></div><hr style="width: 40vmax; background-color: rgb(255, 123, 0);"><div style="background-color: rgb(232, 253, 255); height: auto; width: 40vmax; margin-bottom: 5px; padding: 10px;"><h1 style="color: rgb(42, 53, 52);">Verify this email is yours</h1><p style="color: rgb(103, 132, 240); font-size: larger;">'.$email.'</p></div><div style="background-color: rgb(232, 253, 255); height: auto; width: 40vmax; padding: 10px;"><p style="font-size: large; color: rgb(42, 53, 52);">This email address was recently provided for a new<a style="color: rgb(255, 123, 0);" href="">SA Coder</a> account. </p><br><br><h1>'. $otp .'</h1><br><br><p style="font-size: large; color: rgb(42, 53, 52);">If this wasn\'t you, please disregard; <br> someone may have mistyped their email address.</p><br><p style="color: rgb(42, 53, 52); font-size: larger;">Website - <a style="color: rgb(103, 132, 240); font-size: larger;"  href="">sacoder.com</a></p></div><hr style="width: 40vmax; background-color: rgb(255, 123, 0);"></center></body></html>';
                    
                        $mail->AltBody = 'Your OTP is: ' . $otp;

                        $mail->send();
                        $otpsent = 'OTP sent successfully on your email';
                        $_SESSION["otp"] = $otp;
                        $_SESSION['otp_time'] = time();
                    } catch (Exception $e) {
                        $otpsent = "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                        echo'<center><input id="fill" type="text" name="otp" placeholder="Enter OTP" required=""></center><center><p class="color_green">⌖'.$otpsent.'</p></center><br><center><div class="button_main"><button class="next1 f_right curser_p" name="next" value="next" onclick="loadanim()">Next</button></div></center>';
                        $_SESSION['back'] = "otp";
                }
                else{
                    unset($_SESSION["otp"]);
                    $_SESSION['back'] = "otp";
                    echo'<center><input id="fill" type="text" name="otp" placeholder="Enter OTP" required=""></center><center><p class="color_green">⌖'.$err.'</p></center><br><center><div class="button_main"><button class="next1 f_right curser_p" name="next" value="next" onclick="loadanim()">Next</button></div></center>';
                }
            }
            else{
                header("location: /accounts/");
                exit;
            }
            mysqli_close($conn);
        }
        else{
            header("location: /accounts/");
            exit;
        }
    }
    
    elseif($_SESSION['back'] == "otp"){
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            
            if($_POST['next'] == "next"){
                $err = "";
                if(empty(trim($_POST['otp'])))
                {
                    $err = "Please enter your otp ";
                    $_SESSION['back'] = "otp_error";
                    $_SESSION['err'] = "Please enter your otp ";
                    header("location: /accounts/onetimepassword");
                    exit;
                }
                else
                {
                    $otp = trim($_POST['otp']);
                }
                if(empty($err))
                {
                    sleep(2);
                    if((time() - $_SESSION['otp_time']) > 400)
                    {
                        $err = "OTP expired again submit your email for new OTP";
                        $_SESSION['err'] = $err ;
                        header("location: /accounts/");
                        exit;
                    }
                    elseif(trim($_POST['otp']) !=  trim($_SESSION["otp"]))
                    {
                        $_SESSION['err'] = "You entered wrong otp" ;
                        $_SESSION['back'] = "otp_error";
                        header("location: /accounts/onetimepassword");
                        exit;
                    }
                    else{
                        $_SESSION['otp_time'] = time() - 500;
                        $_SESSION['err'] = "" ;
                        $_SESSION['back'] = "verified";
                        header("location: /accounts/setpassword");
                        exit;
                    }
                }
                else{
                    header("location: /accounts/");
                    exit;
                }
            }  
        }
        else{
            header("location: /accounts/");
            exit;
        }
    }
    
    else{
        header("location: /accounts/");
        exit;
    }
}

else{
    header("location: /accounts/");
    exit;
}
?>
