<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if ($user) {
    $theme = ($user["theme"] === 'dark') ? 'light' : 'dark';
}

$searchTerm = $_GET['search'] ?? '';

$userexist = false;


?>

<!-- Top navbar -->
<div class="navbar bg-rose-300 px-2 gap-2 md:gap-0 md:px-4">
  
 <!-- Left - logo -->
<div class="navbar-start flex-1">
<a href="/" class="hidden md:block">
<style>
body{
  font-family: 'Brush Script MT', cursive;
}
</style>
<i  class="text-white text-2xl p-2">Mary cooking</i>
<i class="fa-solid fa-cake-candles fa-flip" style="color: #ffffff;"></i>
</a>
    <!-- Dropdown menu on small devices -->
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost bg-white md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
      </svg>
      </label>
      <ul tabindex="0" class="menu menu-sm ml-0 dropdown-content mt-3 z-[1] p-2 pb-4 shadow  bg-rose-300 rounded-box w-64">
        <li><a href="/" class="text-lg text-white">Home</a></li>
        <div class="divider my-2 px-6"></div>
        

      
            
           <!-- Categories -->
        <li>
          <details>
            <summary class="text-lg text-white">Catalog</summary>
            <ul class="flex flex-col gap-2">
              <?php
                $categories = fetch('SELECT * FROM cakecategories LIMIT 10');
                if ($categories) {
                  foreach ($categories as $category) {
                    echo '
                    <li>
                      <a href="/catalog/cakes?category=' . $category['name'] . '" class="text-lg">
                        <span class="label-text">' . $category['name'] . '</span>
                      </a>
                    </li>
                    ';
                  }
                } 
              ?>
            </ul>
          </details>
        </li>
      </ul>
    </div>
  </div>

    <!-- Center - Search Bar -->
    <div class="navbar-center flex-2 hidden md:flex">
      
        <form class="flex gap-1 w-full" action="/catalog/cakes" method="get">
            <input type="text" name="search" value="<?php echo $searchTerm ?>" placeholder="Search..."
            class="input input-bordered bg-white w-full" required />
            <button type="submit" class="btn btn-square btn-ghost">
                <i class="fa-solid fa-search" style="color: #fb7185;"></i>
            </button>
        </form>

    </div>

    <!-- Right - Cart and User -->
    <div class="navbar-end flex-1 space-x-4">
        <!-- Cart -->
          <div class="hidden md:flex items-center">
              <a href="/cart" class="btn btn-square btn-ghost">
                  <i class="fa-solid fa-shopping-cart fa-inverse"></i>
              </a>
              <!-- Show cart item count -->
              <?php
  $cartCount = 0; 

  if ($user) {
      $cartInfo = fetchSin("SELECT COUNT(*) AS count FROM cart WHERE userid = ?", ['type' => 'i', 'value' => $user['id']]);
      if ($cartInfo && array_key_exists('count', $cartInfo)) {
          $cartCount = $cartInfo['count'];
      }
  } else {
      $cartCount = isset($_SESSION['guest']['cart']) ? count($_SESSION['guest']['cart']) : 0;
  }

  echo '<span class="badge badge-outline fa-inverse ">' . $cartCount . '</span>';

  ?>
          </div>
    

        <!-- User Actions -->
    
 <?php echo isset($_SESSION['user'])
      ? '
      <details class="dropdown dropdown-end">
        <summary class="m-1 btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg" />
          </div>
        </summary>
        <ul class="mt-2 p-2 shadow menu dropdown-content z-[1] bg-white rounded-box w-52">
          <li><a href="/account/profile" class="justify-between text-xl text-rose-500">Profile</a></li>
          <li><a href="/source/lib/user/member/change-theme.php" class="text-xl text-rose-500">Switch to ' . $theme . '</a></li>
          <li><a href="/account/favorites" class="text-xl text-rose-500">Favorites</a></li>     
          <div class="divider px-4 my-2"></div> 
          <li><a href="/account/logout"  class="text-xl text-rose-500">Logout</a></li>
          <div class="divider px-4 mb-2"></div>
          <li>
            <details class="dropdown dropdown-left">
              <summary class="m-1 text-xl text-rose-500">Admin dashboard (beta)</summary>
              <ul class="mr-4 p-2 shadow menu dropdown-content z-[1] bg-base-200 rounded-box w-52">
                <li><a href="/dashboard/cakes/delete"  class="text-xl text-rose-500">Remove cakes</a></li>
                <li><a href="/dashboard/cakes/add"  class="text-xl text-rose-500">Add cake</a></li>
               
              </ul>
            </details>
          </li>
        </ul>
      </details>
      '
    : '<a href="/account/login" class="btn btn-ghost bg-white text-rose-400">Login</a>'; ?>
    

    </div>
</div>

<!-- Bottom navbar -->
<div class="hidden navbar bg-red-100 shadow-sm pt-8 md:flex">
  <div class="navbar-center flex w-full">
    <ul class="menu menu-horizontal px-1 gap-16 w-full justify-center">
    <?php
        $categories = fetch('SELECT * FROM cakecategories LIMIT 10');
        if ($categories) {
          foreach ($categories as $category) {
            echo '
            <a href="/catalog/cakes?category=' . strtolower($category['name']) . '" class="text-center  items-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 group-hover:-translate-y-1 transition">
              </svg>
              <span class="label-text text-xl text-rose-500">' . $category['name'] . '</span>
            </a>
            ';
          }
        }

  
      ?>
    </ul>
  </div>
</div>
