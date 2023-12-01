<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cart_add"])) {
    $cakeId = $_POST["cake_id"];
    $cakeName = $_POST["cake_name"];
    $cakePrice = $_POST["cake_price"];

    // Check if the user is logged in
    if ($user) {
        // User is logged in, add to cart in the database
        $userId = $_SESSION['user']['id'];

        // Check if the item is already in the cart
        $existingCartItem = fetchSingle("SELECT * FROM cart WHERE userid = ? AND cakeId = ?", ['type' => 'i', 'value' => $userId], ['type' => 'i', 'value' => $cakeId]);

        if ($existingCartItem) {
            // Item already exists in the cart, update the quantity
            $newQuantity = $existingCartItem['quantity'] ?? 0 + 1;
            $updateQuery = 'UPDATE cart SET quantity = ? WHERE id = ?';
            $updateSuccess = insert($updateQuery, ['type' => 'i', 'value' => $newQuantity], ['type' => 'i', 'value' => $existingCartItem['id']]);
        } else {
            // Item does not exist in the cart, add a new item
            $insertQuery = 'INSERT INTO cart (userid, cakeId, quantity) VALUES (?, ?, ?)';
            $insertSuccess = insert($insertQuery, ['type' => 'i', 'value' => $userId], ['type' => 'i', 'value' => $cakeId], ['type' => 'i', 'value' => 1]);
        }

       

        // Check if the item is already in the session cart
        $existingCartItemIndex = array_search($cakeId, array_column($_SESSION['guest']['cart'], 'cake_id'));

        if ($existingCartItemIndex !== false) {
            // Item already exists in the session cart, update the quantity
            $_SESSION['guest']['cart'][$existingCartItemIndex]['quantity'] = isset($_SESSION['guest']['cart'][$existingCartItemIndex]['quantity']) ? $_SESSION['guest']['cart'][$existingCartItemIndex]['quantity'] + 1 : 1;
        } else {
            // Item does not exist in the session cart, add a new item
            $_SESSION['guest']['cart'][] = [
                'cake_id' => $cakeId,
                'cake_name' => $cakeName,
                'cake_price' => $cakePrice,
                'quantity' => 1,
            ];
        }

    }
}
?>
