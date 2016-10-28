<?php
require "inc/config.inc.php";
require "inc/lib.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Результат загрузки файла</title>
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="logo"></div>
<?php
//error_reporting(E_ALL); // Выключаем показ ошибок. Чтобы их видеть - вместо 0 поставьте E_ALL
$max_file_size = 5;
if($_POST['update']=='OK') {
    // СТАРТ Загрузка файла на сервер
    if ($_FILES["filename"]["size"] > $max_file_size * 1024 * 1024) {
        echo '<div class="info">Размер файла превышает ' . $max_file_size . ' Мб!</div>';
        include('form_file_load.php');
        exit;
    }

    if (copy($_FILES["filename"]["tmp_name"], $path . $_FILES["filename"]["name"])) {
        echo("<div class=\"info\">Файл " . "<strong>" . $_FILES["filename"]["name"] . "</strong>" . " успешно загружен!<br></div>");
        include('form_img_load.php');
        }else {
        echo '<div class="info">Ошибка загрузки файла! Возможно открыт файл Excel<br></div>';
        include('form_file_load.php');
        exit;
    }

    //СТАРТ Считывание из файла Excel и запись в БД
    require_once "Excel/reader.php";
    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding("UTF-8"); //Кодировка выходных данных
    $data->read($_FILES["filename"]["name"]);

    for ($i=1; $i<=$data->sheets[0]["numRows"]; $i++){
        $cell1 = addslashes(trim($data->sheets[0]["cells"][$i][1]));
        $cell2 = addslashes(trim($data->sheets[0]["cells"][$i][2]));

        if (trim($cell1) != '') {
            $query  = "INSERT INTO `users` (`user`,`city`
                ) VALUES ('$cell1','$cell2')";
            $row = mysqli_query($dbase, $query);
            if (!$row) {
                die('<div class="info">Ошибочка!</div>');
            }
        }
    }
}else {
    include('form_file_load.php');
}

if($_POST['update2']=='OK') {
    // СТАРТ Загрузка файла на сервер
    if ($_FILES["filename2"]["size"] > $max_file_size * 1024 * 1024) {
        echo '<div class="info">Размер файла превышает ' . $max_file_size . ' Мб!</div>';
        include('form_file_load2.php');
        exit;
    }

    if (copy($_FILES["filename2"]["tmp_name"], $path . $_FILES["filename2"]["name"])) {
        echo("<div class=\"info\">Файл " . "<strong>" . $_FILES["filename2"]["name"] . "</strong>" . " успешно загружен!<br></div>");
        include('form_img_load2.php');
    }
    else {
        echo '<div class="info">Ошибка загрузки файла! Возможно открыт файл Excel<br></div>';
        include('form_file_load2.php');
        exit;
    }

    //СТАРТ Считывание из файла Excel и запись в БД
    require_once "Excel/reader.php";
    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding("UTF-8"); //Кодировка выходных данных
    $data->read($_FILES["filename2"]["name"]);

    for ($i=1; $i<=$data->sheets[0]["numRows"]; $i++){
        $cell1 = addslashes(trim($data->sheets[0]["cells"][$i][1]));
        $cell2 = addslashes(trim($data->sheets[0]["cells"][$i][2]));
        $cell3 = addslashes(trim($data->sheets[0]["cells"][$i][3]));
        $cell4 = addslashes(trim($data->sheets[0]["cells"][$i][4]));

        if (trim($cell1) != '') {
            $query  = "INSERT INTO `goods` (`nam`,`code`,`link`,`pic_link`
                ) VALUES ('$cell1','$cell2','$cell3','$cell4')";
            $row = mysqli_query($dbase, $query);
            if (!$row) {
                die('<div class="info">Ошибочка!</div>');
            }
        }
    }
}else {
    include('form_file_load2.php');
}

if($_POST['del']) {
    clearBd('users');
}

if($_POST['del2']) {
    clearBd('goods');
}

if ($_POST['add_pic']) {
    loadImg();
    echo '<div class="info"><a href="page.php" class="add">Посмотреть результат</a></div>';

}

if ($_POST['add_pic2']) {
    loadImg();
    echo '<div class="info"><a href="page_gdn.php" class="add">Посмотреть результат</a></div>';
}
?>
</body>
</html>