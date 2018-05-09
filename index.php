<?php
date_default_timezone_set('Europe/Moscow');

require_once("functions.php");
$table = [
	[
	    'name' => '2014 Rossignol District Snowboard',
		'category' => 'Доски и лыжи',
		'price' => '10999',
		'url' => 'img/lot-1.jpg',
	],
	[
		'name' => 'DC Ply Mens 2016/2017 Snowboard',
		'category' => 'Доски и лыжи',
		'price' => '159999',
		'url' => 'img/lot-2.jpg',
	],
	[
		'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
		'category' => 'Крепления',
		'price' => '8000',
		'url' => 'img/lot-3.jpg',
	],
    [
		'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
		'category' => 'Ботинки',
		'price' => '10999',
		'url' => 'img/lot-4.jpg'
    ],
    [
		'name' => 'Куртка для сноуборда DC Mutiny Charocal',
		'category' => 'Одежда',
		'price' => '7500',
		'url' => 'img/lot-5.jpg',
    ],
    [
		'name' => 'Маска Oakley Canopy',
		'category' => 'Разное',
		'price' => '5400',
		'url' => 'img/lot-6.jpg',
    ]
];

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

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