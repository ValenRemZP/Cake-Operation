<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

// Check if the form is submitted for password reset
if(isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update the password in the database
    $sql = "UPDATE users SET password = ? WHERE email = ?";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $email);
    
    if ($stmt->execute()) {
        // Password updated successfully, redirect the user to a login page or any other page
        header('Location: /account/login');
        exit();
    } else {
        // Error occurred while updating password
        $error_message = "Failed to reset password. Please try again later.";
    }

    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $connection->close();
}

// Check if the email parameter is set
if(isset($_GET['email'])) {
    $email = $_GET['email'];
    // Assuming you have a function to retrieve the user's details based on the email
    // You can fetch other user details from the database if needed
    $user_details = getUserDetailsByEmail($email);
} else {
    // If the email parameter is not set, redirect the user back to the forgot password page
    header('Location: /account/forgot');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: "Brush Script MT", cursive;
            background: linear-gradient(to bottom, #ffffff, #ffcccc);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #ff6699;
        }

        .form-control {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-control label {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #ff6699;
        }

        .form-control input[type="email"],
        .form-control input[type="password"] {
            width: 100%;
            padding: 7px;
            border: 2px solid #ff6699;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn {
            padding: 10px 20px;
            background-color: #ff6699;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            color: #ffffff;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #ff4d94;
        }
        </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset</h1>
        <form action="/source/public/account/password_reset.php" method="post" class="form">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $user_details['email']; ?>" readonly>
            </div>
            <div class="form-control">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" placeholder="Enter your new password" required>
            </div>
            <button type="submit" name="reset_password" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
