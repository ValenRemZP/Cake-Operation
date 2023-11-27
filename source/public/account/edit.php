<?php
if (!isset($_SESSION['user'])) {
  header('Location: /');
  exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

$userId = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE users.id = ?";
$data = fetch($query, ['type' => 'i', 'value' => $userId]);
?>

<div class="w-full flex flex-col justify-center items-center px-8 py-8">
  <div class="w-full flex justify-center text-sm breadcrumbs mb-2 md:hidden">
    <ul>
      <li><a href="/">Home</a></li>
      <li>Account</li>
      <li><a href="/account/settings/edit">Settings</a></li>
    </ul>
  </div>
<div class="min-h-[60svh] flex flex-col justify-center rounded-lg items-center p-4 bg-rose-300">
  <br>
<i class="fa-solid fa-cake-candles fa-flip fa-2xl" style="color: #ffffff;"></i>
<br>
  <h1 class="md:text-center text-4xl font-bold mb-8 text-rose-100">Edit your account details</h1>

  <form action="/source/lib/account/update-account.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
    <div class="flex flex-col gap-4">
      
      <div class="flex flex-col gap-4 md:flex-row">
        <!-- Usernale -->
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Username</span>
          </label>
          <input type="text" name="username" value="<?php echo $data['username']; ?>" class="input input-bordered w-full" required />
        </div>

        <!-- Email -->
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Email</span>
          </label>
          <input type="email" name="email" value="<?php echo $data['email']; ?>" class="input input-bordered w-full" required />
        </div>
      </div>

      <div class="flex flex-col gap-4 md:flex-row">
        <!-- Firstname -->
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">First name</span>
          </label>
          <input type="text" name="firstname" value="<?php echo $data['firstname']; ?>" class="input input-bordered w-full" required />
        </div>

        <!-- Lastname -->
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Last name</span>
          </label>
          <input type="text" name="lastname" value="<?php echo $data['lastname']; ?>" class="input input-bordered w-full" required />
        </div>
      </div>
    </div>
<!-- City -->
<div class="form-control">
    <label class="label">
        <span class="label-text text-white">Address</span>
    </label>
    <input type="text" name="address" value="<?php echo $data['address']; ?>" class="input input-bordered w-full" required />
</div>

    
    <button name="update" class="btn btn-ghost bg-rose-400">Update</button>
    
  </form>
</div>
