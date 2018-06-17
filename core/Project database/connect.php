<?php
$connect_error = "Sorry we have connections problems";
$db = mysql_connect('localhost', 'root', '') or die($connect_error);
$connect = mysql_select_db('project_bet') or die($connect_error);
?>