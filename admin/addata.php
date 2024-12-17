<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma");
if ($admin == 1) {
    $table;
    if (isset($_GET['table'])) {
        $_SESSION['table'] = $_GET['table'];
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require_once(path . "hide/config.wma");
        if (isset($_SESSION['table'])) {
            $table = $_SESSION['table'];
            unset($_SESSION['table']);
        } else {
            echo 'session error';
            exit;
        }
        $head = addslashes($_POST['head']);
        $msg = addslashes($_POST['msg']);
        $type = addslashes($_POST['type']);
        $sqlc = "INSERT INTO `$table`(`head`, `msg`,`type`) VALUES ('$head', '$msg', '$type');";
        if (mysqli_query($connsad, $sqlc)) {
            header("location: /");
            exit;
        }
        mysqli_close($connsad);
    } ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>add content</title>
    </head>

    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><br><label for="head">enter header
                name</label><br><input id="head" type="text" name="head" placeholder="header name"><br><label
                for="msg">enter your page content</label><br><textarea id="msg" placeholder="page content" name="msg"
                autocomplete="off" style="width: 95vw; height: 40px;"></textarea><br><br><label for="type">Choose a
                Type</label><select id="type" name="type" required>
                <option value="par">Content</option>
                <option value="code">Code</option>
                <option value="">None</option>
            </select><br><button type="submit">Submit</button></form>
    </body>

    </html> <?php } ?><?php if ($admin != 1) {
          header('Location: /403');
          exit;
      } ?>