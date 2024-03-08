<?php
// Start session
session_start();

// Include necessary files
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /account/login");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if selected cakes are submitted
    if (isset($_POST['selected_cakes']) && !empty($_POST['selected_cakes'])) {
        // Loop through each selected cake
        foreach ($_POST['selected_cakes'] as $cake_id) {
            // Retrieve cake details from the database
            $cake = fetchSingle("SELECT * FROM cakes WHERE id = ?", ['i', $cake_id]);

            // Check if the cake exists
            if ($cake) {
                // Insert the purchase record into the database
                $user_id = $_SESSION['user']['id'];
                $price = $cake['price'];
                $cake_name = $cake['name'];
                $cake_image = $cake['imageUrl'];

                // Insert the purchase record
                $result = insert("INSERT INTO userpurchase (purchaseTime, cakeId, price, CakeName, cakeImage) VALUES (NOW(), ?, ?, ?, ?)", ['i', 'i', 's', 's', $cake_id, $price, $cake_name, $cake_image]);

                if (!$result) {
                    // Error handling if the purchase record insertion fails
                    $_SESSION['error'] = ERROR_MAPPING['Purchase'];
                    header("Location: /cart");
                    exit;
                }
            } else {
                // Cake not found in the database
                $_SESSION['error'] = "Cake with ID $cake_id not found.";
                header("Location: /cart");
                exit;
            }
        }

        // Clear the cart after successful purchase
        unset($_SESSION['cart']);

        // Redirect the user to a success page
        $_SESSION['success'] = "Purchase successful!";
        header("Location: /");
        exit;
    } else {
        // No cakes selected for purchase
        $_SESSION['error'] = "No cakes selected for purchase.";
        header("Location: /cart");
        exit;
    }
} else {
    // Redirect if the form is not submitted
    header("Location: /");
    exit;
}
?>
