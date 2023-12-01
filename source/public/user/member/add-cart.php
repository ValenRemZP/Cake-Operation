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

    
    if ($user) {
 
        $userId = $_SESSION['user']['id'];

      
        $existingCartItem = fetchSingle("SELECT * FROM cart WHERE userid = ? AND cakeId = ?", ['type' => 'i', 'value' => $userId], ['type' => 'i', 'value' => $cakeId]);

        if ($existingCartItem) {
          
            $newQuantity = isset($existingCartItem['quantity']) ? $existingCartItem['quantity'] + 1 : 1;
            $updateQuery = 'UPDATE cart SET quantity = ? WHERE id = ?';
            $updateSuccess = insert($updateQuery, ['type' => 'i', 'value' => $newQuantity], ['type' => 'i', 'value' => $existingCartItem['id']]);
        } else {
          
            $insertQuery = 'INSERT INTO cart (userid, cakeId, quantity) VALUES (?, ?, ?)';
            $insertSuccess = insert($insertQuery, ['type' => 'i', 'value' => $userId], ['type' => 'i', 'value' => $cakeId], ['type' => 'i', 'value' => 1]);
        }

        
    } else {
        
        if (!isset($_SESSION['guest']['cart'])) {
            $_SESSION['guest']['cart'] = [];
        }

        
        $existingCartItemIndex = array_search($cakeId, array_column($_SESSION['guest']['cart'], 'cake_id'));

        if ($existingCartItemIndex !== false) {
        
            $_SESSION['guest']['cart'][$existingCartItemIndex]['quantity'] = isset($_SESSION['guest']['cart'][$existingCartItemIndex]['quantity']) ? $_SESSION['guest']['cart'][$existingCartItemIndex]['quantity'] + 1 : 1;
        } else {
           
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
