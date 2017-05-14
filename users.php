<?php
require "inc/config.inc.php";

$i=1;

$rows_per_page = 500; // количество записей, выводимых на странице
if (isset($_GET['page']))
    $page = ($_GET['page'] - 1); else $page = 0; // номер страницы для вычисления значения первой записи
$from = $page * $rows_per_page;
$query = "SELECT * FROM `users` GROUP BY `user` LIMIT $from, $rows_per_page";
$res = mysqli_query($dbase, $query);

$table = '<table>';
while($result = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $table .= '<tr>';
//    $table .= '<td>'. $i++ .'</td>';
    $table .= '<td>'. $result['user'] .'</td>';
    $table .= '<td>'. $result['city'] .'</td>';
    $table .= '</tr>';
}
$table .= '</table>';
echo $table;

$query = "SELECT COUNT(DISTINCT user) FROM users";
$res = mysqli_query($dbase, $query);
$row = mysqli_fetch_row($res);
$total_rows = $row[0];

$total_pages = ceil($total_rows / $rows_per_page);

for($i = 1; $i <= $total_pages; $i++) {
    if (($i - 1) == $page) {
        echo "<b>" . $i . "</b>&nbsp;";
    } else {
        echo '<a href="?page=' . $i . '">' . $i . '</a>&nbsp;';
    }
}