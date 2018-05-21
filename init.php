<?php
date_default_timezone_set('Europe/Moscow');

require_once("functions.php");
require_once ("mysql_helper.php");
require_once ("data_sql.php");

$link = mysqli_connect('localhost', 'root', '', 'schema')
or die ('Ошибка ' . mysqli_error($link));