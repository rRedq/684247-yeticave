<?php

require_once ("init.php");

If (! isset($_GET['id'])) {
    http_response_code(404);
    die();
}
$lot_id = (int)$_GET['id'];

$categories = get_all_categories($link);
$lot = getLotById($link, $lot_id);
$max_summa = getMaxRateForLot($link, $lot_id);
$rate = getLastRate($link, $lot_id);
$rateUserIds = [];
foreach ($rate as $key) {
    // пользователи могут повторяться, таким образом уберем повторы
    $rateUserIds[$key['user_id']] = true;
}
$users = getUsersByIds($link, array_keys($rateUserIds));

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
        elseif (($max_summa + $key['step_bet']) > $lot_cost) {
            $error = 'Слишком низная ставка';
        }
    }
    if (count($error)) {
        $lot_content = include_template('templates/lot.php', [
            'error' => $error,
            'lot' => $lot,
            'lot_id' => $lot_id,
            'rate' => $rate,
            'max_summa' => $max_summa,
            'authenticated_user' => $authenticated_user,
            'users' => $users
        ]);
    }
    else {
        $user_id = $authenticated_user['user_id'];
        $result = insertRateById($link, $lot_cost, $user_id, $lot_id);
        if ($result) {
            header("location: lot.php?id=" . $lot_id);
            exit;
        }
        else {
            http_response_code(500);
            echo "Не удалось добавить ставку";
            exit;
        }
    }
}
else {
    $lot_content = include_template('templates/lot.php', [
        'lot' => $lot,
        'lot_id' => $lot_id,
        'rate' => $rate,
        'max_summa' => $max_summa,
        'authenticated_user' => $authenticated_user,
        'users' => $users
    ]);
}
foreach ($lot as $value) {
    $layout_content = include_template('templates/layout.php', [
        'content' => $lot_content,
        'categories' => $categories,
        'title' => htmlspecialchars($value['lot_name']),
        'authenticated_user' => $authenticated_user
    ]);
}
print ($layout_content);