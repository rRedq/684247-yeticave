<?php

require_once ("init.php");

$categories = get_all_categories($link);
$table = get_all_lots($link);

$page_content = include_template('templates/index.php', [
    'table'=> $table,
    'categories' => $categories
]);
$layout_content = include_template('templates/layout.php',  [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Главная страница',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'is_auth' => $is_auth
]);
print ($layout_content);