<?php
include_once "database.php";
    function getItems($conn){
        $stmt = $conn->prepare("SELECT clothes_id FROM order_items WHERE order_id = ?");
        $stmt->bind_param("i", $_GET['order_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = array();
        $ids = array();
        for ($i = 0; $i < $result->num_rows; $i++){
            $ids[$i] =  $result->fetch_assoc();
        }
        for ($i = 0; $i < count($ids); $i++){
            $stmt = $conn->prepare("SELECT * FROM clothes WHERE id = ?");
            $stmt->bind_param("i", $ids[$i]['clothes_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $items[$i] =  $result->fetch_assoc();
        }
        return $items;
    }
$items = array();
$items = getItems($conn);
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if (!isset($_GET['order_id'])) {
    header("Location: profile.php");
    exit();
}
