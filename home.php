<?php
    include 'core/init.php';
    protect_page();
    //include 'core/functions/fill.php';
    if (isset($_POST['comment'])) {
        insert_bid($_POST['conted'], $_POST['product_id'], $user_data['user_id']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>

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
            <input placeholder="search" class="ax-header-form-input" name="search">
            <button type="submit" class="ax-header-form-search-button">Search</button>
        </form>
    </div>
    <div class="ax-header-right">
        <div class="ax-header-button-group">
            <div>
                <button type="button"
                        class="ax-header-action-button ax-header-action-button--left ax-header-action-button__relative">
                    Export
                </button>
                <div class="ax-header-action-drop-down-container">
                    <a href="generareJSON.php" class="ax-header-action-drop-down-container--selector">
                        JSON file
                    </a>
                    <a href="generarePDF.php" class="ax-header-action-drop-down-container--selector">
                        PDF file
                    </a>
                    <a href="generareXML.php" class="ax-header-action-drop-down-container--selector">
                         XML file
                    </a>
                </div>
            </div>
            <div>
                <button type="button"
                        class="ax-header-action-button ax-header-action-button--right ax-header-action-button__relative">
                    Options
                </button>
                <div class="ax-header-action-drop-down-container">
                    <a href="auction.php" class="ax-header-action-drop-down-container--selector">
                        Add Auction
                    </a>
                    <a href="userpage.php" class="ax-header-action-drop-down-container--selector">
                        MyAuction
                    </a>
                    <a href="changepassword.php" class="ax-header-action-drop-down-container--selector">
                        Change password
                    </a>
                    <a href="feednews.php" class="ax-header-action-drop-down-container--selector">
                        News
                    </a>
                </div>
            </div>
        </div>
        <a href="logout.php" class="ax-header-action-button">logout</a>
    </div>
</header>

<div class="ax-header" style="justify-content: flex-start; padding-left: 25px">
    <select class="Select" name="categori" id="categori">
        <option class="dropSelect" value="">ALL</option>
        <?php echo fill_type_category($connect); ?>
    </select>

    <select class="Select" name="expire_date" id="expire_date">
        <option class="dropSelect" value="DESC">Date Desc</option>
        <option class="dropSelect" value="ASC">Date Asc</option>
    </select>

    <select class="Select" name="price_selected" id="price_selected">
        <option class="dropSelect" value="">ALL</option>
        <option class="dropSelect" value="50">50</option>
        <option class="dropSelect" value="100">100</option>
        <option class="dropSelect" value="500">500</option>
        <option class="dropSelect" value="1000">1000</option>
        <option class="dropSelect" value="5000">5000</option>
        <option class="dropSelect" value="10000">10000</option>
        <option class="dropSelect" value="15000">15000</option>
        <option class="dropSelect" value="20000">20000</option>
    </select>
</div>

<main class="ax-container" id="show_anunt">
    <?php
        if (!isset($_POST['search'])) {
            echo fill_products($user_data['user_id']);
        } else {
            echo fill_search($_POST['search'], $user_data['user_id']);
        }
    ?>
</main>

</body>
</html>


<script>
    $(document).ready(function () {

        $('#expire_date').change(function () {
            $.ajax({
                url: "core/load_data.php",
                method: "POST",
                data: {
                    Id_Categori: $('#categori').val(),
                    date: $(this).val(),
                    price_selected: $('#price_selected').val()
                },
                success: function (data) {
                    $('#show_anunt').html(data);
                }
            });
        });
        $('#categori').change(function () {
            $.ajax({
                url: "core/load_data.php",
                method: "POST",
                data: {
                    Id_Categori: $(this).val(),
                    date: $('#expire_date').val(),
                    price_selected: $('#price_selected').val()
                },
                success: function (data) {
                    $('#show_anunt').html(data);

                }
            });
        });
        $('#price_selected').change(function () {
            $.ajax({
                url: "core/load_data.php",
                method: "POST",
                data: {
                    Id_Categori: $('#categori').val(),
                    date: $('#expire_date').val(),
                    price_selected: $(this).val()
                },
                success: function (data) {
                    $('#show_anunt').html(data);

                }
            });
        });

    });

</script>