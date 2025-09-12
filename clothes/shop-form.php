<?php
include_once "database.php";

function getData($conn){
    $stmt = $conn->prepare("SELECT * FROM clothes WHERE category = ?");
    $stmt->bind_param("s", $_GET['cat']);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    for ($i = 0; $i < $result->num_rows; $i++){
        $products[$i] =  $result->fetch_assoc();
    }
    return $products;
}
function numRows($conn){
    $stmt = $conn->prepare("SELECT * FROM clothes WHERE category = ?");
    $stmt->bind_param("s", $_GET['cat']);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
}
$products = array();
$products = getData($conn);
$resultCheck = numRows($conn);
?>