<?php

require_once ("init.php");
require_once ("data_sql.php");

$categories = get_all_categories($link);
$table = get_all_lots($link);

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
print ($layout_content);