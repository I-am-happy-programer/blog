<?php
include_once ('lib/auth.php');
include_once ('function.php');
require_once('lib/rb.php');
include_once ('lib/function.php');
session_start();
$userdate = checkreg();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/kickstart.js"></script> <!-- KICKSTART -->
<link rel="stylesheet" href="../css/kickstart.css" me charset="" dia="all" />
<link rel="stylesheet" type="text/css" href="../my.css">
</head>
<body>
	<div class="grid">
		<div class="col_12 logo">
			<div class="col_2"><img src="logo.png"/></div>
			<div class="col_5">
			
			</div>
			<div class="col_5">
				<ul class="menu">
					<li class="new"><a class="firstm" href="index.html">Новости</a></li>
					<li class="new"><a class="firstm" href="about.html">Контакты</a></li>
					<li class="new"><a class="firstm" href="admin/register.php">Вход</a></li>
					<li class="new"><a class="firstm" href="admin/mainregister.php">Регистрация</a></li>
				</ul>
			</div>
		</div>
		<div class="col_12"></div>
		<div class="col_12 main">
		<div class="col_2 leftlist">
			<ul class="menu vertical">
			<li class="leftmenu"><a href="index.html">Главные новости</a></li>
					<li class="leftmenu"><a href="12.html">Новости вашего города</a></li>
					<li class="leftmenu"><a href="13.html">Политика</a></li>
					<li class="leftmenu"><a href="https://vk.com/">Спорт</a></li>
					<li class="leftmenu"><a href="https://vk.com/">Религия</a></li>
					<li class="leftmenu"><a href="https://vk.com/">Автомобилистам</a></li>
					<li class="leftmenu"><a href="https://vk.com/">Другое</a></li>
					
		</ul>
	</div>
	
	<div class = "col_10">
		<?php
mailauth();
vkauth();
?>
	</div>


	<div class="col_10">
		<h1 class="mainformat">Главные новости</h1>

	</div>
		<div class="col_7 maintext format">

				<?php
				showmain()>
				//echo "<pre>";print_r($news);

				/*$link=mysqli_connect('localhost','homestead','secret','db-test');
				$res = mysqli_query($link, "SELECT * FROM main_table;");
				$row_cnt = mysqli_num_rows($res);*/
				/*for ($i=$row_cnt; $i != 0; $i--) { 					
				showMinNews($i,'','','');
			}
/* закрытие соединения */
//
				?>
				

</div>
		<div class="col_12 footer"><p class="copy">Copyright
			<div class="col_2 vk"><a href="https://vk.com/"><img src="vk_101783.png" width="60px" height="50px" /></a></div>
			<div class="col_2 instagram"><a href="https://instagram.com/"/><img src="1491580635-yumminkysocialmedia26_83102.png" width="60px" height="50px"/></div>
			<div class="col_2 twitter"><a href="https://twitter.com/"/><img src="twitter8.png" width="75px" height="50px"/></div>
		</div>
	</div>

</body>
</html>