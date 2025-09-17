<?php
session_start();
include_once "database.php";
include_once "cart-form.php";
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
    <div class="cart-container">
        <?php
        if ($resultCheck > 0){
            for ($i = 0; $i < $resultCheck; $i++){
                echo '<form method="POST" class="cart-item">
                        <img class="cart-item-image" src="'.$cart[$i]['img_url'].'" alt="Cart Item Image">
                        <div class="cart-item-details">
                            <h3 class="cart-item-name">'.$cart[$i]['name'].'</h3>
                            <p class="cart-item-description">'.$cart[$i]['description'].'</p>
                            <p class="cart-item-price">$'.$cart[$i]['price'].'</p>
                        </div>
                        <button type="submit" name="remove" value="'.$cart[$i]['cart_id'].'" class="remove-from-cart-button" data-product-id="'.$cart[$i]['id'].'">Remove</button>
                      </form>';
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
        <form method="POST">
            <h2 class="cart-total">Total: $<?php echo $total; ?></h2>
            <button type="submit" name="checkout" class="checkout-button">Proceed to Checkout</button>
        </form>
    </div>
</body>
