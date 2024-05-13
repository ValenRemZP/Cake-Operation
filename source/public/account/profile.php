<?php
// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

// Get the user ID from the session
$userId = $_SESSION['user']['id'];

// Fetch user data
$query = "SELECT * FROM users WHERE users.id = ?";
$data = fetchSingle($query, ['type' => 'i', 'value' => $userId]);

// Fetch user profile data
$query = "SELECT * FROM userprofile WHERE id = ?";
$userProfile = fetchSingle($query, ['type' => 'i', 'value' => $userId]);

// Check if the user profile exists
if ($userProfile) {
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <style>
Body {
  font-family: "Brush Script MT", cursive;
}
</style>
    <body class="bg-gray-100 min-h-screen items-center justify-center ">
        <div class="bg-white p-8 shadow-md rounded-md max-w-md">
            <h1 class="text-3xl font-bold mb-4 text-rose-300">Welcome, <?= $data[0]['username'] ?>!</h1>
            <img src="<?= $userProfile[0]['profilePicture'] ?>" alt="Profile Picture" class="max-w-full mb-4 rounded-md">
         

          <br>
          <div class="flex justify-center">
    <a class="btn btn-ghost text-center" href="/account/settings/edit">Edit</a>
</div>

    </body>
    </html>
    <?php
} else {
    echo '<p>Profile not found</p>';
}
?>
