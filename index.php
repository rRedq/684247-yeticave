<?php
date_default_timezone_set('Europe/Moscow');

require_once("functions.php");

$link = mysqli_connect('localhost', 'root', '', 'schema')
    or die ('Ошибка ' . mysqli_error($link));
$sql = 'SELECT * FROM categories';
$result = mysqli_query($link, $sql);

$sql_table = "SELECT  lot_name,start_price,image, categories_id FROM lot";
$result_table = mysqli_query($link, $sql_table);

mysqli_close($link);

$table = mysqli_fetch_all($result_table, MYSQLI_ASSOC);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$page_content = include_template('templates/index.php', ['table'=> $table]);
$layout_content = include_template('templates/layout.php',  [
	'content' => $page_content,
    'categories' => $categories,
	'title' => 'Главная страница',
	'is_auth' => $is_auth,
	'user_name' => $user_name,
	'user_avatar' => $user_avatar
]);
print($layout_content);