<html>
<?php

    function fill_type_category($connect) {
        $output = '';
        $result = select_type_category();

        while ($row = mysql_fetch_array($result)) {
            $output .= '<option value="' . $row["Id_Categori"] . '">' . $row["Type_Categori"];
        }
        return $output;
    }

    function fill_products( $user) {
        $result = select_all_products();
        return simple_fill($result, $user);
    }

    function fill_search($text, $user) {
        $query = "SELECT * FROM `products` WHERE description LIKE replace('%" . $text . "%',' ', '%' ) OR product_name like replace('%" . $text . "%',' ', '%' ) ";
        $result = mysql_query($query);
        return simple_fill($result, $user);
    }

    function simple_fill($result) {

        $output = '';
        while ($row = mysql_fetch_array($result)) {
            if($row['expirate_date'] >= date('Y-m-d', time())) {
                $output .= "
                <div class='ax-card ax-card-small'>
				<header class='ax-card--small__header'>
					<img src='image/{$row['image']}' class='ax-card-small__img'>
					<p><span> {$row['product_name']} </span></p>|
					<p>{$row['description']}</p>
				</header>
				<p class='ax-card-small-time-left'>Start price: <span> {$row['price']} </span> </p>
				<p class='ax-card-small-time-left'>Current price: <span> {$row['current_price']} </span> </p>
				<form method='POST' enctype='multipart/form-data' style='display: flex;'>
					<input type='hidden' name='product_id' value='{$row['product_id']}'>
					<input type='number' name='conted' style='width: 100px; height: 25px'>
                    <input type='submit' name='comment' value='Bid' id='insertComent' style='width: 55px; height: 25px; margin-left: 5px;'>
				</form>
                <p class='ax-card-small-time-left'>Expire date: <span> {$row['expirate_date']} </span> </p>
			</div>
            ";
            }
            else {
                $output .= "
                <div class='ax-card ax-card-small'>
				<header class='ax-card--small__header'>
					<img src='image/{$row['image']}' class='ax-card-small__img'>
					<p><span> {$row['product_name']} </span></p>|
					<p>{$row['description']}</p>
				</header>
				<p class='ax-card-small-time-left'>Start price: <span> {$row['price']} </span> </p>
				<p class='ax-card-small-time-left'>Selling price: <span> {$row['current_price']} </span> </p>
                <p class='ax-card-small-time-left'>This auction is expired!</p>
			</div>";
            }
        }
        return $output;
    }
?>
</html>