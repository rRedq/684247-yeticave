<?php

require_once ("init.php");

If (! isset($_GET['id'])) {
    http_response_code(404);
    die();
}
$lot_id = (int)$_GET['id'];

$sql_lot = "SELECT lot_name, image,description_lot, step_bet, date_end, categories_name FROM lot as c LEFT JOIN categories AS u ON c.categories_id = u.categories_id
    WHERE lot_id = ?";
$lot_stmt = db_get_prepare_stmt($link, $sql_lot, [$lot_id]);
mysqli_stmt_execute($lot_stmt);
$result_lot = mysqli_stmt_get_result($lot_stmt);

$lot = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
$categories = get_all_categories($link);

$lot_content = include_template ('templates/lot.php', [
    'lot'=> $lot,
    'authenticated_user' => $authenticated_user
]);
 foreach ($lot as $value) {
     $layout_content = include_template('templates/layout.php', [
         'content' => $lot_content,
         'categories' => $categories,
         'title' => htmlspecialchars($value['lot_name']),
         'authenticated_user' => $authenticated_user
     ]);
 }
print ($layout_content);