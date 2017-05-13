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

function loadExcelFile($data, $dbase){
	require 'Classes/PHPExcel/IOFactory.php';

	$max_file_size = 5;
	// СТАРТ Загрузка файла на сервер
	if ($_FILES["filename"]["size"] > $max_file_size * 1024 * 1024) {
		echo '<div class="info">Размер файла превышает ' . $max_file_size . ' Мб!</div>';
		include('form_file_load.php');
		exit;
	}

	if (copy($_FILES["filename"]["tmp_name"], $path . $data)) {
		echo("<div class=\"info\">Файл " . "<strong>" . $data . "</strong>" . " успешно загружен!<br></div>");
		include('form_img_load.php');
	}else {
		echo '<div class="info">Ошибка загрузки файла! Возможно открыт файл Excel<br></div>';
		include('form_file_load.php');
		exit;
	}

	$file = $data;
	$exceldata = array();

	//  Read your Excel workbook
	try {
		$fileType = PHPExcel_IOFactory::identify($file);
		$objReader = PHPExcel_IOFactory::createReader($fileType);
		$objPHPExcel = $objReader->load($file);
	}
	catch(Exception $e) {
		die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
	}

	//  Get worksheet dimensions
	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();

	for ($row = 1; $row <= $highestRow; $row++) {
		//  Read a row of data into an array
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

		$sql = "INSERT INTO users (user, city)
			VALUES ('".$rowData[0][0]."', 
					'".$rowData[0][1]."'
					)";

		if (mysqli_query($dbase, $sql)) {
			$exceldata[] = $rowData[0];
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbase);
		}
	}

	// Print excel data
	/*echo "<table>";
	foreach ($exceldata as $index => $excelraw) {
		echo "<tr>";
		foreach ($excelraw as $excelcolumn)
		{
			echo "<td>".$excelcolumn."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";*/

	mysqli_close($dbase);
}

function clearBd($data){
    global $dbase;
    $query = "TRUNCATE `$data`";
    mysqli_query($dbase, $query);
    die('<div class="info">База почищена! Можно загружать файл.</div>');
}
