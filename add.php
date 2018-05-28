<?php

require_once ("init.php");

If (! isset($authenticated_user)) {
    http_response_code(403);
    die();
}
$author = intval($authenticated_user['user_id']);
$categories = get_all_categories($link);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['lot_name', 'category', 'description', 'lot_rate', 'lot_step', 'lot_date'];
    $errors = [];

    foreach ($lot as $key => $value) {
        if($key == 'lot_rate') {
            if (!filter_var($value, FILTER_VALIDATE_INT)){
                $errors[$key] = 'Только числа';
            }
        }
        elseif ($key == 'lot_step') {
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                $errors[$key] = 'Только числа';
            }
        }
        elseif ($key == 'lot_date') {
            if ((strtotime($value) - time()) <= 86400) {
                 $errors[$key] = 'Не менее 24 часов';
            }
        }
    }
    foreach ($required as $key) {
        if (empty($lot[$key])) {
            $errors[$key] = 'Заполните поле';
        }
    }
    $lot['path'] = "";
    if (isset($_FILES['lot_img']) && $_FILES['lot_img']['tmp_name'] !== "") {
        $tmp_name = $_FILES['lot_img']['tmp_name'];
        $time = time();
        $target_path = 'img/' . $time . '.jpeg';
        $type_info = mime_content_type($tmp_name);

        if ($type_info !== "image/jpeg") {
            $errors['lot_img'] = 'Неверный тип файла, добавьте файл с расширением jpeg';
        }
        else {
            if (is_uploaded_file($tmp_name) && move_uploaded_file($tmp_name, $target_path)) {
                $lot['path'] = $target_path;
            } else {
                $errors['lot_img'] = 'Не удалось сохранить файл';
            }
        }
    }
    else {
        $errors = 'Не загружен файл';
    }
    if (count($errors)) {
        $page_content = include_template('templates/add.php', [
            'lot' => $lot,
            'errors' => $errors,
            'categories' => $categories
        ]);
    }
    else {
        $sql_lot = 'INSERT INTO lot (date_start, lot_name,categories_id, description_lot,start_price,step_bet,date_end, image, user_author_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt_lot = db_get_prepare_stmt($link, $sql_lot, [$lot['lot_name'], $lot['category'], $lot['description'], $lot['lot_rate'],$lot['lot_step'], $lot['lot_date'], $lot['path'], $author]);
        $res = mysqli_stmt_execute($stmt_lot);
        if ($res) {
            $i_id = mysqli_insert_id($link);
            header("location: lot.php?id=" . $i_id);
            exit;
        }
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
    'authenticated_user' => $authenticated_user
]);

print ($layout_content);