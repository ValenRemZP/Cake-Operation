<?php
require_once DATABASE . '/connect.php';

if(isset($_POST['reset_password'])) {
   
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    $sql = "SELECT * FROM users WHERE email = ? AND firstname = ? AND lastname = ?";
    

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $email, $first_name, $last_name);
    

    
    $stmt->execute();
    

    $result = $stmt->get_result();
    
   
    if ($result->num_rows > 0) {
        // Redirect the user to the password reset page with the email parameter
        header('Location: /account/forgott?email=' . urlencode($email));
        exit();
    } else {
        // Display an error message if the provided information is incorrect
        $error_message = "Invalid email, first name, or last name. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
<style>
body {
  font-family: "Brush Script MT", cursive;
}
</style>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8 h-14 bg-gradient-to-b from-white to-rose-400">
<i class="fa-solid fa-cake-candles fa-spin fa-spin-reverse fa-xl" style="color: #ffffff;"></i>
<br>
<h1 class="sm:text-center md:text-center text-4xl font-bold mb-8 text-white">Forgot your password?</h1>

<form action="/account/forgot" method="post" class="flex flex-col gap-8 w-full sm:w-80">
    <?php if(isset($error_message)): ?>
    <div class="text-red-500"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <div class="flex flex-col gap-4">
        <div class="form-control">
            <label class="label">
                <span class="label-text text-white text-xl">Email</span>
            </label>
            <input type="email" name="email" placeholder="Your email" class="input input-bordered bg-white" required />
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text text-white text-xl">First Name</span>
            </label>
            <input type="text" name="first_name" placeholder="Your first name" class="input input-bordered bg-white" required />
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text text-white text-xl">Last Name</span>
            </label>
            <input type="text" name="last_name" placeholder="Your last name" class="input input-bordered bg-white" required />
        </div>
    </div>

    <button type="submit" name="reset_password" class="btn btn-ghost bg-gradient-to-br from-white to-rose-400 text-white">Reset Password</button>
</form>
</div>
