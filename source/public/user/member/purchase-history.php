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
    exit(); // Stop further execution
}

// Fetch user's purchase history from the database
$sql = "SELECT * FROM userpurchase WHERE userid = ?";
$stmt = $connection->prepare($sql);
if (!$stmt) {
    echo "Error preparing SQL: " . $connection->error;
    exit();
}
$stmt->bind_param("i", $_SESSION['user']['id']);
if (!$stmt->execute()) {
    echo "Error executing SQL: " . $stmt->error;
    exit();
}
$result = $stmt->get_result();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-3xl mb-4">Purchase History</h2>

        <div class="mt-4">
            <?php if ($result && $result->num_rows > 0) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Purchase Time</th>
                            <th>Price</th>
                            <th>PDF Filename</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['purchaseTime']; ?></td>
                                <td>€<?php echo number_format($row['price'], 2); ?></td>
                                <td><?php echo $row['pdfFilename']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="no-data">No purchase history available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
