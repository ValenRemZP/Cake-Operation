<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$status = "";

// Remove item from cart
if (isset($_POST['action']) && $_POST['action'] == "remove") {
    if (!empty($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($_POST["ID"] == $value['cake_id']) {
                unset($_SESSION["cart"][$key]);
                $status = "<div class='text-green-600'>Product removed from your cart!</div>";
            }
            if (empty($_SESSION["cart"])) {
                unset($_SESSION["cart"]);
            }
        }
    }
}

// Update item quantity in cart
if (isset($_POST['action']) && $_POST['action'] == "change") {
    foreach ($_SESSION["cart"] as &$value) {
        if ($value['cake_id'] === $_POST["ID"]) {
            $value['quantity'] = $_POST["quantity"];
            break;
        }
    }
}

// Check if any item is selected
$selectedItems = isset($_POST['selected_cakes']) && is_array($_POST['selected_cakes']) ? $_POST['selected_cakes'] : [];
$disableCheckout = empty($selectedItems);
?>

<html>
<head>
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Brush Script MT', cursive;
            background-color: #f4f5f7;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-8">
    <h2 class="text-3xl mb-4">Your Shopping Cart</h2>

    <?php if (!empty($_SESSION["cart"])) : ?>
        <div class="overflow-x-auto">
            <form method='post' id="cartForm" action="">
                <div class="grid grid-cols-7 gap-x-4 bg-rose-100">
                    <div class="px-4 py-2 bg-rose-200">Select</div>
                    <div class="px-4 py-2 bg-rose-200">Cake Pic</div>
                    <div class="px-4 py-2 bg-rose-200">Cake</div>
                    <div class="px-4 py-2 bg-rose-200">Quantity</div>
                    <div class="px-4 py-2 bg-rose-200">Price</div>
                    <div class="px-4 py-2 bg-rose-200">Total</div>
                    <div class="px-4 py-2 bg-rose-200">Action</div>

                    <?php
                    $total_price = 0;
                    foreach ($_SESSION["cart"] as $key => $product) :
                        ?>
                        <div class="px-4 py-2">
                            <input type="checkbox" name="selected_cakes[]" value="<?php echo $product["cake_id"]; ?>"
                                   class="product-checkbox" data-price="<?php echo $product["cake_price"]; ?>"
                                   data-quantity="<?php echo $product["quantity"]; ?>"
                                <?php echo (in_array($product['cake_id'], $selectedItems)) ? 'checked' : ''; ?>>
                        </div>
                        <div class="px-4 py-2">
                            <?php if (isset($product["cake_pic"])): ?>
                                <img src="/public/pics/<?php echo $product["cake_pic"]; ?>" alt="Product Image"
                                     class="w-16 h-16 mr-2">
                            <?php endif; ?>
                        </div>
                        <div class="px-4 py-2"><?php echo isset($product["cake_name"]) ? $product["cake_name"] : ""; ?></div>
                        <div class="px-4 py-2">
                            <form method='post' action='/cart'>
                                <input type='hidden' name='ID' value="<?php echo $product["cake_id"]; ?>"/>
                                <input type='hidden' name='action' value="change"/>
                                <select name='quantity' onchange="this.form.submit()"
                                        class="border border-gray-300 rounded-md px-2 py-1">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        echo "<option " . ($product["quantity"] == $i ? "selected" : "") . " value='$i'>$i</option>";
                                    } ?>
                                </select>
                            </form>
                        </div>
                        <div class="px-4 py-2">€<?php echo isset($product["cake_price"]) ? $product["cake_price"] : ""; ?></div>
                        <div
                            class="px-4 py-2 product-total">€<?php echo isset($product["cake_price"]) && isset($product["quantity"]) ? ($product["cake_price"] * $product["quantity"]) : ""; ?></div>
                        <div class="px-4 py-2">
                            <form method='post' action='/cart'>
                                <input type='hidden' name='ID'
                                       value="<?php echo isset($product['cake_id']) ? $product['cake_id'] : ""; ?>"/>
                                <input type='hidden' name='action' value="remove"/>
                                <button type='submit' class="btn btn-error btn-square" name="delete">
                                    <i class="fa-regular fa-trash-can fa-xl text-red"></i>
                                </button>
                            </form>
                        </div>
                        <?php
                        if (isset($product["cake_price"]) && isset($product["quantity"]) && in_array($product['cake_id'], $selectedItems)) {
                            $total_price += ($product["cake_price"] * $product["quantity"]);
                        }
                    endforeach;
                    ?>
                </div>
                <div class="mt-4">
                    <p id="totalPrice" class="text-xl flex justify-center font-semibold">Total: €<?php echo $total_price; ?></p>
                </div>
            </form>
        </div>
    <?php else : ?>
        <div class="bg-white shadow-md p-4">Your cart is empty!</div>
    <?php endif; ?>

    <div class="mt-4">
        <?php echo $status; ?>
    </div>


    <div class="flex justify-center gap-x-4 mt-4">
        <form method='post' action='/processpayment'>
            <button type="submit" id="checkoutButton" class="btn bg-rose-400 text-white px-4 py-2 rounded" <?php if ($disableCheckout) echo 'disabled'; ?>>Process checkout</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        const totalPriceElement = document.getElementById('totalPrice');
        const checkoutButton = document.getElementById('checkoutButton');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                let total = 0;
                checkboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        const price = parseFloat(checkbox.getAttribute('data-price'));
                        const quantity = parseInt(checkbox.getAttribute('data-quantity'));
                        total += price * quantity;
                    }
                });
                totalPriceElement.textContent = 'Total: €' + total.toFixed(2);
                checkoutButton.disabled = !document.querySelector('.product-checkbox:checked');
            });
        });
    });
</script>

</body>
</html>
