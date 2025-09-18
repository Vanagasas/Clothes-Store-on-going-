<?php
include_once "database.php";

if (isset($_POST['action']) && $_POST['action'] === 'wishlist') {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user_id'];
        $productId = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND clothes_id = ?");
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Product is already in your wishlist!";
        }
        else{
            $stmt = $conn->prepare("INSERT INTO wishlist (user_id, clothes_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $userId, $productId);
            $stmt->execute();
            echo "Product added to wishlist!";
        }
    } else {
        header("Location: login.php");
        exit();
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'cart') {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user_id'];
        $productId = $_GET['id'];
        $stmt = $conn->prepare("INSERT INTO cart (user_id, clothes_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        echo "Product added to cart!";
    } else {
        header("Location: login.php");
        exit();
    }
}