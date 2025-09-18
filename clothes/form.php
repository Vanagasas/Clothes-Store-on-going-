<?php
include_once "database.php";
function getData($conn, $target, $filter, $par, $type, $method){
    $stmt = $conn->prepare("SELECT * FROM $target WHERE $filter = ?");
    $stmt->bind_param($type, $par);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    if ($method === "array"){
        for ($i = 0; $i < $result->num_rows; $i++){
            $data[$i] = $result->fetch_assoc();
        }
        return $data;

    }
    else if ($method === "single"){
        return $result->fetch_assoc();
    }
    
    
}