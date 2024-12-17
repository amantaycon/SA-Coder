<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma");
if ($admin == 1) {
    $err = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require_once(path . "hide/config.wma");
        $hname = $_POST['hname'];
        $hid = $_POST['hide'];
        $sqlc = "SELECT * FROM `name` WHERE `nam` = '$hname';";
        $res = mysqli_query($connsad, $sqlc);
        if (mysqli_num_rows($res) > 0) {
            $err = "head name already exits";
        }
        if ($err == "") {
            if (!file_exists(path . $hname)) {
                mkdir(path . $hname);
            } else {
                $err = "filename already exits";
            }
        }
        if ($err == "") {
            require_once(path . "hide/gen.wma");
            $tname = "";
            $pageid = "";
            namegen($hname);
            $tname = "" . ($GLOBALS['pass2'] % 100000000);
            $pageid = "" . ($GLOBALS['fpass2'] % 1000000);
            $sqlc = "SELECT * FROM `name` WHERE `nam` = '$tname';";
            $res = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($res) > 0) {
                $err = "table name already exits";
            }
            $sqlc = "SELECT * FROM `name` WHERE `nam` = '$pageid';";
            $res = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($res) > 0) {
                $err = "table name already exits";
            }
            if ($err == "") {
                $sqlc = "CREATE TABLE `u194568756_sacoderweb`.`$tname` (`id` INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `cname` VARCHAR(10) NOT NULL, `lname` VARCHAR(20) NOT NULL, `tname` VARCHAR(50) NOT NULL, `tnav` VARCHAR(50) NOT NULL, `datet` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) ENGINE = InnoDB;";
                if (mysqli_query($connsad, $sqlc)) {
                    $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$hname');";
                    mysqli_query($connsad, $sqlc);
                    $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$tname');";
                    mysqli_query($connsad, $sqlc);
                    $sqlc = "INSERT INTO `name`(`nam`) VALUES ('$pageid');";
                    mysqli_query($connsad, $sqlc);
                    $sqlc = "INSERT INTO `home`(`bghn`, `tablnm`, `pageid`, `hide`) VALUES ('$hname','$tname','$pageid','$hid');";
                    mysqli_query($connsad, $sqlc);
                    $err = "1";
                } else {
                    $err = "Error creating table: ";
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><br><label for="hname">enter your header
                name</label><br><input id="hname" type="text" name="hname" placeholder="header name" required><br><input
                type="number" name="hide" placeholder="Show(0)hide(1)" required><br><button type="submit">Submit</button>
        </form>
    </body>

    </html> <?php } ?><?php if ($admin != 1) {
          header('Location: /403');
          exit;
      } ?>