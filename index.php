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
		<?php $client_id = '763974'; // ID ДЛЯ МЫЛА 
	$client_secret = 'd2b920e8e8955e07e32ad661a0164d27'; // Секретный ключ
	$redirect_uri = 'http://palshin.lan/index.php'; // Ссылка на приложение
	$url = 'https://connect.mail.ru/oauth/authorize';
	$paramet = array(
	    'client_id'     => $client_id,
	    'response_type' => 'code',
      'redirect_uri'  => $redirect_uri
	);
	echo $linkmail = '<p><a href="' . $url . '?' . urldecode(http_build_query($paramet)) . '">Аутентификация через Mail.ru</a></p>';
	if (isset($_GET['code'])) {
    $result = false;

  $paramet = array(
        'client_id'     => $client_id,
        'client_secret' => $client_secret,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code'],
        'redirect_uri'  => $redirect_uri
    );}
    $url = 'https://connect.mail.ru/oauth/token';
    $curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);

$tokenInfo = json_decode($result, true);
if (isset($tokenInfo['access_token'])) {
    $sign = md5("app_id={$client_id}method=users.getInfosecure=1session_key={$tokenInfo['access_token']}{$client_secret}");

    $paramet = array(
        'method'       => 'users.getInfo',
        'secure'       => '1',
        'app_id'       => $client_id,
        'session_key'  => $tokenInfo['access_token'],
        'sig'          => $sign
    );
    $paramet = array(
    'method'       => 'users.getInfo',
    'secure'       => '1',
    'app_id'       => $client_id,
    'session_key'  => $tokenInfo['access_token'],
    'sig'          => $sign
);

$userInfo = json_decode(file_get_contents('http://www.appsmail.ru/platform/api' . '?' . urldecode(http_build_query($params))), true);

}
if (isset($userInfo[0]['uid'])) {
    $userInfo = array_shift($userInfo);
    $result = true;
}
if ($result) {
    echo "Социальный ID пользователя: " . $user Info['uid'] . '<br />';
    echo "Имя пользователя: " . $userInfo['nick'] . '<br />';
    echo "Email: " . $userInfo['email'] . '<br />';
    echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
    echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
    echo "День Рождения: " . $userInfo['birthday'] . '<br />';
    echo '<img src="' . $userInfo['pic_small'] . '" />'; echo "<br />";
}

	?>
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
		/*$userdate = checkreg();
		if ( $userdate == false){
			echo "<p class = 'reginfo'>Вы вошли как гость. <a href='admin/register.php'>Войти в	 аккаунт</a>";
		}
		
else 
{

	//echo "<p class = 'reginfo'>Добро пожаловать $userdate <a href='admin/logout.php'>Выйти</a>";
/*echo $userdate.'   ';
echo '<a href="/admin/logout.php">Войти в другой аккаунт</a>';
}	*/
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
if(isset ($_SESSION['token']) && !empty( $_SESSION['token']) && isset($userId)){
$token = $_SESSION['token']; // Извлекаем токен из сессии
 

// Формируем запрос
$params = array(
    'v' => '5.92', // Версия API
    'access_token' => $token, // Токен
    'user_ids' => $userId,	 // ID пользователей
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

echo "<p class = 'reginfo'>Добро пожаловать, $userItem->first_name $userItem->last_name <a href='admin/logout.php'>Выйти</a>";
//echo $userItem->first_name;
//echo $userItem->last_name;
}
else
{
$userdate = checkreg();
		if ( $userdate == false){
			echo "<p class = 'reginfo'>Вы вошли как гость. <a href='admin/register.php'>Войти в	 аккаунт</a>";
		}
		
else 
{
	echo "<p class = 'reginfo'>Добро пожаловать $userdate <a href='admin/logout.php'>Выйти</a>";

}	
}
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
</html>