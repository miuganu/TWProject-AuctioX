<?php
require 'core/Project database/connect.php';

mysql_query("DROP TABLE `generate`");
mysql_query("CREATE TABLE `generate` ( username VARCHAR(35), Type_Categori VARCHAR(100), product_name varchar(255), current_price decimal(20,2) )");
$big_query = "SELECT users.username,categoris.Type_Categori, products.product_name, products.current_price FROM users JOIN products ON users.user_id=products.user_id JOIN categoris on products.id_categori=categoris.id_categori";
$result = mysql_query($big_query);

while ($row = mysql_fetch_array($result)) {
    $query = "INSERT INTO `generate` VALUES( '" . $row["username"] . "', '" . $row["Type_Categori"] . "', '" . $row["product_name"] . "', '" . $row["current_price"] . "')";
    mysql_query($query);
}
$result = mysql_query("SELECT * FROM `generate`");
$results_post = [];
if ($result) { // daca query-ul nu contine erori
    while ($row = mysql_fetch_assoc($result)) { // atat timp cat exista randuri in tabela, le salvez ca un array in $row
        $results_post[] = $row;
    }
}

header('Content-disposition: attachment; filename=results.json');
header('Content-type: application/octet-stream');
$json_array = [];
echo '[';
echo "\n";
$len = count($results_post) - 1;
for($i = 0; $i < $len; $i++){
    $json_output = array('username'=>$results_post[$i]["username"], 'Type_Categori' => $results_post[$i]["Type_Categori"], 'product_name'=>$results_post[$i]["product_name"], 'current_price'=>$results_post[$i]["current_price"]);
    echo json_encode($json_output, JSON_PRETTY_PRINT).','."\n";
}
$json_output = array('username'=>$results_post[$len]["username"], 'Type_Categori' => $results_post[$len]["Type_Categori"], 'product_name'=>$results_post[$len]["product_name"], 'current_price'=>$results_post[$len]["current_price"]);
echo json_encode($json_output, JSON_PRETTY_PRINT);
echo "\n";
echo ']';
