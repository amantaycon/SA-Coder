<?php if ($_SERVER['REQUEST_METHOD'] == "POST") {
    define('path', 'C:/xampp/htdocs/');
    require_once(path . "hide/main.wma");
    if ($flag == 1) {
        $username = $_SESSION['username'];
        $msg = $_POST['inputcom'];
        $table = $_POST['data'];
        if ($msg != "") {
            require_once(path . "hide/config.wma");
            $sql = "INSERT INTO `$table`(`username`, `msg`) VALUES ('$username','$msg');";
            mysqli_query($connsad, $sql);
            echo 'successfull';
        }
    }
} ?>