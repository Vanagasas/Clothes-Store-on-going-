<?php
session_start();
include_once "database.php";
include_once "form.php";
$orders = getData($conn, "orders", "user_id", $_SESSION["user_id"], "i", "array");
if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
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
            <a class="nav-options" href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="orders-section">
        <h2>Your Orders</h2>
        <?php
        if (count($orders) > 0) {
            for ($i = 0; $i < count($orders); $i++){
                echo '<div class="order-card">
                        <a href="order.php?order_id='.$orders[$i]['id'].'">
                            <h3>Order #'.$orders[$i]['id'].'</h3>
                            <p>Order Date: '.$orders[$i]['order_date'].'</p>
                            <p>Total: $'.$orders[$i]['total'].'</p>
                            <p>Status: '.$orders[$i]['status'].'</p>
                        </a>
                      </div>';
            }
        } else {
            echo '<p>You have no orders.</p>';
        }
        ?>
    
</body>
</html>