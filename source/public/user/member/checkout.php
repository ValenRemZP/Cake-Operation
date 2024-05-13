<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';

// Check if user is logged in and get their user ID
if (!isset($_SESSION['user']['id'])) {
    ?>
    <script>
    window.location.href = "/account/login";
    </script>
    <?php
}

// Check if total price is set in the query parameter
if(isset($_GET['total_price'])) {
    // Retrieve the total price from the query parameter
    $total_price = $_GET['total_price'];
} else {
    // Set a default total price if not provided
    $total_price = 0;
}

// Fetch user's shipping address
$sql = "SELECT street, city, state, zipcode FROM users WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $_SESSION['user']['id']);
$stmt->execute();
$stmt->bind_result($street, $city, $state, $zipcode);
$stmt->fetch();
$stmt->close();

// Retrieve cart items from session
$cart_items = isset($_SESSION['cart_items']) ? $_SESSION['cart_items'] : array();
?>

<html>
<head>
    <title>Checkout</title>
    <!-- Include your CSS styles here -->
</head>
<body>
<div class="container mx-auto py-8">
    <h2 class="text-3xl mb-4">Checkout</h2>

    <div class="mt-4">
        <h3 class="text-lg font-bold mb-2">Shipping Address</h3>
        <?php if (!empty($street) && !empty($city) && !empty($state) && !empty($zipcode)) : ?>
            <p><?php echo $street . ', ' . $city . ', ' . $state . ', ' . $zipcode; ?></p>
        <?php else : ?>
            <p>Your shipping address is incomplete. Please <a href="/account/settings/edit">update your profile</a>.</p>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        <h3 class="text-lg font-bold mb-2">Products</h3>
        <?php foreach ($cart_items as $product) : ?>
            <p><?php echo $product['cake_name']; ?> - Quantity: <?php echo $product['quantity']; ?> - Price: €<?php echo $product['cake_price']; ?></p>
        <?php endforeach; ?>
    </div>

    <div class="mt-4">
        <p>Total: €<?php echo $total_price; ?></p>
    </div>

    <?php if (!empty($street) && !empty($city) && !empty($state) && !empty($zipcode)) : ?>
        <!-- Display button to continue checkout process -->
        <form method="post" action="/checkout"> <!-- Create process_payment.php for handling payment -->
            <button type="submit" class="btn bg-rose-400 text-white px-4 py-2 rounded">Confirm Purchase</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
