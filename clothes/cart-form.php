<?php
include_once "database.php";
function getData($conn){
    $stmt = $conn->prepare("SELECT clothes.*, cart.id AS cart_id FROM clothes JOIN cart ON clothes.id = cart.clothes_id WHERE cart.user_id = ?;");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = array();
    for ($i = 0; $i < $result->num_rows; $i++){
        $cart[$i] =  $result->fetch_assoc();
    }
    return $cart;
}
function getTotal($conn){
    $stmt = $conn->prepare("SELECT SUM(clothes.price) AS total FROM clothes JOIN cart ON clothes.id = cart.clothes_id WHERE cart.user_id = ?;");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['total'];
}
$cart = array();
$cart = getData($conn);
$total = getTotal($conn);
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['remove'])) {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user_id'];
        $cartId = $_POST['remove'];
        $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
        header("Location: cart.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}
if (isset($_POST['checkout'])) {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
        $stmt->bind_param("id", $userId, $total);
        $stmt->execute();
        $orderid = $stmt->insert_id;
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, clothes_id) SELECT ?, clothes_id FROM cart WHERE user_id = ?");
        $stmt->bind_param("ii", $orderid, $userId);
        $stmt->execute();
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        echo "<script>alert('Checkout successful!'); window.location.href='profile.php';</script>";
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}
