<?php define('path', 'C:/xampp/htdocs/');
require_once(path . "hide/main.wma");
if ($flag == 1) {
    $image_path = path."accounts/" . $_SESSION['plink'];
    header('Content-Type: image/jpeg');
    readfile($image_path);
} else {
    header('HTTP/1.1 403 Forbidden');
} ?>