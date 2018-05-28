<?php

require_once "functions.php";
require_once "mysql_helper.php";
require_once "data_sql.php";

session_start();

if (isset($_SESSION['user'])) {
    $authenticated_user = $_SESSION['user'];
}
else {
    $authenticated_user = null;
}

date_default_timezone_set('Europe/Moscow');

$link = mysqli_connect('localhost', 'root', '', 'schem')
or die ('Ошибка ' . mysqli_error($link));

mysqli_set_charset($link, "utf8");