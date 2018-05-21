<?php

require_once ("init.php");
require_once ("data_sql.php");

$categories = get_all_categories($link);
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['lot_name', 'category', 'description', 'lot_rate', 'lot_step', 'lot_date'];
    $errors = [];

    foreach ($lot as $key => $value) {
        if($key == 'lot_rate'){
            if (!filter_var($value, FILTER_VALIDATE_INT)){
                $errors[$key] = 'Только числа';
            }
        }
        elseif ($key == 'lot_step'){
            if (!filter_var($value, FILTER_VALIDATE_INT)){
                $errors[$key] = 'Только числа';
            }
        }
        elseif ($key == 'lot_date') {
            if (!validateDate($value)){
                $errors[$key] = 'Не корректно задана дата';
            }
            elseif ((strtotime($value) - time(now)) <= 86400){
                 $errors[$key] = 'Не менее 24 часов';
            }

        }
    }

    foreach ($required as $key) {
        if (empty($lot[$key])) {
            $errors[$key] = 'Заполните поле';
        }
    }
    if (isset($_FILES['lot_img'])){
        $tmp_name = $_FILES['lot_img']['tmp_name'];
        $path = $_FILES['lot_img']['name'];
        $type_info = mime_content_type($tmp_name);

        if ($type_info !== "image/jpeg"){
        }
        else{
            move_uploaded_file($tmp_name, 'img/' . $path);
            $lot['path'] = $path;
        }
        }
    $sql_lot = 'INSERT INTO lot (date_start, lot_name,categories_id, description_lot,start_price,step_bet,date_end, image) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)';
    $stmt_lot = db_get_prepare_stmt($link, $sql_lot, ['lot_name', 'category', 'description', 'lot_rate','lot_step','lot_date', 'path']);
    $res = mysqli_stmt_execute($stmt_lot);
    if ($res){
        $i_id = mysqli_insert_id($link);
        header("location: lot.php?id=" . $i_id);
    }
    if (count($errors)){
        $page_content = include_template('templates/add.php', [
            'lot' => $lot,
            'errors' => $errors,
            'categories' => $categories
        ]);
    }
    else {

    }

}
else {

$page_content = include_template('templates/add.php', [
    'categories' => $categories
]);
    }
$layout_content = include_template('templates/layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Новый лот',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

print ($layout_content);