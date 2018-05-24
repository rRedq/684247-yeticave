<?php

require_once ("init.php");

session_start();

if (!isset ($_GET['id'])){
    exit('Ошибка 404');
}
$lot_id = (int)$_GET['id'];

$sql_lot = "SELECT lot_name, image,description_lot, step_bet, date_end, categories_name FROM lot as c LEFT JOIN categories AS u ON c.categories_id = u.categories_id
    WHERE lot_id = ?";
$lot_stmt = db_get_prepare_stmt($link, $sql_lot, [$lot_id]);
mysqli_stmt_execute($lot_stmt);
$result_lot = mysqli_stmt_get_result($lot_stmt);

$lot = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
$categories = get_all_categories($link);

$user_name = "";
$user_avatar = "";
if (isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $user_name = $user['name'];
    $user_avatar = $user['avatar'];
}
$lot_content = include_template ('templates/lot.php', [
    'lot'=> $lot
]);
 foreach ($lot as $value) {
     $layout_content = include_template('templates/layout.php', [
         'content' => $lot_content,
         'categories' => $categories,
         'title' => htmlspecialchars($value['lot_name']),
         'user_name' => $user_name,
         'user_avatar' => $user_avatar
     ]);
 }
print ($layout_content);