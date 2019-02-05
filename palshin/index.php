<?php
include_once ('function.php');
require_once('lib/rb.php');
include_once ('lib/function.php');
session_start();
$userdate = checkreg();
if ( $userdate == false){
//header("Location: admin/register.php");
//exit;
}
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
	$clientId = '6847267'; // ID приложения
	$clientSecret = 'leU3jzouM941Y8ApGd38'; // Защищённый ключ
	$redirectUri = 'http://palshin.lan/index.php'; // Адрес сайта
	$url = 'http://oauth.vk.com/authorize';	
	// Формируем ссылку для авторизации
$params = array(
	'client_id'     => $clientId,
	'redirect_uri'  => $redirectUri,
	'response_type' => 'code',
	'v'             => '5.92', // (обязательный параметр) версия API, которую Вы используете https://vk.com/dev/versions
 
	// Права доступа приложения
	// Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
	// Если не указать "offline", то полученный токен будет жить 12 часов.
	'scope'         => 'photos,offline',
);
 
// Выводим на экран ссылку для открытия окна диалога авторизации
echo '<a href="http://oauth.vk.com/authorize?' . http_build_query( $params ) . '">Авторизация через ВКонтакте</a>';
		?>
		<?php
		$userdate = checkreg();
		if ( $userdate == false){
			echo "<p class = 'reginfo'>Вы вошли как гость. <a href='admin/register.php'>Войти в	 аккаунт</a>";
		}
else
{
	echo "<p class = 'reginfo'>Добро пожаловать $userdate <a href='admin/logout.php'>Выйти</a>";
/*echo $userdate.'   ';
echo '<a href="/admin/logout.php">Войти в другой аккаунт</a>';*/
}
if ( isset( $_GET['code'] ) ) {
 
	$params = array(
		'client_id'     => $clientId,
		'client_secret' => $clientSecret,
		'code'          => $_GET['code'],
		'redirect_uri'  => $redirectUri
	);
 
	if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
		$error = error_get_last();
		throw new Exception('HTTP request failed. Error: ' . $error['message']);
	}
 
	$response = json_decode($content);
 
	// Если при получении токена произошла ошибка
	if (isset($response->error)) {
		throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
	}
 
	$token = $response->access_token; // Токен
	$expiresIn = $response->expires_in; // Время жизни токена
	$userId = $response->user_id; // ID авторизовавшегося пользователя
 
	// Сохраняем токен в сессии
	$_SESSION['token'] = $token;
 
 
} elseif ( isset( $_GET['error'] ) ) { // Если при авторизации произошла ошибка
 
	throw new Exception( 'При авторизации произошла ошибка. Error: ' . $_GET['error']
	                     . '. Error reason: ' . $_GET['error_reason']
	                     . '. Error description: ' . $_GET['error_description'] );
}

$token = $_SESSION['token']; // Извлекаем токен из сессии
 
// Формируем запрос
$params = array(
    'v' => '5.74', // Версия API
    'access_token' => $token, // Токен
    'user_ids' => '1,201275649,155797683', // ID пользователей
    'fields' => 'photo_100,about' // Список опциональных полей https://vk.com/dev/objects/user
);
 
if (!$content = @file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($params))) {
    $error = error_get_last();
    throw new Exception('HTTP request failed. Error: ' . $error['message']);
}
 
$response = json_decode($content);
 
// Если возникла ошибка
if (isset($response->error)) {
    throw new Exception('При отправке запроса к API VK возникла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
}
 
$response = $response->response;
 
foreach ($response as $userItem) {
    $userItem->id; // ID пользователя
    $userItem->first_name; // Имя
    $userItem->last_name; // Фамилия
    $userItem->photo_100; // Фотография
}
echo $userItem->first_name;
echo $userItem->last_name;
echo $userItem->id
?>
	</div>


	<div class="col_10">
		<h1 class="mainformat">Главные новости</h1>

	</div>
		<div class="col_7 maintext format">

				<?php
				R::setup( 'mysql:host=localhost;dbname=db-test','homestead', 'secret' ); 

				$news= R::findAll( 'news' );
				//echo $news['title'];
				foreach ($news as $new) {
					showMinNews($new['id'],$new['title'],$new['stext'],$new['ftext']);

				//		;
				}
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
