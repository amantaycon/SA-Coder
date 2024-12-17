<?php if ($_SERVER['REQUEST_METHOD'] == "POST") {
    define('path', 'C:/xampp/htdocs/');
    require_once(path . "hide/main.wma");
    $table = $_POST['data'];
    require_once(path . "hide/config.wma");
    $data = '';
    $end_date = new DateTime();
    if (!isset($_SESSION['live'])) {
        $sql = "SELECT `id` FROM `$table` ORDER BY id DESC LIMIT 1";
        $rt = mysqli_query($connsad, $sql);
        if (mysqli_num_rows($rt) == 1) {
            $row = mysqli_fetch_assoc($rt);
            $_SESSION['live'] = ++$row['id'];
        } else {
            $_SESSION['live'] = 1;
        }
    }
    $i = 1;
    for ($i = $_SESSION['live']; 1; $i++) {
        $sql = "SELECT * FROM `$table` WHERE `id`= '$i';";
        $rt = mysqli_query($connsad, $sql);
        if (mysqli_num_rows($rt) == 1) {
            $row = mysqli_fetch_assoc($rt);
            if ($flag == 1 && $_SESSION['username'] == $row['username']) {
                $data .= '<div class="se"><div class="com-se blur"><div class="comhead"><p class="usercom">' . $row['username'] . ' (<span class="cor_whi">';
                $start_date = new DateTime($row['datet']);
                $interval = $start_date->diff($end_date);
                if ($interval->y > 0) {
                    $data .= $interval->y . ' year';
                    if ($interval->y != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->m > 0) {
                    $data .= $interval->m . ' month';
                    if ($interval->m != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->d > 0) {
                    $data .= $interval->d . ' day';
                    if ($interval->d != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->h > 0) {
                    $data .= $interval->h . ' hour';
                    if ($interval->h != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->i > 0) {
                    $data .= $interval->i . ' minute';
                    if ($interval->i != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->s > 0) {
                    $data .= $interval->s . ' second';
                    if ($interval->s != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } else {
                    $data .= 'just now ';
                }
                $data .= '</span>)</p><p class="comdel pointer"><svg id="comid" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/></svg><ul hidden class="comnav"><li>delete</li></ul></p></div><pre class="come_whi precom">' . $row['msg'] . '</pre></div></div>';
            } else {
                $data .= '<div class="re"><div class="com-re blur"><div class="comhead"><p class="usercomr">' . $row['username'] . ' (<span class="cor_whi">';
                $start_date = new DateTime($row['datet']);
                $interval = $start_date->diff($end_date);
                if ($interval->y > 0) {
                    $data .= $interval->y . ' year';
                    if ($interval->y != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->m > 0) {
                    $data .= $interval->m . ' month';
                    if ($interval->m != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->d > 0) {
                    $data .= $interval->d . ' day';
                    if ($interval->d != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->h > 0) {
                    $data .= $interval->h . ' hour';
                    if ($interval->h != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->i > 0) {
                    $data .= $interval->i . ' minute';
                    if ($interval->i != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } elseif ($interval->s > 0) {
                    $data .= $interval->s . ' second';
                    if ($interval->s != 1) {
                        $data .= 's';
                    }
                    $data .= ' ago ';
                } else {
                    $data .= 'just now ';
                }
                $data .= '</span>)</p></div><pre class="come_whi precom">' . $row['msg'] . '</pre></div></div>';
            }
        } else {
            $_SESSION['live'] = $i;
            break;
        }
    }
    echo $data;
} ?>