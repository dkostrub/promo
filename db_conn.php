<?php
 $dbase=mysqli_connect("localhost", "root", "", "promo");
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}
// @mysql_query('set character_set_client="utf8"');
// @mysql_query('set character_set_results="utf8"');
// @mysql_query('set collation_connection="utf8_general_ci"');
?>