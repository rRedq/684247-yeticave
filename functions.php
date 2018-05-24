<?php
function price_decor($price) {  
    $price = ceil($price);
    if ($price > 1000) {
	    $price = number_format($price, 0, ',', ' ');	  
    }
    $price .= " Р";
    return $price;
}

function include_template($tamplate, $data) {
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

function show_timer(int $end_ts) {
    $ts_diff = $end_ts - time();
    $hours = floor($ts_diff / 3600);
    $minutes = floor(($ts_diff % 3600) / 60);
    return ("Осталось $hours:$minutes");
}