<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

// Handle form submission
if (isset($_POST['create'])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = uploadImage(); // Upload image and get the filename

    // Validate form data (add your own validation logic)

    // Insert cake into the database
    $query = 'INSERT INTO cakes (category_id, name, description, price, imageUrl) VALUES (?, ?, ?, ?, ?)';
    $success = insert(
        $query,
        ['type' => 'i', 'value' => $category],
        ['type' => 's', 'value' => $title],
        ['type' => 's', 'value' => $description],
        ['type' => 'd', 'value' => $price],
        ['type' => 's', 'value' => $image]
    );

    if ($success) {
        header('Location: /success-page'); // Redirect to success page
        exit();
    } else {
        $error = 'Failed to create cake'; // Display an error message
    }
}

// Function to upload image
function uploadImage() {
    // Check if the file was uploaded without errors
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];

        // Define the target directory
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

        // Generate a unique filename to avoid conflicts
        $baseImageName = uniqid('cake_image_') . '_' . time() . '.jpg';
        $targetFile = $targetDir . $baseImageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($imageTmpName, $targetFile)) {
            // Return the path to the uploaded image
            return 'uploads/' . $baseImageName;
        } else {
            // Return an empty string if the file could not be moved
            return '';
        }
    } else {
        // Return an empty string if the file upload encountered an error
        return '';
    }
}

?>
