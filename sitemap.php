<?php define('path', 'C:/xampp/htdocs/');
require_once(path."hide/config.wma");

$sitemap = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
$u = '';
$sitemap .= '<url>'."\n".'<loc>'.$u.'/</loc>'."\n".'<lastmod>'.'2023-03-03T18:47:46+00:00'.'</lastmod>'."\n".'</url>'."\n";
$sitemap .= '<url>'."\n".'<loc>'.$u.'/Disclaimer</loc>'."\n".'<lastmod>'.'2023-03-03T18:47:46+00:00'.'</lastmod>'."\n".'</url>'."\n";
$sitemap .= '<url>'."\n".'<loc>'.$u.'/Privacy</loc>'."\n".'<lastmod>'.'2023-03-03T18:47:46+00:00'.'</lastmod>'."\n".'</url>'."\n";
$sitemap .= '<url>'."\n".'<loc>'.$u.'/Terms</loc>'."\n".'<lastmod>'.'2023-03-03T18:47:46+00:00'.'</lastmod>'."\n".'</url>'."\n";
$sitemap .= '<url>'."\n".'<loc>'.$u.'/About_us</loc>'."\n".'<lastmod>'.'2023-03-03T18:47:46+00:00'.'</lastmod>'."\n".'</url>'."\n";
$urlhead = array();
$urlheadn = array();
$urlsub = array();
$urllist = array();
$urlc = array();
$sqlc = "SELECT * FROM `home`;";
$rt = mysqli_query($connsad, $sqlc);
if (mysqli_num_rows($rt) > 0) {
    while ($rowrt = mysqli_fetch_assoc($rt)) {
        array_push($urlhead, $rowrt['tablnm']);
        array_push($urlheadn, $rowrt['bghn']);
    }
}
$i=0;
foreach ($urlhead as $url) {
    $sqlc = "SELECT `cname`,`tname`, `tnav` FROM `$url`;";
    $rt = mysqli_query($connsad, $sqlc);
    if (mysqli_num_rows($rt) > 0) {
        $hc = $urlheadn[$i];
        $i++;
        while ($rowrt = mysqli_fetch_assoc($rt)) {
            array_push($urlsub, $rowrt['tname']);
            array_push($urllist, $rowrt['tnav']);
            array_push($urlc, $hc.'/'.$rowrt['cname']);
        }
    }
}
$i=0;
foreach ($urlsub as $url) {
    $sqlc = "SELECT `fpage`, `datet` FROM `$url`;";
    $rt = mysqli_query($connsad, $sqlc);
    $hc = $urlheadn[$i];
    $i++;
    if (mysqli_num_rows($rt) > 0) {
        while ($rowrt = mysqli_fetch_assoc($rt)) {
            $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $rowrt['datet']);
            $date_string = $datetime->format('Y-m-d\TH:i:sP');
            $sitemap .= '<url>'."\n".'<loc>'.$u.$rowrt['fpage'].'</loc>'."\n".'<lastmod>'.$date_string.'</lastmod>'."\n".'</url>'."\n";
        }
    }
}
$sitemap .= '<url>'."\n".'<loc>/Blogs/Code/</loc>'."\n".'</url>'."\n";
$sitemap .= '<url>'."\n".'<loc>/Blogs/Brief/</loc>'."\n".'</url>'."\n";
$i = 0;
foreach ($urllist as $url) {
    $sqlc = "SELECT `link`, `datet` FROM `$url`;";
    $rt = mysqli_query($connsad, $sqlc);
    $hc = $urlc[$i];
    $i++;
    if (mysqli_num_rows($rt) > 0) {
        $rowrt = mysqli_fetch_assoc($rt);
        while ($rowrt = mysqli_fetch_assoc($rt)) {
            $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $rowrt['datet']);
            $date_string = $datetime->format('Y-m-d\TH:i:sP');
            $sitemap .= '<url>'."\n".'<loc>'.$u.'/'.$hc.'/'.$rowrt['link'].'</loc>'."\n".'<lastmod>'.$date_string.'</lastmod>'."\n".'</url>'."\n";
        }
    }
}
$sitemap .= '</urlset>';
file_put_contents(path.'sitemap.xml',$sitemap);
header('Content-Type: application/xml');
echo $sitemap;
?>