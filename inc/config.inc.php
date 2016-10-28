<?php
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'promo');

$dbase = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
    printf("Соединение не удалось: %s\n", mysqli_connect_error());
    exit;
}