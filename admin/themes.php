<?php if ($_SERVER['REQUEST_METHOD'] == "POST") {
    define('path', 'C:/xampp/htdocs/');
    require_once(path . "hide/main.wma");
    $dat = $_POST['data'];
    $data = '';
    if ($dat == "show") {
        if (session_status() == PHP_SESSION_NONE) {
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
}
        require_once(path . "hide/config.wma");
        $sql = "SELECT * FROM `tcolor`";
        $rt = mysqli_query($connsad, $sql);
        $data .= '<ul class="usernavul blur">';
        while ($row = mysqli_fetch_assoc($rt)) {
            $data .= '<li class="usernavli"><div onclick="tcolor(\'' . $row['id'] . '\')" class="z_top posck pointer themes"';
            if (isset($_SESSION['themeslink']) && $_SESSION['themeslink'] == $row['themes']) {
                $data .= 'style="color: var(--orange);"';
            }
            $data .= '>' . $row['name'] . '</div></li>';
        }
        $data .= '</ul>';
        mysqli_close($connsad);
        echo $data;
        exit;
    } else {
        if ($flag == 1) {
            require_once path."accounts/config.wma";
            $id = $_SESSION['id'];
            $sql = "UPDATE `root_users` SET `themes`='$dat' WHERE `id` = '$id';";
            mysqli_query($conn, $sql);
            $_SESSION['themes'] = $dat;
            mysqli_close($conn);
            require_once(path . "hide/config.wma");
            $sqlc = "SELECT `themes` FROM `tcolor` WHERE `id` = '$dat';";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) == 1) {
                $rowrt = mysqli_fetch_assoc($rt);
                $_SESSION['themeslink'] = $rowrt['themes'];
                echo '1';
            }
            mysqli_close($connsad);
            exit;
        } else {
            require_once(path . "hide/config.wma");
            $sqlc = "SELECT `themes` FROM `tcolor` WHERE `id` = '$dat';";
            $rt = mysqli_query($connsad, $sqlc);
            if (mysqli_num_rows($rt) == 1) {
                $rowrt = mysqli_fetch_assoc($rt);
                $_SESSION['themeslink'] = $rowrt['themes'];
                echo '1';
            }
            mysqli_close($connsad);
            exit;
        }
    }
} ?>