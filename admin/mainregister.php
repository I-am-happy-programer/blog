<?php
require_once('../lib/rb.php');
require_once('../lib/function.php');
session_start();
$userdate = checkreg();
//if ( $userdate == false){
RegIn();   
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/kickstart.js"></script> <!-- KICKSTART -->
<link rel="stylesheet" href="../css/kickstart.css" me charset="" dia="all" />
<link rel="stylesheet" type="../text/css" href="my.css">
</head>
<body>
	<div class="grid">
		<div class="col_12 logo">
			<div class="col_2"><img src="../logo.png"/></div>
			<div class="col_5"></div>
			<div class="col_5">
				<ul class="menu">
					<li class="new"><a class="firstm" href="../index.html">Новости</a></li>
					<li class="new"><a class="firstm" href="about.html">Контакты</a></li>
					<li class="new"><a class="firstm" href="admin/index.php">Вход</a></li>
					<li class="new"><a class="firstm" href="register.php">Регистрация</a></li>
				</ul>
			</div>
		</div>
		<div class="col_4">
		</div>
		<div class="col_4">
			<fieldset>
				<?php
				
				?>
 <legend>Регистрация</legend>
 <form action="mainregister.php" method="post">
 	<div>
 		<label for="name">Логин</label>
 		<input type="text" name="login" id="name" value="" tabindex="1" />
 	</div>
  	<div>
 		<label for="name">Пароль</label>
 		<input type="password" name="password" id="name" value="" tabindex="1" />
 	</div> 
 	<div>
 		<label for="name">Эл. почта</label>
 		<input type="text" name="email" id="name" value="" tabindex="1" />
 	</div> 
 	<div>
 		<input type="submit" name="btnReg" value="Зарегестрироваться" />
 	</div>
 </form>
</fieldset>
		</div>
		<div class="col_12 footer"><p class="copy">Copyright
			<div class="col_2 vk"><a href="https://vk.com/"><img src="../vk_101783.png" width="60px" height="50px" /></a></div>
			<div class="col_2 instagram"><a href="https://instagram.com/"/><img src="../1491580635-yumminkysocialmedia26_83102.png" width="60px" height="50px"/></div>
			<div class="col_2 twitter"><a href="https://twitter.com/"/><img src="../twitter8.png" width="75px" height="50px"/></div>
		</div>
	</div>
