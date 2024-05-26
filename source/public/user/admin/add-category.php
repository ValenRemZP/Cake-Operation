<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = trim($_POST["name"]);
    $name = htmlspecialchars($name);

    // Insert category into the database
    $sql = "INSERT INTO cakecategories (name) VALUES (?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $name);
    if ($stmt->execute()) {
        ?>
        <script>
        window.location.href = "/account/login";
        </script>
        <?php
        exit();
    } else {
        // Error occurred
        $error = "Error adding category: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <style>
     
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: calc(100% - 22px); /* Adjust for padding and border */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Ensure padding and border are included in width */
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%; /* Make button width 100% */
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Category</h2>
        <?php if (isset($error)) : ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="/dashboard/category" method="post">
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <button type="submit">Add Category</button>
        </form>
    </div>
</body>
</html>
