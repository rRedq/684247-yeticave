<?php
/**
 * Получение списка всех категорий
 *
 * @param mysqli $link ресурс соединения
 *
 * @return $categories список всех категорий
 */
function get_all_categories($link)
{
    $sql = 'SELECT categories_id, categories_name, css_class FROM categories';
    $result = mysqli_query($link, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $categories;
}

/**
 * Получение списка всех лотов и названия категорий в которых они находятся
 *
 * @param mysqli $link ресурс соединения
 *
 * @return $table список всех лотов и соответствующих им категорий
 */
function get_all_lots($link)
{
    $sql_table = "SELECT * FROM lot AS c LEFT JOIN categories AS u ON c.categories_id = u.categories_id";
    $result_table = mysqli_query($link, $sql_table);
    $table = mysqli_fetch_all($result_table, MYSQLI_ASSOC);
    return $table;
}

/**
 * Получение максимальной ставки по выбранному лоту
 *
 * @param mysqli $link ресурс соединения
 * @param integer $lot_id идентификатор лота по которому производится поиск
 *
 * @return $summa максимальная ставка для запрашиваемого лота
 */
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
    return $summa;
}

/**
 * Подготовленное выражение для получения информации по выбранному лоту
 *
 * @param mysqli $link ресурс соединения
 * @param $lot_id идентификатор лота
 *
 * @return return подготовленное выражение
 */
function getLotById($link, $lot_id)
{
    $sql = "SELECT lot_name, image, description_lot, step_bet, date_end, categories_name, start_price, user_author_id FROM lot AS lot 
    LEFT JOIN categories AS cat ON cat.categories_id = lot.categories_id
    WHERE lot_id = ?;";
    $stmt = db_get_prepare_stmt($link, $sql, [$lot_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_array($result);
}

/**
 * Подготовленное выражение для получение десяти последних
 * ставок по выбранному лоту
 *
 * @param mysqli $link ресурс соединения
 * @param integer $lot_id идентификатор лота
 *
 * @return $rate подготовленное выражение
 */
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
    return $rate;
}

/**
 * Создает подготовленное выражение для добавления ставки по идентификатору лота
 *
 * @param mysqli $link ресурс соединения
 * @param string $lot_cost ставка пользователя
 * @param string $user_id идентификатор авторизованноего пользователя
 * @param integer $lot_id идентификатор лота
 *
 * @return $result подготовленное выражение
 */
function insertRateById($link, $lot_cost, $user_id, $lot_id)
{
    $sql = 'INSERT INTO rate (date_rate, summa, user_id, lot_id) VALUES (NOW(), ?, ?, ?)';
    $stmt = db_get_prepare_stmt($link, $sql, [$lot_cost, $user_id, $lot_id]);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}