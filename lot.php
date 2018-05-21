<?php

require_once ("init.php");

if (!isset ($_GET['id'])){
    exit('404');
}

$lot_id = (int)$_GET['id'];

$sql_lot = "SELECT lot_name, image,description_lot, step_bet, date_end, categories_name FROM lot as c LEFT JOIN categories AS u ON c.categories_id = u.categories_id
    WHERE lot_id = ?";
$lot_stmt = db_get_prepare_stmt($link, $sql_lot, [$lot_id]);
mysqli_stmt_execute($lot_stmt);
$result_lot = mysqli_stmt_get_result($lot_stmt);

$lot = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
$categories = get_all_categories($link);

$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$lot_content = include_template ('templates/lot.php', [
    'lot'=> $lot
]);
 foreach ($lot as $value) {
     $layout_content = include_template('templates/layout.php', [
         'content' => $lot_content,
         'categories' => $categories,
         'title' => htmlspecialchars($value['lot_name']),
         'is_auth' => $is_auth,
         'user_name' => $user_name,
         'user_avatar' => $user_avatar
     ]);
 }
print ($layout_content);