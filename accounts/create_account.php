<?php
require_once "verify_cookies.wma";
// Import the necessary libraries 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    
//This script will handle login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$err = "";

if(isset($_SESSION['back'])){
    if($_SESSION['back'] == "main"){
        unset($_SESSION["otp"]);
        $err = $_SESSION['err'];
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
                    $mail->Password   = 'ba&b8984y*&%*^kjaJHyujf45';    // SMTP password
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
                    $_SESSION['back'] = "otp";
                } catch (Exception $e) {
                        $otpsent = "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        else{
            unset($_SESSION["otp"]);
            $otpsent = $err;
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

<html lang=en>
<?php
include("C:/xampp/htdocs/accounts/header.wma");
?>
<body>
<?php
    include("C:/xampp/htdocs/accounts/anim.wma");
    ?>
<div id=main>
<main>
<div id=login_bar1>
<div id=container>
<center><img src=/picture/logo.png id=logo>
<h1 id=logo_name>SA Coder</h1>
</center>
<center class=email_main onclick=history.back()>
<span class=email_sub><?php echo $_SESSION['email']; ?></span>
</center><br>
<?php
                        if(isset($_SESSION['err'])){
                            if($_SESSION['err'] != ""){
                                echo'<center><p style="color: red;">'.$_SESSION['err'].'</p></center>';
                                $_SESSION['err'] = "";
                            }
                        }
                    ?>
<form action=authentication method=post>
<center><input id=fill name=otp placeholder="Enter OTP" required></center><center><p class=color_green>⌖<?php echo $otpsent ?></p></center>
<br>
<center>
<div class=button_main>
<button class="next1 f_right" name=next value=next onclick=loadanim()>Next</button>
</div>
</center>
</form>
<br><br>
</div>
<div ><ul class="flex_row" style="margin: -10 0;"><li><a class="c_orange" style="margin: 0 10px;" href="/Privacy" target="_blank">Privacy</a></li><li><a class="c_orange" style="margin: 0 10px;" href="/Terms" target="_blank">Term</a></li></ul></div>
</div>
</main>
</div>
<script src=/js/anim.js></script>
<script>const body2=document.getElementById("main_body1");function loadanim(){va=document.getElementById("fill"),""!=va.value&&(body2.style.display="block")}body2.style.display="none"</script>
</body>
</html>
