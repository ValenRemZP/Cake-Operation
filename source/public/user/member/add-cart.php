<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cart_add"])) {
    if (isset($_POST['cart_add'])) {
        $cakeImage = $_POST['cake_pic'];
        $cakeId = $_POST['cake_id'];
        $cakeName = $_POST['cake_name'];
        $cakePrice = $_POST['cake_price'];

        // Add the cake to the shopping cart session    
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the cake already exists in the cart
        $existingCakeKey = array_search($cakeId, array_column($_SESSION['cart'], 'cake_id'));
        if ($existingCakeKey !== false) {
            // If the cake already exists, show a pop-up notification
            echo "<script>alert('You already have this cake in your cart.');</script>";
            // Redirect back to the index page
            echo "<script>window.location.href = '/';</script>";
            exit; // Stop further execution
        } else {
            // If the cake doesn't exist, add it to the cart
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
