<?php
    session_start();
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
            <a href="man.php" class="nav-options">Men</a>
            <a href="women.php" class="nav-options">Women</a>
            <a href="kids.php" class="nav-options">Kids</a>
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
    <main>
        <h2>Pick your style</h2>
        <div class="suggested-categories-grid">
            <a class="suggested-link" href="#">
                <div class="suggested-image suggested-image-man">
                    <div class="suggested-border">
                        <div class="suggested-text">Man</div>
                    </div>
                </div>
            </a>
            <a class="suggested-link" href="#">
                <div class="suggested-image suggested-image-woman">
                    <div class="suggested-border">
                        <div class="suggested-text">Woman</div>
                    </div>
                </div>
            </a>
            <a class="suggested-link" href="#">
                <div class="suggested-image suggested-image-kids">
                    <div class="suggested-border">
                        <div class="suggested-text">Kids</div>
                    </div>
                </div>
            </a>
        </div>
    </main>
    <footer>
        <div class="footer-section">
            <h3>About Us</h3>
            <p>Lorem ipsum</p>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email:xxx.xxx</p>
            <p>Phone: +123 456 7890</p>
        </div>
        <div class="footer-section footer-socials">
            <h3>Follow Us</h3>
            <a href="#" class="fa-brands fa-facebook-f"></a>
            <a href="#" class="fa-brands fa-twitter"></a>
            <a href="#" class="fa-brands fa-instagram"></a>
        </div>
    </footer>
</body>
</html>