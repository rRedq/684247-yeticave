<?php

/**
 * Добавляет разделитель между каждым третьим числом и
 * добавляет в конце знак рубля "Р"
 *
 * @param float $price выражение для форматирования
 *
 * @return $price отформатированное выражение
 */
function price_decor($price)
{
    $price = ceil($price);
    if ($price > 1000) {
	    $price = number_format($price, 0, ',', ' ');	  
    }
    $price .= " Р";
    return $price;
}

/**
 * Функция шаблонизатор
 *
 * @param $tamplate подключаемый файл
 * @param array $data массив данных для подключаемого файла
 *
 * @return подготовленный шаблон
 */
function include_template($tamplate, $data)
{
	if (file_exists($tamplate)) {
	    ob_start();
	    extract($data);
	    include($tamplate);
	    return ob_get_clean();
	}
	else {
		return '';
	}
}

/**
 * Конвертирует unix время в человекочитаемый формат
 *
 * @param integer $end_ts unix выражение для конвертации
 *
 * @return преобразованное в человекочитаемый формат выражение
 */
function show_timer(int $end_ts)
{
    $ts_diff = $end_ts - time();
    $days = floor($ts_diff / 86400);
    $hours = floor(($ts_diff % 86400) / 3600);
    $minutes = floor(($ts_diff % 3600) / 60);
    return ("Осталось $days:$hours:$minutes");
}

/**
 * Подготовленное выражение для поиска user_id в указанном массиве
 *
 * @param mysqli $link ресурс соединения
 * @param array $userIds массив данных для поиска
 *
 * @return $result полученный масств со значениями user_id
 */
function getUsersByIds($link, array $userIds)
{
    if (! count($userIds)) {
        return [];
    }
    $placeholders_array = array_fill(0, count($userIds), '?');
    $sql = 'SELECT user_id FROM user WHERE user_id in (' . implode(',', $placeholders_array) . ')';
    $stmt = db_get_prepare_stmt($link, $sql, $userIds);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $result = [];
    foreach ($users as $user) {
       $result[$user['user_id']] = $user;
    }
    return $result;
}