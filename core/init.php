<?php
session_start();

require 'Project database/connect.php';
require 'functions/users.php';
require 'functions/general_auth_set.php';
require 'functions/fill.php';
require 'functions/retrive.php';
require 'functions/insert_update_price.php';

if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'email', 'type');
	if (user_active($user_data['username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit();
	}
}

$errors = array();
?>