<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';

// Check if the form to reset the password has been submitted
if (isset($_POST['reset_password'])) {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Prepare SQL statement to verify the reset token and ensure it hasn't expired
    $sql = "SELECT email FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
    }
    $stmt->bind_param("s", $token);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $result = $stmt->get_result();
    
    // Check if a matching record is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Prepare SQL statement to update the user's password and remove the reset token and expiry time
        $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
        }
        $stmt->bind_param("ss", $hashed_password, $email);
        
        if ($stmt->execute()) {
            // Password updated successfully, redirect to the login page
            header('Location: /account/login');
            exit();
        } else {
            // Display error message if password reset fails
            $error_message = "Failed to reset password. Please try again later.";
        }
    } else {
        // Display error message if the token is invalid or expired
        $error_message = "Invalid or expired token. Please request a new password reset.";
    }

    $stmt->close();
    $connection->close();
}

// Check if a token is provided in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepare SQL statement to verify the reset token and ensure it hasn't expired
    $sql = "SELECT email FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
    }
    $stmt->bind_param("s", $token);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $result = $stmt->get_result();
    
    // Check if a matching record is found
    if ($result->num_rows == 0) {
        // Invalid or expired token, redirect to forgot password page
        header('Location: /account/forgot');
        exit();
    }

    $stmt->close();
} else {
    // Redirect to forgot password page if no token is provided
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
        <?php if (isset($error_message)): ?>
        <div class="text-red-500"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="/source/public/account/password_reset.php" method="post" class="form">
            <!-- Hidden input to pass the reset token -->
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="form-control">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" placeholder="Enter your new password" required>
            </div>
            <button type="submit" name="reset_password" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
