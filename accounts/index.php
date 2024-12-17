<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['redirect'])) {
    $_SESSION['url'] = $_GET['redirect'];
}
require_once "verify_cookies.wma";
// check if the user is already logged in
if (!isset($_SESSION['server_username'])) {
    $_SESSION['back'] = "main";
}
require_once("config_google.wma");

?>
<html lang=en><?php include("C:/xampp/htdocs/accounts/header.wma"); ?>

<body><?php include("C:/xampp/htdocs/accounts/anim.wma"); ?>
    <div id=main>
        <main>
            <div id=login_bar1>
                <div id=container>
                    <center><img src=/picture/logo.webp id=logo>
                        <h1 id=logo_name>SA Coder</h1>
                    </center><?php if (!isset($_SESSION['access_token'])) { ?>
                        <center class=log_h_main><a href="<?php echo $google_client->createAuthUrl(); ?>"
                                class="anone center1 back_black padd hw r">
                                <div class="anone center1 back_black padd hw r">
                                    <div class="flex_row center1 r">
                                        <div class="center1 back_white padd-2 radius"><svg version=1.1
                                                xmlns=http://www.w3.org/2000/svg viewBox="0 0 48 48" class=height>
                                                <g>
                                                    <path fill=#EA4335
                                                        d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                                                    </path>
                                                    <path fill=#4285F4
                                                        d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z">
                                                    </path>
                                                    <path fill=#FBBC05
                                                        d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                                                    </path>
                                                    <path fill=#34A853
                                                        d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                                                    </path>
                                                    <path fill=none d="M0 0h48v48H0z"></path>
                                                </g>
                                            </svg></div>
                                        <div class="height center1 white padd-1">Sign in with Google</div>
                                    </div>
                                </div>
                            </a></center><?php } ?>
                    <center class=log_h_main>
                        <hr class=line_log><span class=login_h_e>OR LOGIN WITH EMAIL</span>
                        <hr class=line_log>
                    </center><?php
                    if (isset($_SESSION['err'])) {
                        if ($_SESSION['err'] != "") {
                            echo '<center><p style="color: red;">' . $_SESSION['err'] . '</p></center>';
                            $_SESSION['err'] = "";
                        }
                    }
                    ?>
                    <form action=/accounts/authentication method=post>
                        <center><input id=fill type=email name=email placeholder="Enter username or email" required>
                        </center><br><br>
                        <div class=button_main><button class="next1 f_right curser_p" name=next value=next
                                onclick=loadanim()>Next</button><button class=curser_p name=next value=create_account
                                id=create_account onclick=loadanim()>
                                <p> Create account</p>
                            </button></div>
                    </form><br><br><br>
                </div>
                <div>
                    <ul class="flex_row" style="margin: -10 0;">
                        <li><a class="c_orange" style="margin: 0 10px;" href="/Privacy"
                                target="_blank">Privacy</a></li>
                        <li><a class="c_orange" style="margin: 0 10px;" href="/Terms"
                                target="_blank">Term</a></li>
                    </ul>
                </div>
            </div>
        </main>
    </div>
    <script src=/js/anim.js></script>
    <script>const body2 = document.getElementById("main_body1"); function loadanim() { va = document.getElementById("fill"), ValidateEmail(va) && (body2.style.display = "block") } body2.style.display = "none"</script>
</body>

</html>