<?php $pagedata=""; $meta=""; $navsidedata='<li class="panahe"><a class="panahea panaho cor_bla" href="/admin/post?head=Tutorials/C++/&table=55244000&id=2">+</a></li>'; $navdata=""; define('path', 'C:/xampp/htdocs/');require_once(path."hide/main.wma"); require_once(path."hide/config.wma"); $sqlc = "SELECT `fpage` FROM `562001846` WHERE `id` = '1';"; $rt = mysqli_query($connsad, $sqlc); $rowrt = mysqli_fetch_assoc($rt); if ($rowrt['fpage'] != "") { $a = $rowrt['fpage']; header("location: $a"); exit; } $navid=0; $tpage=0; $tcomt=0; include("compage.wma"); ?>