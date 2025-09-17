<?php
 include_once "database.php";
    function getData($conn){
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = array();
        for ($i = 0; $i < $result->num_rows; $i++){
            $orders[$i] =  $result->fetch_assoc();
        }
        return $orders;
    }
    function numRows($conn){
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows;
    }
    $orders = array();
    $orders = getData($conn);
    $resultCheck = numRows($conn);
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
