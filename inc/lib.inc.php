<?php
function loadImg (){
    $pic_weight = 3000;
    $pic_height = 3000;
    if ($_FILES['file']['name']){
        echo '<div class="info">Файл загружен.</div>';
        foreach ($_FILES['file']['name'] as $k=>$v) {
            $uploaddir = "images/";
            $apend=$v;
            //путь к новому изображению
            $uploadfile = "$uploaddir.$apend";

            //Проверка расширений загружаемых изображений
            if($_FILES['file']['type'][$k] == "image/gif" || $_FILES['file']['type'][$k] == "image/png" ||
                $_FILES['file']['type'][$k] == "image/jpg" || $_FILES['file']['type'][$k] == "image/jpeg") {
                //черный список типов файлов
                $blacklist = array(".php", ".phtml", ".php3", ".php4");
                foreach ($blacklist as $item){
                    if(preg_match("/$item\$/i", $_FILES['file']['name'][$k])) {
                        echo "Нельзя загружать скрипты.";
                        exit;
                    }
                }
                //перемещаем файл из временного хранилища
                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $uploadfile)) {
                    $size = getimagesize($uploadfile);
                    if ($size[0] < $pic_weight && $size[1] < $pic_height){
//                        echo '<div class="info">Файл загружен.<br/><br/><a href="page.php" class="add">Посмотреть результат</a></div>';
                    }else{
                        echo "<center><br>Размер пикселей превышает допустимые нормы.</center>";
                        unlink($uploadfile);
                    }
                }else
                    echo "<center><br>Файл не загружен, вернитесь и попробуйте еще раз.</center>";
            }else
                echo "<center><br>Можно загружать только изображения в форматах jpg, jpeg, gif и png.</center>";
        }
    }
}

function clearBd($data){
    global $dbase;
    $query = "TRUNCATE `$data`";
    mysqli_query($dbase, $query);
    die('<div class="info">База почищена! Можно загружать файл.</div>');
}
