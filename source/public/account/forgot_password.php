<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require ROOT . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    $sql = "SELECT * FROM users WHERE email = ? AND firstname = ? AND lastname = ?";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
    }
    $stmt->bind_param("sss", $email, $first_name, $last_name);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User exists, generate a reset token
        $token = bin2hex(random_bytes(16)); // Generate a random token
        $expiry_time = date("Y-m-d H:i:s", strtotime('+1 hour')); // Set expiry time to 1 hour from now

        // Insert token into database
        $sql = "UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
        }
        $stmt->bind_param("sss", $token, $expiry_time, $email);
        if (!$stmt->execute()) {
            die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }
        
        // Send reset link to the user's email
        $reset_link = "http://localhost:3000/account/forgottwo?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Hi $first_name, click the following link to reset your password: $reset_link";

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'lacnioritaarmy@gmail.com'; // SMTP username
          $mail->Password = 'nkwl gjxh kehj kyxw'; // Use the generated App Password here
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('no-reply@MaryCooking.com', 'Mary Cooking');
            $mail->addAddress($email, $first_name . ' ' . $last_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            $success_message = "A password reset link has been sent to your email.";
        } catch (Exception $e) {
            $error_message = "Failed to send the password reset email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $error_message = "Invalid email, first name, or last name. Please try again.";
    }

    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        }

        .form-control label {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #ff6699;
        }

        .form-control input[type="email"],
        .form-control input[type="text"] {
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
        <h1>Forgot your password?</h1>
        <?php if (isset($error_message)): ?>
        <div class="text-red-500"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
        <div class="text-green-500"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form action="/account/forgot" method="post" class="form">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Your email" required />
            </div>
            <div class="form-control">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" placeholder="Your first name" required />
            </div>
            <div class="form-control">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" placeholder="Your last name" required />
            </div>
            <button type="submit" name="reset_password" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>