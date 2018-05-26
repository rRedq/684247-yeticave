<?php

require_once ("init.php");

If (! isset($_GET['id'])) {
    http_response_code(404);
    die();
}
$lot_id = (int)$_GET['id'];

$sql_lot = "SELECT lot_name, image,description_lot, step_bet, date_end, categories_name, start_price, summa, user_author_id, r.user_id FROM lot AS c 
    LEFT JOIN categories AS u ON u.categories_id = c.categories_id
    LEFT JOIN user AS d ON d.user_id = c.user_author_id 
    LEFT JOIN rate AS r ON r.lot_id = c.lot_id
    WHERE c.lot_id = ?
    order by summa desc
    limit 0, 1;";
$lot_stmt = db_get_prepare_stmt($link, $sql_lot, [$lot_id]);
mysqli_stmt_execute($lot_stmt);
$result_lot = mysqli_stmt_get_result($lot_stmt);
$lot = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
$categories = get_all_categories($link);

$sql = "SELECT summa, name, date_rate FROM rate AS r 
    LEFT JOIN user AS u ON u.user_id = r.user_id
    where lot_id = ?
    order by date_rate
    limit 0, 10;";
$stmt = db_get_prepare_stmt($link, $sql, [$lot_id]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$rate = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot_cost = $_POST['cost'];
    $error = [];

    if (! ctype_digit($lot_cost)) {
        $error ='Только целые числа';
    }
    foreach ($lot as $key) {
        if (($key['start_price'] + $key['step_bet']) > $lot_cost) {
            $error = 'Слишком низкая ставка';
        }
        elseif (($key['summa'] + $key['step_bet']) > $lot_cost) {
            $error = 'Слишком низная ставка';
        }
    }
    if (count($error)){
        $lot_content = include_template ('templates/lot.php', [
            'lot'=> $lot,
            'lot_id' => $lot_id,
            'rate' => $rate,
            'authenticated_user' => $authenticated_user,
            'error' => $error
        ]);
    }
    else {
        $user_id = $authenticated_user['user_id'];
        $sql = 'INSERT INTO rate (date_rate, summa, user_id, lot_id) VALUES (NOW(), ?, ?, ?)';
        $stmt = db_get_prepare_stmt($link, $sql, [$lot_cost, $user_id, $lot_id]);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            header("location: lot.php?id=" . $lot_id);
            exit;
        }
    }
}
$lot_content = include_template ('templates/lot.php', [
    'lot' => $lot,
    'lot_id' => $lot_id,
    'rate' => $rate,
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