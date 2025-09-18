<?php
session_start();
include_once "database.php";
include_once "form.php";
$products = getData($conn, "clothes", "category", $_GET['cat'], "s", "array")
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
    <div class="shop-grid">
        <?php
            for ($i = 0; $i < count($products); $i++){
                echo '<div class="product-card">
                        <a href="item.php?id='.$products[$i]['id'].'">
                            <img class="product-image" src="'.$products[$i]['img_url'].'" alt="Product Image">
                            <h3 class="product-name">'.$products[$i]['name'].'</h3>
                            <p class="product-details">'.$products[$i]['description'].'</p>
                            <p class="product-price">$'.$products[$i]['price'].'</p>
                        </a>
                      </div>';
            }
            ?>
    </div>
</body>
</html>