<?php

function vk()
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
echo '<a href="http://oauth.vk.com/authorize?' . http_build_query( $params ) . '">Авторизация через ВКонтакте</a>';
}

function mailru()
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
    echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($param)) . '">Авторизация через Mail.ru</a></p>';
}

?>