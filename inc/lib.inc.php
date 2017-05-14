<?php
function loadImg (){
	require_once("vendor/autoload.php");

//	\Tinify\setKey("ceMsbO6RJtKhK6Fg-xt2Qv-05pPEq4Fv");

	if (isset($_POST['add_pic'])) {
		$supported_image = array('gif', 'jpg', 'jpeg', 'png');

		if (isset($_FILES['file']['name'])) {

			foreach ($_FILES['file']['name'] as $k=>$v) {
				$image = $v;

				$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

				if (in_array($ext, $supported_image)) {
					if (!file_exists(getcwd() . '/uploads')) {
						mkdir(getcwd() . '/uploads', 0777);
					}

					move_uploaded_file($_FILES['file']['tmp_name'][$k], getcwd() . '/uploads/' . $image);

					//optimize image using TinyPNG
					try {
						\Tinify\setKey("ceMsbO6RJtKhK6Fg-xt2Qv-05pPEq4Fv");
						\Tinify\validate();
						$source = \Tinify\fromFile(getcwd(). '/uploads/'.$image);
						$source->toFile(getcwd(). '/uploads/'.$image);

					} catch(\Tinify\Exception $e) {
						echo "<p class='text-info-error'>Validation of API key failed.</p>";
					}


//					catch(\Tinify\AccountException $e) {
//						print("The error message is: " . $e->getMessage());
//						// Verify your API key and account limit.
//					} catch(\Tinify\ClientException $e) {
//						// Check your source image and request options.
//					} catch(\Tinify\ServerException $e) {
//						// Temporary issue with the Tinify API.
//					} catch(\Tinify\ConnectionException $e) {
//						// A network connection error occurred.
//					}


					$compressionsThisMonth = (500 - \Tinify\compressionCount());
					echo "<p class='text-info'>Файл успешно оптимизирован!  Осталось " .$compressionsThisMonth. " загрузок</p>";
				} else {
					echo "<p class='text-info-error'>Файл не загружен!</p>";
				}
			}
		}
	}
}

function loadExcelFile($data, $dbase){
	require 'Classes/PHPExcel/IOFactory.php';

	$path = "uploads/";
	if(!is_dir($path)) mkdir($path) ;

	/*$max_file_size = 5;
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
	}*/

	$file =  $data;
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
