<?php 
include_once "database.php";
function getWishlist($conn, $userId){
    $stmt = $conn->prepare("SELECT clothes.* FROM clothes JOIN wishlist ON clothes.id = wishlist.clothes_id WHERE wishlist.user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $wishlist = array();
    for ($i = 0; $i < $result->num_rows; $i++){
        $wishlist[$i] =  $result->fetch_assoc();
    }
    return $wishlist;
}
$wishlist = array();
$wishlist = getWishlist($conn, $_SESSION['user_id']);
