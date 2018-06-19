<?php
    include 'core/init.php';
    protect_page();
    include 'core/functions/get_my_auctions.php';

    if (isset($_POST['comment'])) {
        insert_bid($_POST['conted'], $_POST['lpost_id'], $user_data['user_id']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Auctions</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:700" rel="stylesheet">

    <!-- style -->
    <link href="style/common.css" rel="stylesheet">
    <link href="style/home.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

<header class="ax-header">
    <div class="ax-header-left">
        <a href="home.php" class="ax-header__title">AuctioX</a>
        <form class="ax-header-form" method="post">
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
<!--    --><?php //echo get_my_products($user_data['user_id']); ?>
    <?php
    if (!isset($_POST['search'])) {
        echo get_my_products($user_data['user_id']);
    } else {
        echo fill_search_auction($_POST['search'], $user_data['user_id']);
    }
    ?>
</main>
</body>
</html>