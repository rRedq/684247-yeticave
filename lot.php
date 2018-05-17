<?php
date_default_timezone_set('Europe/Moscow');

require_once("functions.php");

$link = mysqli_connect('localhost', 'root', '', 'schema')
or die ('Ошибка ' . mysqli_error($link));

$sql = 'SELECT categories_id, categories_name, css_class FROM categories';
$result = mysqli_query($link, $sql);

$sql_table = "SELECT * FROM lot as c left join categories as u on c.categories_id = u.categories_id";
$result_table = mysqli_query($link, $sql_table);

if (!isset ($_GET['id'])){
    exit('404');
}

$id = $_GET['id'];

$sql_lot = "SELECT * FROM lot as c LEFT JOIN categories AS u ON c.categories_id = u.categories_id
    WHERE lot_id = ?";
$stmt = mysqli_prepare($link, $sql_lot);
mysqli_stmt_bind_param($stmt, 'i',$id);
mysqli_stmt_execute($stmt);
$result_lot = mysqli_stmt_get_result($stmt);
mysqli_close($link);

$lot = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
$table = mysqli_fetch_all($result_table, MYSQLI_ASSOC);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$lot_content = include_template ('templates/lot.php', [
    'lot'=> $lot
]);
$layout_content = include_template('templates/layout.php',  [
    'content' => $lot_content,
    'categories' => $categories,
    'title' => 'Лот',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);
print ($layout_content);