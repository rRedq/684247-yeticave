<?php

require_once ("init.php");

session_start();

$categories = get_all_categories($link);
$table = get_all_lots($link);

$user_name = "";
$user_avatar = "";
if (isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $user_name = $user['name'];
    $user_avatar = $user['avatar'];
}
$page_content = include_template('templates/index.php', [
    'table'=> $table,
    'categories' => $categories]);
$layout_content = include_template('templates/layout.php',  [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Главная страница',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);
print ($layout_content);