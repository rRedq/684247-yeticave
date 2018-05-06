<?php
function price_decor($price) {  
    $text = ceil($price);

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
	} else {
		echo '';
	}
}
?>
