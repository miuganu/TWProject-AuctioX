<?php 
include 'core/init.php';
logged_in_redirect();

if (empty($_POST) === false) {
	$required_fields = array('username', 'password', 'password_again', 'email');
	foreach($_POST as $key=>$value){
		if (empty($value) && in_array($key,$required_fields) === true){
			$errors[] = 'You need to complete everything';
			break 1;
		}
	}
if (empty($errors) === true) {
				if (user_exists($_POST['username']) === true) {
					$errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
				}
				if (preg_match("/\\s/", $_POST['username']) == true) {
					$errors[] = 'Your username must not contain any spaces.';
				}
				if (strlen($_POST['password']) < 6) {
					$errors[] = 'Your password must be at least 6 characters';
				}
				if ($_POST['password'] !== $_POST['password_again']) {
					$errors[] = 'Your passwords do not mathch';
				}
				if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
					$errors[] = 'A valid email Boss!';
				}
				if (email_exists($_POST['email']) === true) {
					$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already taken.';
				}
	}
}

if (isset($_GET['success']) && empty($_GET['success'])){
	echo 'You\'ve been registered  successfully!';
} else {
	if (empty($_POST) === false && empty($errors) === true) {
		$register_data = array(
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'email' => $_POST['email'],
		);
		
		register_user($register_data);
		header('Location: index.php');
		exit();
		
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:700" rel="stylesheet">

    <!-- style -->
    <link href="style/common.css" rel="stylesheet">
    <link href="style/login.css" rel="stylesheet">
</head>
<body>

<main class="container">

	<div class="container-bubble container-bubble--big <?php if(empty($errors) === false) echo 'error-form';?>">
		<form class="large-form" method="post">
			<h1 class="large-form-title">Make an <br>account</h1>
			<input type="text" placeholder="username" class="sing-un-input" name="username" required minlength="2">
			<input type="password" placeholder="password" class="sing-un-input" name="password" required minlength="6">
			<input type="password" placeholder="password again" class="sing-un-input" name="password_again" required minlength="6">
			<input type="email" placeholder="email" class="sing-un-input" name="email" required minlength="2">
			<p class="error-message"> 
			<?php 
			if(empty($errors) === false) {
				echo output_errors($errors);
			}
		} ?> </p>
			<button type="submit" class="sing-un-button">Register</button>
		</form>
	</div>

    <h1 class="container-title">AuctioX</h1>

	<div class="container-bubble container-bubble--mini">
		<a class="sing-un-button" style="width: 90%; margin-bottom: 0" href="index.php">Login</a>
	</div>

</main>

</body>
</html>