<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma");
if ($admin == 1) {
    $err = "";
    if (isset($_GET['head'])) {
        $_SESSION['head'] = $_GET['head'];
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $head = "";
        require_once(path . "hide/config.wma");
        $cname = $_POST['cname'];
        $lname = $_POST['lname'];
        $sqlc = "SELECT * FROM `name` WHERE `nam` = '$cname';";
        $rt = mysqli_query($connsad, $sqlc);
        if (mysqli_num_rows($rt) > 0) {
            $err = "blog name already exits";
        }
        if (isset($_SESSION['head'])) {
            $head = $_SESSION['head'];
            unset($_SESSION['head']);
        } else {
            $err = "head session error";
        }
        if ($err == "") {
            if (!file_exists(path . $head . '/' . $cname)) {
                mkdir(path . $head . '/' . $cname);
            } else {
                $err = "filename already exits";
            }
        }
        if ($err == "") {
            require_once(path . "hide/gen.wma");
            $tname = "";
            $tnav = "";
            namegen($cname);
            $tname = "" . ($GLOBALS['pass2'] % 1000000000);
            $tnav = "" . ($GLOBALS['fpass2'] % 1000000000);
            $sqlc = "SELECT * FROM `name` WHERE `nam` = '$tname';";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) > 0) {
                $err = "table name already exits";
            }
            $sqlc = "SELECT * FROM `name` WHERE `nam` = '$tnav';";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) > 0) {
                $err = "table name already exits";
            }
            if ($err == "") {
                $sqlc = "CREATE TABLE `u194568756_sacoderweb`.`$tnav` (`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `link` VARCHAR(200) NOT NULL, `name` VARCHAR(100) NOT NULL, `table` VARCHAR(30) NOT NULL, `cometl` VARCHAR(30) NOT NULL, `next` VARCHAR(200) NOT NULL, `previous` VARCHAR(200) NOT NULL, `title` VARCHAR(100) NOT NULL, `keyword` VARCHAR(100) NOT NULL, `description` VARCHAR(255) NOT NULL,`content` VARCHAR(255) NOT NULL, `datet` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) ENGINE = InnoDB;";
                $tamain;
                $id;
                if (mysqli_query($connsad, $sqlc)) {
                    $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$tnav');";
                    mysqli_query($connsad, $sqlc);
                    $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$cname');";
                    mysqli_query($connsad, $sqlc);
                    $sqlc = "CREATE TABLE `u194568756_sacoderweb`.`$tname` (`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `cpage` VARCHAR(200) NOT NULL, `fpage` VARCHAR(200) NOT NULL, `datet` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) ENGINE = InnoDB;";
                    if (mysqli_query($connsad, $sqlc)) {
                        $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$tname');";
                        mysqli_query($connsad, $sqlc);
                        $sqlc = "SELECT `tablnm` FROM `home` WHERE `bghn` = '$head';";
                        $rt = mysqli_query($connsad, $sqlc);
                        $rowrt = mysqli_fetch_assoc($rt);
                        $tamain = $rowrt['tablnm'];
                        $sqlc = "INSERT INTO `" . $tamain . "`(`cname`, `lname`, `tname`, `tnav`) VALUES ('$cname','$lname','$tname', '$tnav');";
                        mysqli_query($connsad, $sqlc);
                        $sqlc = "SELECT `id` FROM `$tamain` WHERE `tname` = '$tname';";
                        $rt = mysqli_query($connsad, $sqlc);
                        $rowrt = mysqli_fetch_assoc($rt);
                        $id = $rowrt['id'];
                        $err = "2";
                    }
                }
                $navdata = '<?php $pagedata = ""; $sqlc = "SELECT * FROM `$tpage`"; $rt = mysqli_query($connsad, $sqlc); if (mysqli_num_rows($rt) > 0) { $i = 1111;$j=1; while ($rowrt = mysqli_fetch_assoc($rt)) { if ($rowrt[\'head\'] != "") { if($j == 1){$j++; $pagedata .= \'<h1 class="cor_ora hfont">\' . $rowrt[\'head\'] . \'</h1>\';}else{$pagedata .= \'<h2 class="cor_ora hfont">\' . $rowrt[\'head\'] . \'</h2>\';} if ($rowrt[\'type\'] == "par") { $pagedata .= \'<hr class="hr">\';}}if ($rowrt[\'type\'] == "par") { $pagedata .= \'<br><p class="pfont">\' . $rowrt[\'msg\'] . \'</p><br>\';} elseif ($rowrt[\'type\'] == "code") { $pagedata .= \'<div class="codeh"><p id="\' . $rowrt[\'id\'] . \'" class="codec blur pointer" onclick="copy(\\\'c\'. $i .\'\\\')">copy</p><pre id="c\'. $i .\'" class="code"><code>\' . $rowrt[\'msg\'] . \'</code></pre></div><br><br>\'; $i++;}}} else {$pagedata = "<center>This page will be comming soon</center>";}if($admin == 1){ $pagedata .= \'<h1><a href="/admin/addata?table=\'.$tpage.\'" class="cor_ora">add more data(+)</a></h1>\';} $navsidedata = \'<ul class="navpaged "><div onclick="hi()" class="close welf pointer">˟</div>\'; $sqlc = "SELECT * FROM `' . $tnav . '`"; $rt = mysqli_query($connsad, $sqlc); if (mysqli_num_rows($rt) > 0) { while ($rowrt = mysqli_fetch_assoc($rt)) {$navsidedata .= \'<li>\';$navsidedata .= \'<a class="panahea panaho\';if ($rowrt[\'id\'] == $navid) {$navsidedata .= \' cor_ora\'; $nexpre = \'<div class="nexpre">\'; if($rowrt[\'previous\'] != ""){$nexpre .= \'<div class="previous"><a class="center" href="\'.$rowrt[\'previous\'].\'">Previous</a></div>\';}if($rowrt[\'next\'] != ""){$nexpre .= \'<div class="next"><a class="center" href="\'.$rowrt[\'next\'].\'">Next</a></div>\';} $nexpre .= \'</div>\'; $meta .= \'<meta name="description" content="\'.$rowrt[\'description\'].\'"><meta name="keywords" content="\'.$rowrt[\'keyword\'].\'"><title>\'.$rowrt[\'title\'].\'</title>\'; } else { $navsidedata .= \' cor_blap\';} $navsidedata .= \'" href="\' . $rowrt[\'link\'] . \'">\' . $rowrt[\'name\'] . \'</a></li>\';}}if($admin == 1){ $navsidedata .= \'<li class="panahe"><a class="panahea panaho cor_bla" href="/admin/post?head=' . $head . '/' . $cname . '/&table=' . $tamain . '&id=' . $id . '">+</a></li>\'; }$navsidedata .= \'</ul>\'; ?> ';
                $sqlc = "SELECT `tablnm` FROM `home` WHERE `bghn` = '$head';";
                $rt = mysqli_query($connsad, $sqlc);
                $rowrt = mysqli_fetch_assoc($rt);
                $navdata .= '  <?php $navdata = \'<ul class="flex_r mar_p_20 ovscroy wh80vw">\'; $sqlc = "SELECT * FROM `' . $rowrt['tablnm'] . '`"; $rt = mysqli_query($connsad, $sqlc); if (mysqli_num_rows($rt) > 0) { while ($rowrt = mysqli_fetch_assoc($rt)) { $navdata .= \'<li class="listpn center"><a class="listpna" href="/' . $head . '/\' . $rowrt[\'cname\'] . \'/">\' . $rowrt[\'cname\'] . \'</a></li>\'; }} $navdata .= \'</ul>\';  ?>';
                file_put_contents(path . $head . '/' . $cname . '/' . 'maindata.wma', $navdata);
                $navdata = '<!DOCTYPE html><html lang="en"><head> <?php require_once(path."hide/head.wma"); $_SESSION[\'composi\'] = 1; $_SESSION[\'stop\']=0; if(isset($_SESSION[\'live\'])){unset($_SESSION[\'live\']);} ?><link rel="stylesheet" href="/css/list.css?v=<?php echo filemtime(path.\'/css/list.css\'); ?>"><link rel="stylesheet" href="/css/comment.css?v=<?php echo filemtime(path.\'/css/comment.css\'); ?>"><link rel="stylesheet" href="/css/responsivenase.css?v=<?php echo filemtime(path.\'/css/responsivenase.css\'); ?>"><?php echo $meta; ?></head><body id="body" class="ifect_page"><?php require_once(path."hide/header.wma"); ?><div class="stit3 pagelist shead2"><div class="blur center"><div id="navpag" class="blur pointer"><svg viewBox="0 0 24 24" style=" width: 1.7rem; height: 1.7rem;margin: 3px 15px; float: left;"><path d="M21,6H3V5h18V6z M21,11H3v1h18V11z M21,17H3v1h18V17z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: var(--orange); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" /></svg></div><a href="/"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 256 256" xml:space="preserve"><g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)"><polygon points="75.96,30.96 75.96,13.34 67.26,13.34 67.26,22.26 45,0 0.99,44.02 7.13,50.15 45,12.28 82.88,50.15 89.01,44.02 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: var(--orange); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "></polygon><polygon points="45,20 14.04,50.95 14.04,90 35.29,90 35.29,63.14 54.71,63.14 54.71,90 75.96,90 75.96,50.95 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: var(--orange); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "></polygon></g></svg></a><?php echo $navdata; ?></div><nav id="navpagnav" class="navpage stit3 blur shead2 ovscrox"><?php echo $navsidedata; ?></nav></div><main><div class="ifectp ifect14"></div><div class="ifectp ifect15"></div><div class="ifectp ifect16"></div><div class="ifectp ifect17"></div><div class="ifectp ifect18"></div><div class="ifectp ifect19"></div><div id="main"><div id="pagedata" class="macon"><?php echo $nexpre.$pagedata.$nexpre; ?></div><div class="comdiv"><div class="center"><?php if($flag == 1){ ?> <input id="comment" name="comment" type="text" placeholder="Add a comment..." required><button class="pointer" id="submit" type="button"><svg style=" width: 2rem; height: 2rem;" width="24" height="24" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" style="fill: var(--orange);"></path><path d="M0 0h24v24H0z" fill="none"></path></svg></button> <?php } else { ?> <div id="comblock" class="cor_blap">Please <a class="cor_ora" href="/accounts/?redirect=https://t.sacoder.com<?php echo $_SERVER[\'REQUEST_URI\']; ?>">login</a> first to comment.</div> <?php } ?></div><div class="center"><div id="comment_box" class=" codeh ovscrox"></div></div></div></div></main><footer id="ftdata"></footer><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script><script>document.getElementById("ulogo1").style.top = "-5rem"; dataf(); function dataf() {$.post("/data/getdata", {data: "2"}, function (data, status) {if (data != "") {document.getElementById("ftdata").innerHTML = data;}});}</script> <script src="/js/receiver.js"></script><script src="/js/copy.js"></script><script><?php if($flag == 1){ echo\'const form=document.getElementById("submit");form.onclick=function(e){e.preventDefault();let t=document.getElementById("comment");$.post("/admin/commentpost",{inputcom:t.value,data:\'.$tcomt.\'}),t.value=""};var input=document.getElementById("comment");input.addEventListener("keyup",function(e){e.preventDefault(),13===e.keyCode&&document.getElementById("submit").click()});\';} echo \'comment();var scroly=document.getElementById("comment_box");let scrollTimeout;function comment(){$.post("/admin/commentget",{data:\'.$tcomt.\'},function(o,c){""!=o&&(scroly.innerHTML+=o)})}scroly.addEventListener("scroll",function(){if(scrollTimeout) clearTimeout(scrollTimeout);scrollTimeout = setTimeout(function(){if((scroly.scrollHeight-350) < (scroly.scrollTop)){comment();}},50);});setInterval(ct, 1000);function ct(){$.post("/admin/liveget",{ data:\'.$tcomt.\'},function (o, c){"" != o&&($("#comment_box").prepend(o))})}\'; ?></script><script src="/js/themes.js"></script></body></html>';
                file_put_contents(path . $head . '/' . $cname . '/' . 'compage.wma', $navdata);
                $navdata = '<?php $pagedata=""; $meta=""; $navsidedata=\'<li class="panahe"><a class="panahea panaho cor_bla" href="/admin/post?head=' . $head . '/' . $cname . '/' . '&table=' . $tamain . '&id=' . $id . '">+</a></li>\'; $navdata=""; define(`path`, `C:/xampp/htdocs/`);require_once(path."hide/main.wma"); require_once(path."hide/config.wma"); $sqlc = "SELECT `fpage` FROM `' . $tname . '` WHERE `id` = \'1\';"; $rt = mysqli_query($connsad, $sqlc); $rowrt = mysqli_fetch_assoc($rt); if ($rowrt[\'fpage\'] != "") { $a = $rowrt[\'fpage\']; header("location: $a"); exit; } $navid=0; $tpage=0; $tcomt=0; include("compage.wma"); ?>';
                file_put_contents(path . $head . '/' . $cname . '/' . 'index.php', $navdata);
                $sqlc = "INSERT INTO `" . $tname . "`(`cpage`) VALUES ('" . $head . "/" . $cname . "/" . "compage.wma');";
                mysqli_query($connsad, $sqlc);
                if ($err == '2') {
                    $err = '1';
                }
            }
        }
        mysqli_close($connsad);
    } ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>header create</title>
    </head>

    <body> <?php if ($err == "1") {
        header("location: /");
    } else {
        echo "<p style='color: red;'>" . $err . "</p>";
    } ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><br><label for="cname">enter your blog
                name</label><br><input id="cname" type="text" name="cname" placeholder="blog name" required><br><label
                for="lname">enter your blog full name</label><br><input id="lname" type="text" name="lname"
                placeholder="full blog name" required><br><br><button type="submit">Submit</button></form>
    </body>

    </html> <?php } ?><?php if ($admin != 1) {
          header('Location: /403');
          exit;
      } ?>