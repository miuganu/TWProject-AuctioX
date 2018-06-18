<?php

function insert_bid($value, $product_id, $user_id) {
    $message = "Bet more if you want this product!";
    $currentPrice = select_product_by_id($product_id);
    if ($currentPrice < $value) {
        mysql_real_escape_string(mysql_query("INSERT INTO `bid` (price_bet, product_id, user_id) VALUE ('$value', '$product_id', '$user_id')"));
        update_new_price($product_id, $value);
        return "OK";
    } else {
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

function update_new_price($product_id, $value) {

    mysql_real_escape_string(mysql_query("UPDATE `products` SET current_price ='$value' WHERE product_id='$product_id'"));
}

?>