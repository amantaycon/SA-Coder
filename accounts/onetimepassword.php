<?php
require_once "verify_cookies.wma";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$err = "";

if(isset($_SESSION['back'])){
    if($_SESSION['back'] === "otp_error"){
        $err = $_SESSION['err'];
        $_SESSION['back'] = "otp";
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

if(!empty($err)){
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
                            if($_SESSION['err'] !== ""){
                                echo'<center><p style="color: red;">'.$_SESSION['err'].'</p></center>';
                                $_SESSION['err'] = "";
                            }
                        }
                    ?>
<form action=authentication method=post>
<center><input id=fill name=otp placeholder="Enter OTP" required></center>
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
<?php
}
else{
    header("location: /accounts/");
        exit;
}
?>