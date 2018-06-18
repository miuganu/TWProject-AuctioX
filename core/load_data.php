<?php
include 'init.php';
	
$result=filter_dropdown_select($_POST['Id_Categori'],$_POST['date'],$_POST['price_selected']);
echo simple_fill($result,$user_data['user_id']);

?>