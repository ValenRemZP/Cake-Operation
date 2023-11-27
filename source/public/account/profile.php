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
    // Display profile information with Tailwind CSS
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 min-h-screen items-center justify-center">
        <div class="bg-white p-8 shadow-md rounded-md max-w-md">
            <h1 class="text-3xl font-bold mb-4 text-rose-300">Welcome, <?= $data[0]['username'] ?>!</h1>
            <img src="<?= $userProfile[0]['profilePicture'] ?>" alt="Profile Picture" class="max-w-full mb-4 rounded-md">
         

      <div class="stat w-60 h-60">
        <div class="stat-title text-center text-xl text-rose-300 font-bold">Favorite Products</div>
        <div class="stat-value text-center text-rose-200">0</div>
        <div class="stat-desc text-rose-300">Your count of favorite products</div>
      </div>

      <div class="stat w-60 h-60">
        <div class="stat-title text-center font-bold text-rose-300 text-xl">Ordered Products</div>
        <div class="stat-value text-center text-rose-200">0</div>
        <div class="stat-desc text-rose-300">Your count of ordered products</div>
      </div>

      <div class="stat w-60 h-60">
        <div class="stat-title text-center font-bold text-xl text-rose-300">Purchased Products</div>
        <div class="stat-value text-center text-rose-200">0</div>
        <div class="stat-desc text-rose-300">Your count of purchased products</div>
        <div class="text-rose-300">
<a class="btn btn-ghost items-center justify-center" href="/account/settings/edit">Edit</a>
        </div>
            <div class="inline-block align-top m-2">
    

    </div>
  </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo '<p>Profile not found</p>';
}
?>
