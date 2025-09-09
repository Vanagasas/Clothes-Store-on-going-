<?php
include_once "database.php";

session_start();
function getData($conn){
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $_GET['cat']);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    for ($i = 0; $i < mysqli_num_rows($result); $i++){
        $products[$i] = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    return $products;
}
$products = getData($conn);
?>