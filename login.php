<?php

require_once ("init.php");

$categories = get_all_categories($link);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $errors = [];

    foreach ($required as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Это поле надо заполнить';
        }
    }
    if (! count($errors)) {
        $email = mysqli_real_escape_string($link, $form['email']);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $res = mysqli_query($link, $sql);
        $res_user = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $user = $res_user;

        if (isset($user)) {
            if (password_verify($form['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                header("location: index.php");
                exit;
            }
            else {
                $errors['password'] = 'Неверный пароль';
            }
        }
        else {
            $errors['email'] = 'Такой пользователь не найден';
        }
    }
    if (count($errors)) {
        $page_content = include_template ('templates/login.php', [
            'form' => $form,
            'errors' => $errors
        ]);
    }
}
else {
    $page_content = include_template ('templates/login.php', [
    ]);
}
$layout_content = include_template('templates/layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Вход',
    'is_auth' => $is_auth
]);
print ($layout_content);