<?php
function get_all_categories($link)
{
    $sql = 'SELECT categories_id, categories_name, css_class FROM categories';
    $result = mysqli_query($link, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return ($categories);
}
function get_all_lots($link)
{
    $sql_table = "SELECT * FROM lot AS c LEFT JOIN categories AS u ON c.categories_id = u.categories_id";
    $result_table = mysqli_query($link, $sql_table);
    $table = mysqli_fetch_all($result_table, MYSQLI_ASSOC);
    return ($table);
}
function getMaxRateForLot($link, $lot_id)
{
    $sql  = "SELECT max(summa) FROM rate WHERE lot_id = ?";
    $stmt = db_get_prepare_stmt($link, $sql, [$lot_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rate_max_summa = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($rate_max_summa as $key){
        $summa = $key['max(summa)'];
     }
    return ($summa);
}
function getLotById($link, $lot_id)
{
    $sql = "SELECT lot_name, image, description_lot, step_bet, date_end, categories_name, start_price, user_author_id FROM lot AS lot 
    LEFT JOIN categories AS cat ON cat.categories_id = lot.categories_id
    LEFT JOIN user AS user ON lot.user_author_id = user.user_id
    WHERE lot_id = ?;";
    $stmt = db_get_prepare_stmt($link, $sql, [$lot_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $lot = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return ($lot);
}
function getLastRate($link, $lot_id)
{
    $sql = "SELECT user.user_id, summa, name, date_rate FROM rate AS rate 
    LEFT JOIN user AS user ON user.user_id = rate.user_id
    where lot_id = ?
    order by date_rate
    limit 0, 10;";
    $stmt = db_get_prepare_stmt($link, $sql, [$lot_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rate = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return ($rate);
}
function insertRateById($link, $lot_cost, $user_id, $lot_id)
{
    $sql = 'INSERT INTO rate (date_rate, summa, user_id, lot_id) VALUES (NOW(), ?, ?, ?)';
    $stmt = db_get_prepare_stmt($link, $sql, [$lot_cost, $user_id, $lot_id]);
    $result = mysqli_stmt_execute($stmt);
    return ($result);
}