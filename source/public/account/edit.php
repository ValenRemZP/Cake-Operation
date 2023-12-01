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
      <li><a href="/account/settings/edit">Edit</a></li>
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
          <!-- Username -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">Username</span>
            </label>
            <input type="text" name="username" value="<?php echo $data['username']; ?>" class="input input-bordered w-full text-xl" required />
          </div>

          <!-- Email -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">Email</span>
            </label>
            <input type="email" name="email" value="<?php echo $data['email']; ?>" class="input input-bordered w-full text-xl" required />
          </div>
        </div>

        <div class="flex flex-col gap-4 md:flex-row">
          <!-- First name -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">First name</span>
            </label>
            <input type="text" name="firstname" value="<?php echo $data['firstname']; ?>" class="input input-bordered w-full text-xl" required />
          </div>

          <!-- Last name -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">Last name</span>
            </label>
            <input type="text" name="lastname" value="<?php echo $data['lastname']; ?>" class="input input-bordered w-full text-xl" required />
          </div>
        </div>

        <div class="flex flex-col gap-4 md:flex-row">
          <!-- Street -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">Street</span>
            </label>
            <input type="text" name="street" value="<?php echo $data['street']; ?>" class="input input-bordered w-full text-xl" required />
          </div>

          <!-- City -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">City</span>
            </label>
            <input type="text" name="city" value="<?php echo $data['city']; ?>" class="input input-bordered w-full text-xl" required />
          </div>

          <!-- State -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">State</span>
            </label>
            <input type="text" name="state" value="<?php echo $data['state']; ?>" class="input input-bordered w-full text-xl" required />
          </div>

          <!-- Zipcode -->
          <div class="form-control md:flex-1">
            <label class="label">
              <span class="label-text text-white text-xl">Zipcode</span>
            </label>
            <input type="text" name="zipcode" value="<?php echo $data['zipcode']; ?>" class="input input-bordered w-full text-xl" required />
          </div>
        </div>
      </div>

      <button name="update" class="btn btn-ghost bg-rose-400 text-white">Update</button>

    </form>
  </div>
</div>
