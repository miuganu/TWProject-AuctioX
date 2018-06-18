<?php

function select_type_category() {
    $sql = "SELECT * FROM categoris";
    return mysql_query($sql);
}

function select_all_products() {
    $sql = "SELECT * FROM products";
    return mysql_query($sql);
}

function filter_dropdown_select($category, $sort, $price_selected) {

    if (($category != "") && ($price_selected != "")) {
        $sql = "SELECT * FROM products where 
		Id_Categori='" . $category . "' and current_price<" . $price_selected;
    } else if ($price_selected != "") {
        $sql = "SELECT * FROM products where 
		 current_price<" . $price_selected;
    } else if ($category != "") {
        $sql = "SELECT * FROM products where 
		Id_Categori='" . $category . "'";
    } else {
        $sql = "SELECT * FROM products";
    }
    if (strcmp($sort, "ASC") == 0) {
        $sql .= " ORDER BY expirate_date ASC";
    } else {
        $sql .= " ORDER BY expirate_date DESC";
    }
    return mysql_query($sql);
}

/* Adds for a specific user */

function select_user_products($user_id) {
    $sql = "SELECT * FROM products where user_id=" . $user_id . "";
    return mysql_query($sql);
}

function select_product_by_id($product_id) {
    return mysql_result(mysql_query("SELECT current_price FROM products where product_id='$product_id' LIMIT 1"), 0);
}

?>