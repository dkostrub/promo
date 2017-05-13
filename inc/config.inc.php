<?php
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'promo');

$dbase = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if (!$dbase) {
    die("Соединение не удалось: ". mysqli_connect_error());
}