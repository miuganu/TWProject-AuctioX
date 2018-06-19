<?php
    include 'core/init.php';
    protect_page();

    if (empty($_POST) === false) {
        $required_fields = array('current_password', 'password', 'password_again');
        foreach ($_POST as $key => $value) {
            if (empty($value) && in_array($key, $required_fields) === true) {
                $errors[] = 'Fields are required';
                break 1;
            }
        }

        if (md5($_POST['current_password']) === $user_data['password']) {
            if (trim($_POST['password']) !== trim($_POST['password_again'])) {
                $errors[] = 'Your new password do not match';
            } else if (strlen($_POST['password']) < 6) {
                $errors[] = 'Your password must be at least 8 characters';
            }
        } else {
            $errors[] = 'You current password is incorrect';
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change password</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:700" rel="stylesheet">

    <!-- style -->
    <link href="style/common.css" rel="stylesheet">
    <link href="style/add_action.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

<header class="ax-header">
    <div class="ax-header-left">
        <a href="home.php" class="ax-header__title">AuctioX</a>
        <form class="ax-header-form">
            <input type="text" placeholder="search" class="ax-header-form-input" name="search">
            <button type="submit" class="ax-header-form-search-button">Search</button>
        </form>
    </div>
    <div style="display: flex;">
        <a href="logout.php">
            <button type="button" class="ax-header-action-button">logout</button>
        </a>
    </div>
</header>

<main class="ax-container">
    <div class="ax-card ax-card-normal ax-add-new-action-card">
        <form method="POST" class="ax-add-new-action-form" action="">
            <h3 class="ax-add-new-action-form__title">Change your password</h3>

            <input class="ax-add-new-action-form__input" placeholder="Current password" type="password"
                   required name="current_password"/>
            <input class="ax-add-new-action-form__input" placeholder="New password" type="password"
                   required name="password"/>
            <input class="ax-add-new-action-form__input" placeholder="Confirm password" type="password"
                   required name="password_again"/>

            <p class="ax-add-new-action-form__title error-message"><?php
                    if (isset($_GET['success']) && empty($_GET['success'])){
                        echo 'Your password has been changed!';
                    } else {
                    if (empty($_POST) === false && empty($errors) === true) {
                        change_password($session_user_id, $_POST['password']);
                        header('Location: changepassword.php?success');
                    } else if (empty($errors) === false) {
                        foreach ($errors as $error) {
                            echo $error;
                        }
                    }
                ?></p>

            <button type="submit" class="ax-add-new-action-form__button">Change password</button>
        </form>
    </div>
</main>
<?php
    }
?>
</body>
</html>