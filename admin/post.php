<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma");
if ($admin == 1) {
    $err = "";
    $head = "";
    $table;
    $idta;
    if (isset($_GET['head'])) {
        $_SESSION['head'] = $_GET['head'];
        $_SESSION['table'] = $_GET['table'];
        $_SESSION['idta'] = $_GET['id'];
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $err == "") {
        if (isset($_SESSION['head'])) {
            $head = $_SESSION['head'];
            $table = $_SESSION['table'];
            $idta = $_SESSION['idta'];
            unset($_SESSION['head']);
            unset($_SESSION['table']);
            unset($_SESSION['idta']);
        } else {
            $err = "error session";
        }
        require_once(path . "hide/config.wma");
        $link = addslashes($_POST['link']);
        $name = addslashes($_POST['name']);
        $keyword = addslashes($_POST['keyword']);
        $dscptn = addslashes($_POST['dscptn']);
        $title = addslashes($_POST['title']);
        $content = $_POST['content'];
        $tnav;
        $tmain;
        $sqlc = "SELECT * FROM `name` WHERE `nam` = '$link';";
        $rt = mysqli_query($connsad, $sqlc);
        if (mysqli_num_rows($rt) > 0) {
            echo "table name already exits";
            exit;
        }
        $sqlc = "SELECT * FROM `$table` WHERE `id` = '$idta';";
        $rt = mysqli_query($connsad, $sqlc);
        if (mysqli_num_rows($rt) == 1) {
            $rowrt = mysqli_fetch_assoc($rt);
            $tnav = $rowrt['tnav'];
            $tmain = $rowrt['tname'];
            require_once(path . "hide/gen.wma");
            $tpage;
            $tcomt;
            namegen($link . $name);
            $tpage = "" . ($GLOBALS['pass2'] % 100000000);
            $tcomt = "" . ($GLOBALS['fpass2'] % 100000000);
            $sqlc = "SELECT * FROM `name` WHERE `nam` = '$tpage';";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) > 0) {
                $err = "table name already exits";
            }
            $sqlc = "SELECT * FROM `name` WHERE `nam` = '$tcomt';";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) > 0) {
                $err = "table name already exits";
            }
            if ($err == "") {
                $sqlc = "INSERT INTO `$tnav`(`link`, `name`, `table`, `cometl`, `title`, `keyword`, `description`, `content`) VALUES ('$link','$name','$tpage','$tcomt','$title','$keyword','$dscptn', '$content');";
                mysqli_query($connsad, $sqlc);
                $sqlc = "SELECT `id` FROM `$tnav` WHERE `table` = '$tpage';";
                $rt = mysqli_query($connsad, $sqlc);
                $rowrt = mysqli_fetch_assoc($rt);
                $idcpage = $rowrt['id'];
                if ($idcpage !== '1') {
                    $sqlc = "UPDATE `$tnav` SET `next`='$link' WHERE id='" . ($idcpage - 1) . "'";
                    mysqli_query($connsad, $sqlc);
                    $sqlc = "SELECT `link` FROM `$tnav` WHERE id='" . ($idcpage - 1) . "'";
                    $rt = mysqli_query($connsad, $sqlc);
                    $rowrt = mysqli_fetch_assoc($rt);
                    $prelink = $rowrt['link'];
                    $sqlc = "UPDATE `$tnav` SET `previous`='$prelink' WHERE id='$idcpage'";
                    mysqli_query($connsad, $sqlc);
                }
                $sqlc = "CREATE TABLE `u194568756_sacoderweb`.`$tpage` (`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `head` VARCHAR(255) NOT NULL, `msg` LONGTEXT NOT NULL, `type` VARCHAR(10) NOT NULL, `datet` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) ENGINE = InnoDB;";
                mysqli_query($connsad, $sqlc);
                $sqlc = "CREATE TABLE `u194568756_sacoderweb`.`$tcomt` (`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `username` VARCHAR(100) NOT NULL, `msg` LONGTEXT NOT NULL, `datet` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) ENGINE = InnoDB;";
                if (mysqli_query($connsad, $sqlc)) {
                    $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$tpage');";
                    mysqli_query($connsad, $sqlc);
                    $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$tpage');";
                    mysqli_query($connsad, $sqlc);
                }
                $sqlc = "SELECT * FROM `$tmain` WHERE `id` = '1';";
                $rt = mysqli_query($connsad, $sqlc);
                if (mysqli_num_rows($rt) == 1) {
                    $rowrt = mysqli_fetch_assoc($rt);
                    $compage = $rowrt['cpage'];
                    $createpage = '<?php $pagedata=""; $meta=""; $navsidedata=""; $navdata=""; $nexpre=""; define(`path`, `C:/xampp/htdocs/`); $navid=' . $idcpage . '; $tpage=' . $tpage . '; $tcomt=' . $tcomt . '; require_once(path."hide/main.wma"); require_once(path."hide/config.wma"); include("maindata.wma"); include("compage.wma"); ?>';
                    file_put_contents(path . $head . $link . '.php', $createpage);
                    $err = '1';
                }
                $sqlc = "SELECT `fpage` FROM `$tmain` WHERE id='1';";
                $rt = mysqli_query($connsad, $sqlc);
                $rowrt = mysqli_fetch_assoc($rt);
                if ($rowrt['fpage'] == "") {
                    $sqlc = "UPDATE `$tmain` SET `fpage`='" . "/" . $head . $link . "' WHERE id='1';";
                    mysqli_query($connsad, $sqlc);
                }
            }
        }
        mysqli_close($connsad);
    } ?><!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>new post create</title>
    </head>

    <body> <?php if ($err == "1") {
        header("location: /");
    } else {
        echo "<p style='color: red;'>" . $err . "</p>";
    } ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <center><br><label for="link">enter your link url</label><br><input id="link" type="text" name="link"
                    placeholder="Post Link" style="width: 95vw; height: 25px;" autocomplete="off"><br><br><label
                    for="name">enter your post header name</label><br><input id="name" type="text" name="name"
                    placeholder="Post name" style="width: 95vw; height: 25px;" autocomplete="off"><br><br><label
                    for="title">enter your post title</label><br><input id="title" type="text" name="title"
                    placeholder="Post title" style="width: 95vw; height: 25px;" autocomplete="off" required><br><br><label
                    for="description">enter your post description</label><br><textarea id="description"
                    placeholder="description" name="dscptn" autocomplete="off" style="width: 95vw; height: 40px;"
                    required></textarea><br><br><label for="keyword">enter your post keyword</label><br><textarea
                    id="keyword" placeholder="keyword" name="keyword" autocomplete="off" style="width: 95vw; height: 40px;"
                    required></textarea><br><br><label for="content">enter your post meta content</label><br><textarea
                    id="content" placeholder="content" name="content" autocomplete="off"
                    style="width: 95vw; height: 40px;"></textarea><br><br><br><button type="submit">Submit</button></center>
        </form>
    </body>

    </html> <?php } ?><?php if ($admin != 1) {
          header('Location: /403');
          exit;
      } ?>