<?php
require_once LIBRARY . '/util/util.php';
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
<style>
body {
  font-family: "Brush Script MT", cursive;
}
</style>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8 h-14 bg-gradient-to-b from-white to-rose-400">
<i class="fa-solid fa-cake-candles fa-spin fa-spin-reverse fa-xl" style="color: #ffffff;"></i>
<br>
<h1 class="sm:text-center md:text-center text-4xl font-bold mb-8 text-white">Password Reset</h1>

<form action="/account/forgott" method="post" class="flex flex-col gap-8 w-full sm:w-80">
    <div class="form-control">
        <label class="label">
            <span class="label-text text-white text-xl">Email</span>
        </label>
        <input type="email" name="email" value="<?php echo $user_details['email']; ?>" class="input input-bordered bg-white" readonly />
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text text-white text-xl">New Password</span>
        </label>
        <input type="password" name="new_password" placeholder="Enter your new password" class="input input-bordered bg-white" required />
    </div>
    <button type="submit" class="btn btn-ghost bg-gradient-to-br from-white to-rose-400 text-white">Reset Password</button>
</form>
</div>
