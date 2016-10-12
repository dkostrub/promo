<?php
if (isset($_POST['pc'])) {
    $string = file_get_contents('http://promo.loc/page.php');
    if (isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        Header('Content-Type: application/force-download');
    else
        Header('Content-Type: application/octet-stream');

    Header('Accept-Ranges: bytes');
    Header('Content-Length: ' . strlen($string));
    Header('Content-disposition: attachment; filename="pc_index.html"');

    echo $string;

    exit();
}
if (isset($_POST['pc_gdn'])) {
    $string = file_get_contents('http://promo.loc/page_gdn.php');
    if (isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        Header('Content-Type: application/force-download');
    else
        Header('Content-Type: application/octet-stream');

    Header('Accept-Ranges: bytes');
    Header('Content-Length: ' . strlen($string));
    Header('Content-disposition: attachment; filename="pc_index.html"');

    echo $string;

    exit();
}
if (isset($_POST['mob'])) {
    $string = file_get_contents('http://promo.loc/mob.php');
    if (isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        Header('Content-Type: application/force-download');
    else
        Header('Content-Type: application/octet-stream');

    Header('Accept-Ranges: bytes');
    Header('Content-Length: ' . strlen($string));
    Header('Content-disposition: attachment; filename="mob_index.html"');

    echo $string;

    exit();
}
else { echo "error"; }
?>

