<?php
// Handle actions (add, delete, update quantity)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cart_delete"])) {
        // Handle delete from cart logic here
        // ...
    } elseif (isset($_POST["buy"])) {
        // Handle buy selected logic here
        // ...
    } elseif (isset($_POST["delete_selected"])) {
        // Handle delete selected logic here
        // ...
    } elseif (isset($_POST["update_quantity"])) {
        foreach ($_POST['quantity'] as $itemId => $newQuantity) {
            // Handle update quantity logic here
            // Use $itemId to identify the item in the cart and $newQuantity as the new quantity
            // Update the quantity in the cart or database
            // ...
        }
    }
}

// Fetch user's cart items
if ($user) {
    $userId = $_SESSION['user']['id'];
    $cartItems = fetchAll("SELECT * FROM cart WHERE userid = ?", ['type' => 'i', 'value' => $userId]);
} else {
    // For guest users
    $cartItems = isset($_SESSION['guest']['cart']) ? $_SESSION['guest']['cart'] : [];
}
?>




<!-- Cart Page Content -->
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Your Cart</h2>

    <?php if (empty($cartItems)) : ?>
        <p>Your cart is empty.</p>
    <?php else : ?>
        <form action="/cart" method="post">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Select</th>
                        <th class="py-2 px-4 border-b">Cake Name</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Total</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalPrice = 0;
                    foreach ($cartItems as $item) :
                        // Fetch cake details using cakeId
                        $cakeDetails = fetchSin("SELECT * FROM cakes WHERE id = ?", ['type' => 'i', 'value' => $item['cakeId']]);

                        // Check if cakeDetails is not empty before accessing its keys
                        if (!empty($cakeDetails)) {
                            $totalItemPrice = $item['quantity'] * $cakeDetails['price'];
                            $totalPrice += $totalItemPrice;
                    ?>
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    <input type="checkbox" name="selected_items[]" value="<?php echo $item['id']; ?>">
                                </td>
                                <td class="py-2 px-4 border-b"><?php echo $cakeDetails['name']; ?></td>
                                <td class="py-2 px-4 border-b">$<?php echo $cakeDetails['price']; ?></td>
                                <td class="py-2 px-4 border-b">
                                    <input type="number" name="quantity[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
                                </td>
                                <td class="py-2 px-4 border-b">$<?php echo $totalItemPrice; ?></td>
                                <td class="py-2 px-4 border-b">
                                    <button type="submit" name="cart_delete" value="<?php echo $item['id']; ?>" class="bg-red-500 text-white py-1 px-2 rounded">Delete</button>
                                </td>
                            </tr>
                    <?php
                        }
                    endforeach;
                    ?>
                </tbody>
            </table>

            <div class="mt-4 flex justify-end">
                <button type="submit" name="buy" class="btn bg-rose-400">Buy Selected</button>
                <button type="submit" name="delete_selected" class="ml-4 btn bg-red-500 text-white">Delete Selected</button>
            </div>
        </form>

        <p class="mt-4">Total Price: $<?php echo $totalPrice; ?></p>
    <?php endif; ?>
</div>
