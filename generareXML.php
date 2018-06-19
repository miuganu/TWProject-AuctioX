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
header('Content-disposition: attachment; filename=myxml.xml');
header('Content-type: text/xml');

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><AuctioX></AuctioX>');

$xml->addAttribute('version', '1.0');
$xml->addChild('datetime', date('Y-m-d H:i:s'));

foreach($results_post as $xml_row){
    $Auction = $xml->addChild('Auction');
    $Auction -> addChild('Bidder',$xml_row['username']);
    $Auction -> addChild('Category',htmlspecialchars($xml_row['Type_Categori']));
    $Auction -> addChild('Product',$xml_row['product_name']);
    $Auction -> addChild('Price',$xml_row['current_price']);
}
$dom = dom_import_simplexml($xml)->ownerDocument;
$dom->formatOutput = true;
echo $dom->saveXML();

?>
