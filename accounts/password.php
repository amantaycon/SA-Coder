<?php
// check if the user is already logged in
require_once "verify_cookies.wma";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username = "";

if(isset($_SESSION['back'])){
    if($_SESSION['back'] == "authentication"){
        if($_SESSION['username'] != ""){
            $username = $_SESSION['username'];
            $_SESSION['back'] = "password";
        }
        else{
            $username = $_SESSION['email'];
            $_SESSION['back'] = "password";
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
<span class=email_sub><?php echo $username; ?></span>
</center><br>
<?php
                        if(isset($_SESSION['err'])){
                            if($_SESSION['err'] !== ""){
                                echo'<center><p style="color: red;">'.$_SESSION['err'].'</p></center>';
                                $_SESSION['err'] = "";
                            }
                        }
                    ?>
<form id=pass_form action=authentication method=post>
<center><input id=fill type=password name=pass placeholder="Enter Your Password" required></center>
<div>
<input class=curser_p id=checkbox onclick=showpassword() type=checkbox><label id=lable_check class=curser_p for=checkbox>Show password</label>
</div>
<br>
<center>
<p class=text>If you have forgotten your password, click on Login with OTP.</p>
</center><br><br>
<center>
<div class=button_main>
<button class="next1 f_right curser_p" name=next value=next onclick=loadanim()>Next</button>
<div id=create_account class=curser_p><span class=text>Login with OTP</span></div>
</div>
</center>
</form>
<br><br><br>
</div>
<div ><ul class="flex_row" style="margin: -10 0;"><li><a class="c_orange" style="margin: 0 10px;" href="/Privacy" target="_blank">Privacy</a></li><li><a class="c_orange" style="margin: 0 10px;" href="/Terms" target="_blank">Term</a></li></ul></div>
</div>
</main>
</div>
</body>
<script src=/js/anim.js></script>
<script>const body2=document.getElementById("main_body1");function loadanim(){va=document.getElementById("fill"),""!=va.value&&(body2.style.display="block")}body2.style.display="none"</script>
<script>function showpassword(){var t=document.getElementById("fill");"password"===t.type?t.type="text":t.type="password"}</script>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js></script>
<script>const withotp=document.getElementById("create_account");withotp.onclick=function(t){t.preventDefault(),body2.style.display="block",$.post("authentication",{next:"withotp"},(function(t,e){document.getElementById("pass_form").innerHTML=t,body2.style.display="none"}))}</script>
</html>
