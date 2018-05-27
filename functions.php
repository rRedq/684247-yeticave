<?php
function price_decor($price)
{
    $price = ceil($price);
    if ($price > 1000) {
	    $price = number_format($price, 0, ',', ' ');	  
    }
    $price .= " Р";
    return $price;
}
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
function show_timer(int $end_ts)
{
    $ts_diff = $end_ts - time();
    $hours = floor($ts_diff / 3600);
    $minutes = floor(($ts_diff % 3600) / 60);
    return ("Осталось $hours:$minutes");
}
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