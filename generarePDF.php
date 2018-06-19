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
echo '<pre>';
$results_post = [];
if ($result) { // daca query-ul nu contine erori
    while ($row = mysql_fetch_assoc($result)) { // atat timp cat exista randuri in tabela, le salvez ca un array in $row
        $results_post[] = $row;
    }
}
header('Content-disposition: attachment; filename=mypdf.pdf');
header('Content-type: application/pdf');
ob_start();
require_once 'fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 7, "Auction added by");
$pdf->Cell(70, 7, "Category");
$pdf->Cell(50, 7, "Product name");
$pdf->Cell(60, 7, "Price");
$pdf->Ln();
$pdf->Cell(450, 7, "----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();
foreach ($results_post as $pdf_row) {

    $username = $pdf_row["username"];
    $Type_Categori = $pdf_row["Type_Categori"];
    $product_name = $pdf_row["product_name"];
    $current_price = $pdf_row["current_price"];
    $pdf->Cell(27, 7, $username);
    $pdf->Cell(70, 7, $Type_Categori);
    $pdf->Cell(50, 7, $product_name);
    $pdf->Cell(60, 7, $current_price);
    $pdf->Ln();
}
$pdf->Cell(450, 7, "----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Output('F', 'filename.pdf');
ob_end_flush();
echo file_get_contents('filename.pdf');
?>