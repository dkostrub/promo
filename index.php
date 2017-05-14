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
<div class="wrap">
	<!--<header class="top">
		<div class="logo"></div>
	</header>-->

	<!--<nav>
		<ul>
			<li><a href="#" class="active">Главная</a></li>
			<li><a href="#">О нас</a></li>
			<li><a href="#">Контакты</a></li>
			<li><a href="#">Архивы новостей</a></li>
		</ul>
	</nav>-->
	<main>
		<header>
			<h1 class="text">Что будем делать?</h1>
		</header>
		<div class="select">
			<a class="btn" data-form="optimisationPic">Оптимизировать картики</a>
			<a class="btn" data-form="htmlTable">Сформировать таблицу</a>
			<a class="btn" data-form="htmlPage">Сформировать страницу товаров</a>
		</div>
		<div class="select_form">
			<?php
			if($_POST['update']) {
				$data = $_FILES["filename"]["tmp_name"];
				loadExcelFile($data, $dbase);
				echo '<div class="info"><a href="users.php" class="add">Посмотреть результат</a></div>';
			}

			include('form_file_load.php');
			include('form_img_load.php');


			/*if($_POST['update2']=='OK') {
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
			}*/

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
		</div>
	</main>
	<footer>
		<p>&copy; <?=date('Y')?> ООО &laquo;Рога и копыта&raquo;. Свои права мы держим в надёжном месте.</p>
	</footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>