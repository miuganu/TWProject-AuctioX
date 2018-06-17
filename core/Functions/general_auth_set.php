<?php
function logged_in_redirect() {//daca userul este logat atunci va fi redirectionat catre pagina home
	if (logged_in() === true) {
		header('Location: home.php');
		exit();
	}
}

function protect_page() {//daca user nu este logat este redirectionat catre protected
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

function array_sanitize(&$item) {
	$item = mysql_real_escape_string($item);
}
  
function sanitize($data){
	return mysql_real_escape_string($data);	
}

function output_errors($errors) {
	$output = array();
	foreach($errors as $error) {
		$output[] = '<li>' . $error . '</li>';
	}
	return '<ul>' . implode('', $output) . '</ul>';
}
?>