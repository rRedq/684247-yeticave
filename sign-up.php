<?php

require_once ("init.php");

$categories = get_all_categories($link);
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password', 'name', 'message'];
    $errors = [];
    $errors_light = [];

    foreach ($required as $key){
        if (empty($form[$key])){
            $errors[$key] = 'Это поле надо заполнить';
        }
    }
    foreach ($form as $key => $value) {
        if ($key == 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = 'Введите корректный email';
            }
            else {
                $email = mysqli_real_escape_string($link, $form['email']);
                $sql = "SELECT user_id FROM user WHERE email = '$email'";
                $res = mysqli_query($link, $sql);
                if (mysqli_num_rows($res) > 0) {
                    $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
                }
            }
        }
    }
    $form['avatar'] = "";
    if (isset($_FILES['avatar']) && $_FILES['avatar']['tmp_name'] !== ""){
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $time = time();
        $target_path = 'img/' . $time . '.jpeg';
        $type_info = mime_content_type($tmp_name);

        if ($type_info !== "image/jpeg"){
            $errors_light['avatar'] = 'Неверный тип файла, добавьте файл с расширением jpeg';
        }
        else {
            if (is_uploaded_file($tmp_name) && move_uploaded_file($tmp_name, $target_path)) {
                $form['avatar'] = $target_path;
            } else {
                $errors_light['avatar'] = 'Не удалось сохранить файл';
            }
        }
    }
    if (count($errors)){
        $page_content = include_template('templates/sign-up.php', [
            'form' => $form,
            'errors' => $errors,
            'categories' => $categories,
            'errors_light' => $errors_light
        ]);
    }
    else {
        $password = password_hash($form['password'], PASSWORD_DEFAULT);
        $sql = 'INSERT INTO user (date_registration, email, name, password, contacts, avatar) VALUES (NOW(), ?, ?, ?, ?, ?)';
        $stmt_reg = db_get_prepare_stmt($link, $sql, [$form['email'], $form['name'], $password, $form['message'], $form['avatar']]);
        $res1 = mysqli_stmt_execute($stmt_reg);
        if ($res1 && empty($errors)) {
            header("location: /login.php");
            exit;
        }
    }
}
else {
    $page_content = include_template('templates/sign-up.php', [
    ]);
}
$layout_content = include_template('templates/layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Регистрация',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);
print ($layout_content);