<?php
include_once ('function.php');
require_once('lib/rb.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/kickstart.js"></script> <!-- KICKSTART -->
<link rel="stylesheet" href="css/kickstart.css" me charset="" dia="all" />
<link rel="stylesheet" type="text/css" href="my.css">
</head>
<body>
	<div class="grid">
		<div class="col_12 logo">
			<div class="col_2"><img src="logo.png"/></div>
			<div class="col_6"></div>
			<div class="col_4">
				<ul class="menu">
					<li class="new"><a class="firstm" href="index.html">Новости</a></li>
					<li class="new"><a class="firstm" href="about.html">Контакты</a></li>
					<li class="new"><a class="firstm" href="https://vk.com/">Поддержка</a></li>
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

	<div class="col_10">
<?php
if (isset($_GET['id'])) 
{
				R::setup( 'mysql:host=localhost;dbname=db-test','homestead', 'secret' ); 			
				$news = R::find('news', 'id LIKE ? ', [$_GET['id']]);
				//$news = R::find('news', 'id LIKE 1 ');
				foreach ($news as $new) {
					showFullNews($new['id'],$new['title'],$new['stext'],$new['ftext']);
					}	
					
				
}

?>
</div>
<div class="col_12 footer"><p class="copy">Copyright
			<div class="col_2 vk"><a href="https://vk.com/"><img src="vk_101783.png" width="60px" height="50px" /></a></div>
			<div class="col_2 instagram"><a href="https://instagram.com/"/><img src="1491580635-yumminkysocialmedia26_83102.png" width="60px" height="50px"/></div>
			<div class="col_2 twitter"><a href="https://twitter.com/"/><img src="twitter8.png" width="75px" height="50px"/></div>
		</div>
	</div>

</body>	