<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once(path . "hide/config.wma");
    $a = $_POST['data'];
    if ($a == '2') {
        $datafoot = '<div class="footer"><div class="ifect ifect7"></div><div class="ifect ifect8"></div><div class="ifects ifect9"></div><div class="foot-1 flex_c"><div class="foot-12"><div class="center flex_c policy"><ul class="flex_c">';
        $sqlc = "SELECT * FROM `home`;";
        $rt = mysqli_query($connsad, $sqlc);
        $he1 = "";
        $he2 = "";
        $tab1;
        $tab2;
        if (mysqli_num_rows($rt) > 0) {
            $i = 0;
            while ($rowrt = mysqli_fetch_assoc($rt)) {
                $datafoot .= '<li class="mar_20px"><a href="/#' . $rowrt['pageid'] . '" class="footlih center">' . $rowrt['bghn'] . '</a></li>';
                if ($i == 0) {
                    $he1 = '<li class="mar_20px"><a href="/#' . $rowrt['pageid'] . '" class="footlih center">' . $rowrt['bghn'] . '</a></li>';
                    $tab1 = $rowrt['tablnm'];
                    $i++;
                } elseif ($i == 1) {
                    $he2 = '<li class="mar_20px"><a href="/#' . $rowrt['pageid'] . '" class="footlih center">' . $rowrt['bghn'] . '</a></li>';
                    $tab2 = $rowrt['tablnm'];
                    $i++;
                }
            }
        }
        $datafoot .= '</ul></div>';
        $datafoot .= '<div class="center flex_c policy"><ul class="flex_c">' . $he1;
        if ($he1 != "") {
            $sqlc = "SELECT * FROM `$tab1`";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) > 0) {
                while ($rowrt = mysqli_fetch_assoc($rt)) {
                    $tname = $rowrt['tname'];
                    $sqlc1 = "SELECT `fpage` FROM `$tname` WHERE `id` = '1';";
                    $rt1 = mysqli_query($connsad, $sqlc1);
                    $rowrt1 = mysqli_fetch_assoc($rt1);
                    $datafoot .= '<li class="mar_20px"><a class="foota" href="' . $rowrt1['fpage'] . '">' . $rowrt['cname'] . '</a></li>';
                }
            }
        }
        $datafoot .= '</ul></div>';
        $datafoot .= '<div class="center flex_c policy"><ul class="flex_c">' . $he2;
        if ($he2 != "") {
            $sqlc = "SELECT * FROM `$tab2`";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) > 0) {
                while ($rowrt = mysqli_fetch_assoc($rt)) {
                    $tname = $rowrt['tname'];
                    $sqlc1 = "SELECT `fpage` FROM `$tname` WHERE `id` = '1';";
                    $rt1 = mysqli_query($connsad, $sqlc1);
                    $rowrt1 = mysqli_fetch_assoc($rt1);
                    $datafoot .= '<li class="mar_20px"><a class="foota" href="' . $rowrt1['fpage'] . '">' . $rowrt['cname'] . '</a></li>';
                }
            }
        }
        $datafoot .= '</ul></div>';
        $datafoot .= '<div class="center flex_c policy"><ul class="flex_c"><li class="mar_20px"><a class="foota" href="/Disclaimer">Disclaimer</a></li><li class="mar_20px"><a class="foota" href="Privacy">Privacy</a></li><li class="mar_20px"><a class="foota" href="Terms">Terms</a></li><li class="mar_20px"><a class="foota" href="About_us">About us</a></li></ul></div></div><div class="footersp"><div class="flex_c"><div><div class="footam center flex_c cor_whi"><p>Any Quaries Contact us =&gt; <span class="cor_ora"> ♥ </span></p><p>Email-ID:- help@sacoder.com</p><p class="cor_yel">Keep Smile ⌣</p></div><div class="footsocial center"><ul class="footsocial center m-rr-20 flex_r"><li><a href="https://www.youtube.com/channel/UC3Hf0K02SbOeOgGWVjUlAsw" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="40px" height="40px"><g><path style=" stroke:none;fill-rule:nonzero;fill:var(--light_black);fill-opacity:1;" d="M 43.164062 12.371094 C 42.703125 10.652344 41.347656 9.296875 39.628906 8.835938 C 36.507812 8 24 8 24 8 C 24 8 11.492188 8 8.371094 8.835938 C 6.652344 9.296875 5.296875 10.652344 4.835938 12.371094 C 4 15.492188 4 24 4 24 C 4 24 4 32.507812 4.835938 35.628906 C 5.296875 37.347656 6.652344 38.703125 8.371094 39.164062 C 11.492188 40 24 40 24 40 C 24 40 36.507812 40 39.628906 39.164062 C 41.351562 38.703125 42.703125 37.347656 43.164062 35.628906 C 44 32.507812 44 24 44 24 C 44 24 44 15.492188 43.164062 12.371094 Z M 20 29.195312 L 20 18.804688 C 20 18.035156 20.835938 17.554688 21.5 17.9375 L 30.5 23.132812 C 31.164062 23.519531 31.164062 24.480469 30.5 24.867188 L 21.5 30.0625 C 20.835938 30.449219 20 29.964844 20 29.195312 Z M 20 29.195312 "></path></g></svg></a></li><li><a href="https://www.instagram.com/amantaycon" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="40px" height="40px"><radialGradient id="yOrnnhliCrdS2gy~4tD8ma" cx="19.38" cy="42.035" r="44.899" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fd5"></stop><stop offset=".328" stop-color="#ff543f"></stop><stop offset=".348" stop-color="#fc5245"></stop><stop offset=".504" stop-color="#e64771"></stop><stop offset=".643" stop-color="#d53e91"></stop><stop offset=".761" stop-color="#cc39a4"></stop><stop offset=".841" stop-color="#c837ab"></stop></radialGradient><path fill="var(--light_black)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><radialGradient id="yOrnnhliCrdS2gy~4tD8mb" cx="11.786" cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4168c9"></stop><stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8mb)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><path fill="#fff" d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z"></path><circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle><path fill="#fff" d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z"></path></svg></a></li><li><a href="https://www.facebook.com/profile.php?id=100088841997396" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" fill="var(--light_black)" viewBox="0 0 50 50" width="40px" height="40px"><path d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z"></path></svg></a></li></ul></div></div><center><p class="cor_ora fontsfoot">© All rights reserved 2022 - 2023</p></center></p></div></div></div></div>';
        echo $datafoot;
    } else {
        header('HTTP/1.0 403 Forbidden');
        header('Location: /403');
        exit;
    }
    mysqli_close($connsad);
} else {
    header('HTTP/1.0 403 Forbidden');
    header('Location: /403');
    exit;
} ?>