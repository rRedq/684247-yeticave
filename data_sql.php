<?php
function  get_all_categories($link){
    $sql = 'SELECT categories_id, categories_name, css_class FROM categories';
    $result = mysqli_query($link, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return ($categories);
}
function get_all_lots($link){
    $sql_table = "SELECT * FROM lot as c left join categories as u on c.categories_id = u.categories_id";
    $result_table = mysqli_query($link, $sql_table);
    $table = mysqli_fetch_all($result_table, MYSQLI_ASSOC);
    return ($table);
}