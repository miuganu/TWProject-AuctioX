<?php

function get_my_products($user_id) {

    $result = select_user_products($user_id);
    return simple_fill($result, $user_id);
}

?>