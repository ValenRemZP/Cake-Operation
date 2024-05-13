<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cart_add"])) {
    if (isset($_POST['cart_add'])) {
        $cakeImage = $_POST['cake_pic'];
        $cakeId = $_POST['cake_id'];
        $cakeName = $_POST['cake_name'];
        $cakePrice = $_POST['cake_price'];

 
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

      
        $existingCakeKey = array_search($cakeId, array_column($_SESSION['cart'], 'cake_id'));
        if ($existingCakeKey !== false) {
            
            echo "<script>alert('You already have this cake in your cart.');</script>";
 
            echo "<script>window.location.href = '/';</script>";
            exit; 
        } else {
            $_SESSION['cart'][] = [
                'cake_pic' => $cakeImage,
                'cake_id' => $cakeId,
                'cake_name' => $cakeName,
                'cake_price' => $cakePrice,
                'quantity' => 1
            ];
        }
    }
}
?>
