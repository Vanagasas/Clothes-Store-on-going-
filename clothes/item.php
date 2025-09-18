<?php
session_start();
include_once "database.php";
include_once "form.php";
include_once "item-form.php";
$item = getData($conn, "clothes", "id", $_GET['id'], "i", "single");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Faked shopping</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tirra:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/74d37a292d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <header>
        <div class="section">
            <a href="shop.php?cat=M" class="nav-options">Men</a>
            <a href="shop.php?cat=F" class="nav-options">Women</a>
            <a href="shop.php?cat=K" class="nav-options">Kids</a>
        </div>
        <h1><a href="index.php">ⵜⴰⵎⵓⵙⵏⵉ</a></h1>
        <nav>
            <a class="nav-options fa-solid fa-bag-shopping" href="cart.php"></a>
            <a class="nav-options fa-solid fa-heart" href="wishlist.php"></a>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a class="nav-options fa-solid fa-user" href="profile.php"></a>';
            } else {
                echo '<a class="nav-options fa-solid fa-user" href="login.php"></a>';
            }
            ?>
        </nav>
    </header>
    <div class="item-container">
        <div class="item-image-section">
            <img class="item-image" src="<?php echo $item['img_url']; ?>" alt="Item Image">
        </div>
        <form class="item-details-section" method="POST">
            <h2 class="item-name"><?php echo $item['name']; ?></h2>
            <p class="item-description"><?php echo $item['description']; ?></p>
            <p class="item-price">$<?php echo $item['price']; ?></p>
            <button type="submit" name="action" value="cart" class="add-to-cart-button" data-product-id="<?php echo $item['id']; ?>">Add to Cart</button>
            <button type="submit" name="action" value="wishlist" class="add-to-likes-button" data-product-id="<?php echo $item['id']; ?>">Add to Wishlist</button>
        </form>
    </div>
</body>