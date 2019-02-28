<?php

function vkauth()
{
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

if ( isset( $_GET['code']) ) {

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
if(!empty($userId) && isset($userId))
{
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

}
    if(empty($userItem))
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
}

function mailauth()
{
    $client_id = '763974'; // ID ДЛЯ МЫЛА
    $client_secret = 'd2b920e8e8955e07e32ad661a0164d27'; // Секретный ключ
    $redirect_uri = 'http://palshin.lan/index.php'; // Ссылка на приложение
    $url = 'https://connect.mail.ru/oauth/authorize';
    $param = array(
        'client_id'     => $client_id,
        'response_type' => 'code',
        'redirect_uri'  => $redirect_uri
    );
    if (isset($_GET['code'])) {
        $result = false;

        $param = array(
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
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($param)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

    $tokenInfo = json_decode($result, true);
    if (isset($tokenInfo['access_token'])) {
        $sign = md5("app_id={$client_id}method=users.getInfosecure=1session_key={$tokenInfo['access_token']}{$client_secret}");

        $param = array(
            'method'       => 'users.getInfo',
            'secure'       => '1',
            'app_id'       => $client_id,
            'session_key'  => $tokenInfo['access_token'],
            'sig'          => $sign
        );
        $param = array(
            'method'       => 'users.getInfo',
            'secure'       => '1',
            'app_id'       => $client_id,
            'session_key'  => $tokenInfo['access_token'],
            'sig'          => $sign
        );

        $userInfo = json_decode(file_get_contents('http://www.appsmail.ru/platform/api' . '?' . urldecode(http_build_query($param))), true);

    }
    if (isset($userInfo[0]['uid'])) {
        $userInfo = array_shift($userInfo);
        $result = true;
    }
    if(!empty($userInfo) && isset($userInfo)){
        if ($result) {
            echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
            echo "Имя пользователя: " . $userInfo['nick'] . '<br />';
            echo "Email: " . $userInfo['email'] . '<br />';
            echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
            echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
            echo "День Рождения: " . $userInfo['birthday'] . '<br />';
            echo '<img src="' . $userInfo['pic_small'] . '" />';
            echo "<br />";
        }
    }

}
?>