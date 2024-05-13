<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

$status = "";

$sql = "SELECT street, city, state, zipcode FROM users WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($street, $city, $state, $zipcode);
$stmt->fetch();
$stmt->close();

// Calculate the total price of items in the cart
$totalPrice = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item["cake_price"] * $item["quantity"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['address'])) {
        $shippingAddress = $_POST['address'];
        if (empty($street) || empty($city) || empty($state) || empty($zipcode)) {
            header('Location: /profile.php?missing_fields=true');
            exit();
        }
        unset($_SESSION['cart']);
        header('Location: /?success=Purchase');
        exit();
    } else {
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

    <div class="mb-4">
        <h3 class="text-lg font-bold mb-2">Shipping Address</h3>
        <?php if (!empty($street) && !empty($city) && !empty($state) && !empty($zipcode)) : ?>
            <p><?php echo $street . ', ' . $city . ', ' . $state . ', ' . $zipcode; ?></p>
        <?php else : ?>
            <p>Your shipping address is incomplete. Please <a href="/account/settings/edit">update your profile</a>.</p>
        <?php endif; ?>
    </div>

    <?php if (!empty($_SESSION['cart'])) : ?>
        <div class="overflow-x-auto">
            <div class="grid grid-cols-5 gap-x-4 bg-gray-200 text-center py-2">
                <div class="px-4 py-2">Cake Pic</div>
                <div class="px-4 py-2">Cake</div>
                <div class="px-4 py-2">Quantity</div>
                <div class="px-4 py-2">Price</div>
                <div class="px-4 py-2">Total</div>
            </div>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="grid grid-cols-5 gap-x-4 border-b border-gray-200 py-4">
                    <div class="px-4 py-2"><img src="/public/pics/<?php echo $item["cake_pic"]; ?>" alt="Product Image" class="w-16 h-16 mx-auto"></div>
                    <div class="px-4 py-2"><?php echo $item["cake_name"]; ?></div>
                    <div class="px-4 py-2"><?php echo $item["quantity"]; ?></div>
                    <div class="px-4 py-2">€<?php echo $item["cake_price"]; ?></div>
                    <div class="px-4 py-2">€<?php echo $item["cake_price"] * $item["quantity"]; ?></div>
                </div>
            <?php endforeach; ?>
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

    <?php if (!empty($_SESSION['cart']) && (!empty($street) && !empty($city) && !empty($state) && !empty($zipcode))) : ?>
        <script src="https://js.stripe.com/v3/"></script>
   
<script>
    var stripe = Stripe('pk_test_51PD0PvLptHi8PzrflFVoWCXpsodGhRlxVMNK0s2DVftnx1VXfV3DDHJ5Ebq22unBWaPp3yc8sTEVm117uQ05Khb700dXeZWomD');

    // Handle form submission
    document.getElementById('payment-form').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Calculate total price
        var totalPrice = <?php echo $totalPrice; ?>;

        // Create a Stripe Checkout session
        fetch('/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                totalPrice: totalPrice // Sending totalPrice parameter
            })
        }).then(function (response) {
            return response.json();
        }).then(function (session) {
            return stripe.redirectToCheckout({sessionId: session.id});
        }).then(function (result) {
            console.log(result);
        }).catch(function (error) {
            console.error('Error:', error);
        });
    });
</script>
<form id="payment-form" action="/checkout" method="post">
    <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Process Payment</button>
</form>

    <?php endif; ?>
</div>
</body>
</html>
