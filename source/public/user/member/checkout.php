<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

// Placeholder for error message
$status = "";

// Retrieve user's shipping address from the database
$sql = "SELECT street, city, state, zipcode FROM users WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($street, $city, $state, $zipcode);
$stmt->fetch();
$stmt->close();

// Process order submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST['address'])) {
        // Extract shipping address from form
        $shippingAddress = $_POST['address'];

        // Check if shipping address fields are filled
        if (empty($street) || empty($city) || empty($state) || empty($zipcode)) {
            // Redirect the user to profile page to fill in missing information
            header('Location: /profile.php?missing_fields=true');
            exit();
        }

        // Process the purchase here, this part is where you would integrate with Stripe or any other payment processor
        // Code for purchase processing goes here

        // Clear the cart after successful purchase
        unset($_SESSION['cart']);

        header('Location: /?success=Purchase');
        exit();
    } else {
        // Handle case where form fields are not set
        $status = "Please fill out all required fields.";
    }
}
?>

<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-8">
    <h2 class="text-3xl mb-4">Checkout</h2>

    <!-- Shipping details -->
    <div class="mb-4">
        <!-- Display user's shipping address -->
        <h3 class="text-lg font-bold mb-2">Shipping Address</h3>
        <?php if (!empty($street) && !empty($city) && !empty($state) && !empty($zipcode)) : ?>
            <p><?php echo $street . ', ' . $city . ', ' . $state . ', ' . $zipcode; ?></p>
        <?php else : ?>
            <p>Your shipping address is incomplete. Please <a href="/profile.php">update your profile</a>.</p>
        <?php endif; ?>
    </div>

    <!-- Display cart items -->
    <?php if (!empty($_SESSION['cart'])) : ?>
        <div class="overflow-x-auto">
            <div class="grid grid-cols-5 gap-x-4 bg-gray-200 text-center py-2">
                <div class="px-4 py-2">Cake Pic</div>
                <div class="px-4 py-2">Cake</div>
                <div class="px-4 py-2">Quantity</div>
                <div class="px-4 py-2">Price</div>
                <div class="px-4 py-2">Total</div>
            </div>
            <?php
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $item):
                ?>
                <div class="grid grid-cols-5 gap-x-4 border-b border-gray-200 py-4">
                    <div class="px-4 py-2"><img src="/public/pics/<?php echo $item["cake_pic"]; ?>" alt="Product Image" class="w-16 h-16 mx-auto"></div>
                    <div class="px-4 py-2"><?php echo $item["cake_name"]; ?></div>
                    <div class="px-4 py-2"><?php echo $item["quantity"]; ?></div>
                    <div class="px-4 py-2">€<?php echo $item["cake_price"]; ?></div>
                    <div class="px-4 py-2">€<?php echo $item["cake_price"] * $item["quantity"]; ?></div>
                </div>
                <?php
                $totalPrice += $item["cake_price"] * $item["quantity"];
            endforeach;
            ?>
            <div class="mt-4">
                <p class="text-xl flex justify-center font-semibold">Total: €<?php echo $totalPrice; ?></p>
            </div>
        </div>
    <?php else : ?>
        <div class="bg-white shadow-md p-4">Your cart is empty!</div>
    <?php endif; ?>

    <div class="mt-4">
        <?php echo $status; ?>
    </div>

    <!-- Process order button -->
    <?php if (!empty($_SESSION['cart']) && (!empty($street) && !empty($city) && !empty($state) && !empty($zipcode))) : ?>
        <form action="/checkout.php" method="post">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Process Payment</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
