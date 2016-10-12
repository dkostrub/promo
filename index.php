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
error_reporting(E_ALL); // Выключаем показ ошибок. Чтобы их видеть - вместо 0 поставьте E_ALL
include('db_conn.php');
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
        }
    else {
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
}
else {
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
}
else {
    include('form_file_load2.php');
}

if($_POST['del']) {
    $query = "TRUNCATE `tovari`";
    $row = mysqli_query($dbase, $query);
    die('<div class="info">База почищена! Можно загружать файл.</div>');
}

if($_POST['del2']) {
    $query = "TRUNCATE `goods`";
    $row = mysqli_query($dbase, $query);
    die('<div class="info">База почищена! Можно загружать файл.</div>');
}

if ($_POST['add_pic']) {
    $pic_weight = 3000;
    $pic_height = 3000;
    if ($_FILES['file']['name'])
    {
        echo '<div class="info">Файл загружен.<br/><br/><a href="page.php" class="add">Посмотреть результат</a></div>';
        //пролистываем весь массив изображений по одному $_FILES['file']['name'] as $k=>$v
        foreach ($_FILES['file']['name'] as $k=>$v)
        {
            //директория загрузки
            $uploaddir = "images/";
            $apend=$v;
            //путь к новому изображению
            $uploadfile = "$uploaddir$apend";

            //Проверка расширений загружаемых изображений
            if($_FILES['file']['type'][$k] == "image/gif" || $_FILES['file']['type'][$k] == "image/png" ||
                $_FILES['file']['type'][$k] == "image/jpg" || $_FILES['file']['type'][$k] == "image/jpeg")
            {
                //черный список типов файлов
                $blacklist = array(".php", ".phtml", ".php3", ".php4");
                foreach ($blacklist as $item)
                {
                    if(preg_match("/$item\$/i", $_FILES['file']['name'][$k]))
                    {
                        echo "Нельзя загружать скрипты.";
                        exit;
                    }
                }
                //перемещаем файл из временного хранилища
                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $uploadfile))
                {
                    //получаем размеры файла
                    $size = getimagesize($uploadfile);
                    //проверяем размеры файла, если они нам подходят, то оставляем файл
                    if ($size[0] < $pic_weight && $size[1] < $pic_height)
                    {
//                        echo '<div class="info">Файл загружен.<br/><br/><a href="page.php" class="add">Посмотреть результат</a></div>';
                    }
                    //если размеры файла нам не подходят, то удаляем файл unlink($uploadfile);
                    else
                    {
                        echo "<center><br>Размер пикселей превышает допустимые нормы.</center>";
                        unlink($uploadfile);
                    }
                }
                else
                    echo "<center><br>Файл не загружен, вернитесь и попробуйте еще раз.</center>";
            }
            else
                echo "<center><br>Можно загружать только изображения в форматах jpg, jpeg, gif и png.</center>";
        }
    }
}

if ($_POST['add_pic2']) {
    $pic_weight = 3000;
    $pic_height = 3000;
    if ($_FILES['file']['name'])
    {
        echo '<div class="info">Файл загружен.<br/><br/><a href="page_gdn.php" class="add">Посмотреть результат</a></div>';
        //пролистываем весь массив изображений по одному $_FILES['file']['name'] as $k=>$v
        foreach ($_FILES['file']['name'] as $k=>$v)
        {
            //директория загрузки
            $uploaddir = "images/gdn/";
            $apend=$v;
            //путь к новому изображению
            $uploadfile = "$uploaddir$apend";

            //Проверка расширений загружаемых изображений
            if($_FILES['file']['type'][$k] == "image/gif" || $_FILES['file']['type'][$k] == "image/png" ||
                $_FILES['file']['type'][$k] == "image/jpg" || $_FILES['file']['type'][$k] == "image/jpeg")
            {
                //черный список типов файлов
                $blacklist = array(".php", ".phtml", ".php3", ".php4");
                foreach ($blacklist as $item)
                {
                    if(preg_match("/$item\$/i", $_FILES['file']['name'][$k]))
                    {
                        echo "Нельзя загружать скрипты.";
                        exit;
                    }
                }
                //перемещаем файл из временного хранилища
                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $uploadfile))
                {
                    //получаем размеры файла
                    $size = getimagesize($uploadfile);
                    //проверяем размеры файла, если они нам подходят, то оставляем файл
                    if ($size[0] < $pic_weight && $size[1] < $pic_height)
                    {
//                        echo '<div class="info">Файл загружен.<br/><br/><a href="page.php" class="add">Посмотреть результат</a></div>';
                    }
                    //если размеры файла нам не подходят, то удаляем файл unlink($uploadfile);
                    else
                    {
                        echo "<center><br>Размер пикселей превышает допустимые нормы.</center>";
                        unlink($uploadfile);
                    }
                }
                else
                    echo "<center><br>Файл не загружен, вернитесь и попробуйте еще раз.</center>";
            }
            else
                echo "<center><br>Можно загружать только изображения в форматах jpg, jpeg, gif и png.</center>";
        }
    }
}
?>
</body>
</html>