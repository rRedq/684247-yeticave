<?php
date_default_timezone_set('Europe/Moscow');

require_once("functions.php");

$link = mysqli_connect('localhost', 'root', '', 'schema')
    or die ('Ошибка ' . mysqli_error($link));
$sql = 'SELECT categories_id, categories_name, css_class FROM categories';
$result = mysqli_query($link, $sql);

$sql_table = "SELECT * FROM lot as c left join categories as u on c.categories_id = u.categories_id";
$result_table = mysqli_query($link, $sql_table);

mysqli_close($link);

$table = mysqli_fetch_all($result_table, MYSQLI_ASSOC);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$page_content = include_template('templates/index.php', [
    'table'=> $table,
    'categories' => $categories]);
$layout_content = include_template('templates/layout.php',  [
	'content' => $page_content,
    'categories' => $categories,
	'title' => 'Главная страница',
	'is_auth' => $is_auth,
	'user_name' => $user_name,
	'user_avatar' => $user_avatar
]);
print($layout_content);