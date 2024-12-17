<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma"); ?><!DOCTYPE html>
<html lang="en">

<head> <?php require_once(path . "hide/head.wma"); ?>
    <link rel="stylesheet" href="/css/responsivenase.css">
    <title>Learn Coding Easily with Free Tutorials and Projects | SA Coder</title>
    <meta name="description"
        content="SA Coder is a free online platform that provides easy-to-understand tutorials and projects to help you learn to code. Explore our courses and start your coding journey today!">
    <meta name="keywords" content="learn coding, free tutorials, coding projects, online courses, SA Coder">
</head>

<body id="body" class="ifect_page">
    <div class="load"></div>
    <main>
        <div><?php require_once(path . "hide/intro.wma"); ?>
            <div class="ifect_page"><?php require_once(path . "hide/header.wma"); ?>
                <div id="hodata">
                    <?php $data = '<div style="height: 1px;"></div>';
                    for ($i = 1; 1; $i++) {
                        $sqlht = "SELECT * FROM `home` WHERE `id` = '$i';";
                        $rht = mysqli_query($connsad, $sqlht);
                        if (mysqli_num_rows($rht) == 1) {
                            $rowht = mysqli_fetch_assoc($rht);
                            $heanam = $rowht['bghn'];
                            if ($rowht['hide'] == 1) {
                                continue;
                            }
                            $data .= '<div class="m-0"><div><div class="ifects ifect12"></div><div id="' . $rowht['pageid'] . '" class="m-1 center welf cor_bla blur"><h2>' . $heanam . '</h2></div></div><div class="m-2">';
                            $tn = $rowht['tablnm'];
                            for ($j = 1; 1; $j++) {
                                $sqlht = "SELECT * FROM `$tn` WHERE `id` = '$j';";
                                $rht = mysqli_query($connsad, $sqlht);
                                if (mysqli_num_rows($rht) == 1) {
                                    $rowht = mysqli_fetch_assoc($rht);
                                    $data .= '<div class="m-2d"><div class="m-2dd center"><div class="ifects ifect13"></div><a href="' . $heanam . '/' . $rowht['cname'] . '/" class="m-2dd1 cor_bla"><div class="center m-2dd11 blur"><div class="center m-2dd12"><h3>' . $rowht['cname'] . '</h3></div></div><p class="center cor_bla fontsmall">' . $rowht['lname'] . '</p></a></div></div>';
                                } else {
                                    if ($admin == 1) {
                                        $data .= '<div class="m-2d"><div class="m-2dd center"><div class="ifects ifect13"></div><a href="/admin/newtutorial?head=' . $heanam . '"class="m-2dd1 cor_bla"><div class="center m-2dd11 blur"><div class="center m-2dd12"><h3>+</h3></div></div><p class="center cor_bla fontsmall">add</p></a></div></div>';
                                    }
                                    $data .= '</div></div>';
                                    break;
                                }
                            }
                        } else {
                            if ($admin == 1) {
                                $data .= '<div class="m-0"><div><div class="ifects ifect12"></div><a href="/admin/newtutorialhead" class="m-1 center welf cor_bla blur"><h2> + </h2></a></div><div class="m-2"><div class="m-2d"></div></div></div>';
                            }
                            break;
                        }
                    }
                    echo $data; ?>
                </div>
                <div style="height: 25vh;"></div>
            </div>
        </div>
    </main>
    <footer id="ftdata"></footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/js/indemain.js"></script>
    <script src="/js/themes.js"></script>
    <script>
        document.getElementById("body").addEventListener("click", e => { document.getElementById("them1").contains(e.target) || (document.getElementById("them1").style.display = "none") });
        lintro();
        setInterval(lintro, 4500);
        async function lintro() {
            const lin = document.getElementById("loginintro");
            const string = "<?php if ($flag == 1) {
                echo 'Hey ';
                if ($_SESSION['first'] == "")
                    echo $_SESSION['username'];
                else
                    echo $_SESSION['first'];
                echo '! how are you?';
            } else {
                echo 'If you want to use all the features of SA Coder then login first.';
            } ?>";
            lin.innerHTML = "";
            for (let i = 0; i < string.length; i++) {
                lin.innerHTML += string[i];
                await sleep(50);
            }
        }
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    </script>
</body>

</html>