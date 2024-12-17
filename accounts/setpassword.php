<?php
require_once "verify_cookies.wma";
$username = "";
// check if the user is already logged in

if(isset($_SESSION['back'])){
    if($_SESSION['back'] == "verified"){
        if(isset($_SESSION['id'])){
            $username = $_SESSION['email'];
            $id = $_SESSION['id'];
            $_SESSION['back'] = "setpass";
        }
        else{
            $username = $_SESSION['email'];
            $_SESSION['back'] = "setpass";
        }
    }
    elseif($_SERVER['REQUEST_METHOD'] == "POST"){
        if($_POST['next'] == "next"){
            $_SESSION['err'] = "";
            if(empty(trim($_POST['pass1'])))
            {
                $_SESSION['err'] = " Please Enter New Password";
            }
            elseif(strlen(trim($_POST['pass1'])) < 8)
            {
                $_SESSION['err'] = "Enter a Password greater than 8";
            }
            elseif(trim($_POST['pass1']) !=  trim($_POST['pass2']))
            {
                $_SESSION['err'] = "Passwords shouldn't matched";
            }
            else{
                $_SESSION['pass'] = trim($_POST['pass1']);
                $_SESSION['next'] = "next";
                header("location: /accounts/finalauthentication");
                exit;
            }
        }
        elseif($_POST['next'] == "skip"){
            $_SESSION['next'] = "skip";
            $_SESSION['method'] = "back";
            header("location: /accounts/finalauthentication");
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
<form action=setpassword method=post>
<center><input id=pass1 type=password name=pass1 placeholder="Enter new Password" required></center>
<div>
<input class=curser_p id=checkbox onclick=showpassword() type=checkbox><label id=lable_check class=curser_p for=checkbox>Show password</label>
</div>
<center><input id=pass2 type=password name=pass2 placeholder="Confirm Password" required></center>
<br>
<br>
<center>
<div class=button_main>
<button class="next1 f_right curser_p" name=next value=next onclick=loadanim()>Next</button>
</div>
<div class=button_main>
<div id=skip class="next1 f_left curser_p" style=display:flex;align-items:center;justify-content:center>Skip</div>
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
<script>const body2=document.getElementById("main_body1");function showpassword(){var e=document.getElementById("pass1");"password"===e.type?e.type="text":e.type="password"}body2.style.display="none"</script>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js></script>
<script>const skip=document.getElementById("skip");skip.onclick=function(t){t.preventDefault(),body2.style.display="block",$.post("setpassword",{next:"skip"},(function(t,o){location.reload()}))}</script>
<script>setInterval(passCheck,1e3);const input1=document.getElementById("pass1"),input2=document.getElementById("pass2");function passCheck(){input1.value!=input2.value?(input2.style.borderColor="red",input1.style.borderColor="red"):(input2.style.borderColor="var(--orange)",input1.style.borderColor="var(--orange)")}</script>
<script>function loadanim(){const e=document.getElementById("pass1"),t=document.getElementById("pass2");""!=e.value&&""!=t.value&&(body2.style.display="block")}</script>
</html>