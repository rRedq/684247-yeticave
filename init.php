<?php

require_once "functions.php";
require_once "mysql_helper.php";
require_once "data_sql.php";

session_start();

$user_name = "";
$user_avatar = "";
if (isset($_SESSION['user'])) {
    $is_auth = $_SESSION['user'];
    $user_name = $is_auth['name'];
    $user_avatar = $is_auth['avatar'];
}
else {
    $is_auth = null;
}

date_default_timezone_set('Europe/Moscow');

$link = mysqli_connect('localhost', 'root', '', 'schema')
or die ('Ошибка ' . mysqli_error($link));

mysqli_set_charset($link, "utf8");