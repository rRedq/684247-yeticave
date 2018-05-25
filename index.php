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
    'authenticated_user' => $authenticated_user
]);
print ($layout_content);