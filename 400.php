<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma"); ?>
<!DOCTYPE html>
<html lang="en">

<head><?php require_once(path . "hide/head.wma"); ?>
    <link rel="stylesheet" href="/css/list.css">
    <link rel="stylesheet" href="/css/responsivenase.css">
    <title>400 Bad Request</title>
</head>

<body id="body" class="ifect_page"><?php require_once(path . "hide/header.wma"); ?>
    <div style="height: 1px;"></div>
    <main>
        <div class="ifectp ifect14"></div>
        <div class="ifectp ifect15"></div>
        <div class="ifectp ifect16"></div>
        <div class="ifectp ifect17"></div>
        <div class="ifectp ifect18"></div>
        <div class="ifectp ifect19"></div>
        <div id="mainpri" class="center flex_c" style="padding-left: 0;padding-bottom: 0;">
            <div class="macon" style="margin-top: -100px;">
                <h3 class="cor_bla hfont center" style="margin-bottom: -4vw;">Bad Request</h3>
                <div class="center">
                    <h1 class="center cor_ora ferror">400</h1>
                </div>
                <center>
                    <p class="pfont center cor_bla" style="margin-top: -10px;">Your browser sent a request that this
                        server could not understand.</p>
                </center>
                <hr class="hr">
                <center>
                    <h3 class="cor_bla hfont center">
                        <p> Please check the URL or go to the <a class="cor_ora" href="/">Home page</a>.</p>
                    </h3>
                </center>
            </div>
        </div>
    </main>
    <footer id="ftdata"></footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        dataf();
        function dataf() {
            $.post("/data/getdata", { data: "2" }, function (data, status) {
                if (data != "") {
                    document.getElementById("ftdata").innerHTML = data;
                }
            });
        }
    </script>
    <script src="/js/receiver.js"></script>
    <script src="/js/themes.js"></script>
</body>

</html>