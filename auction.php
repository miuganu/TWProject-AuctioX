<?php
    include 'core/init.php';
    protect_page();
    $error = array();

    if (isset($_POST['upload'])) {
        $isImage = true;
        $imageFileType = pathinfo("image/" . basename($_FILES['image']['name']), PATHINFO_EXTENSION);
        $image = $_FILES['image']['name'];
        $allowed = array('gif', 'png', 'jpg', 'jpeg');
//        $product_id = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $categori = $_POST['categori'];
        $price = $_POST['price'];
        $user_id = $user_data['user_id'];
        //echo "$product_id";
        if (!in_array($imageFileType, $allowed)) {
            $isImage = false;
        }
        $description = $_POST['description'];
        if (($description == true) && ($isImage == true) && ($price == true) && ($productName == true)) {
            move_uploaded_file($_FILES['image']['tmp_name'], "image/" . $_FILES["image"]["name"]);
            $current_date = date('Y-m-d H:i:s', time());
            $time = strtotime($_POST['dateField']);
            if ($time < strtotime($current_date)) {
                $expirate_date = $current_date;
            }
            else{
                $expirate_date = date('Y-m-d H:i:s', $time);
            }
            //$expirate_date = date('Y-m-d H:i:s',strtotime($_POST['dateField']));
            $query = mysql_real_escape_string(mysql_query("INSERT INTO `products` (product_name ,image, description, price,current_price, Id_Categori, expirate_date, user_id) VALUE ('$productName','$image', '$description','$price','$price', '$categori', '$expirate_date', '$user_id'  )"));
            header('Location: home.php');

            exit();
        } else {
            echo '<h1> You need to fill in <b>all fields</b></h1>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>


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
    <div class="ax-card ax-card-large ax-add-new-action-card">
        <form method="POST" class="ax-add-new-action-form" enctype="multipart/form-data">
            <h3 class="ax-add-new-action-form__title">Insert your auction announce!</h3>

            <input class="ax-add-new-action-form__input" placeholder="Product Name" type="text" name="product_name" required/>

            <input class="ax-add-new-action-form__input" placeholder="Product Price" type="number" name="price" required/>

            <select class="selectAnounce" name="categori">
                <?php echo fill_type_category($connect); ?>
            </select>

            <div class="ax-add-new-action-form__input-file ax-add-new-action-form__input">
                <input type="file" name="image" required accept=".jpg, .jpeg, .png"
                       id="fileUpload">
                <label for="fileUpload" class="ax-add-new-action-form__input-file-label">Update Photo</label>
            </div>

            <div class="ax-add-new-action-form__textarea">
                <label>Expire Date</label>
                <input type = "date" name = "dateField" min = <?php echo date('Y-m-d', time()); ?> max = <?php echo date('Y-m-d',time() + (30 * 24 * 60 * 60));?> >
            </div>

            <textarea class="ax-add-new-action-form__textarea" name="description" required
                      placeholder="Enter Product description" cols="40" rows="4" class="anounceDescription"></textarea>

            <button type="submit" name="upload" value="Save" class="ax-add-new-action-form__button">Post</button>
        </form>
    </div>
</main>

</body>
</html>