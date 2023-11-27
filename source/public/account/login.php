<?php
if (isset($_SESSION['user'])) {
  header('Location: /');
  exit();
} ?>

<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8 h-14 bg-gradient-to-b from-white to-rose-400">
<i class="fa-solid fa-cake-candles fa-spin fa-spin-reverse fa-xl" style="color: #ffffff;"></i>
<br>
  <div class="w-full flex justify-center text-sm breadcrumbs mb-2 text-white">
    <ul>
      <li><a href="/">Home</a></li> 
      <li><a href="/account/login">Account</a></li>
      <li><a href="/account/login">Login</a></li>
    </ul>
  </div>

  <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8 text-white">Log in to your account</h1>
  
  <form action="/source/lib/account/login.php" method="post" class="flex flex-col gap-8 w-full sm:w-80">
    <div class="flex flex-col gap-4">
      <div class="form-control">
        <label class="label">
          <span class="label-text text-white">Email</span>
        </label>
        <input type="email" name="email" placeholder="CakeyMail!@gmai.com" class="input input-bordered bg-white" required />
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text text-white">Password</span>
        </label>
        <input type="password" name="password" placeholder="Make it hard!" class="input input-bordered bg-white" required />
      </div>
    </div>

    <button name="login" class="btn btn-ghost bg-gradient-to-br from-white to-rose-400 text-white">Sign in</button>
  </form>

  <div class="w-full text-center mt-8">
    <a class="link text-white" href="/account/register">You don't have an account yet?</a>
    
  </div>
  <div class="w-full text-center mt-8">
    <a class="link text-white" href="/account/register">Forgot your password?</a>
    
  </div>
</div>