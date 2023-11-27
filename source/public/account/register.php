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
      <li>Account</li>
      <li><a href="/account/register">Register</a></li>
    </ul>
  </div>

  <h1 class="md:text-center text-4xl font-bold mb-8 text-white">Create a new account</h1>

  <form action="/source/lib/account/register.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
    <div class="flex flex-col gap-4">
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">First name</span>
          </label>
          <input type="text" name="firstname" placeholder="Mary Jane" class="bg-white input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Last name</span>
          </label>
          <input type="text" name="lastname" placeholder="Watson" class="bg-white input input-bordered w-full" required />
        </div>
      </div>
      
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Email</span>
          </label>
          <input type="email" name="email" placeholder="CakeyMail!@gmai.com" class="bg-white input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Username</span>
          </label>
          <input type="text" name="username" placeholder="Marilyn" class="bg-white input input-bordered w-full" required />
        </div>
      </div>
      
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Password</span>
          </label>
          <input type="password" name="password" placeholder="Make it hard!" class="bg-white input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text text-white">Confirm password</span>
          </label>
          <input type="password" name="passwordConfirm" placeholder="Make sure!" class="bg-white input input-bordered w-full" required />
        </div>
      </div>
    </div>

    <button name="register" class="btn btn-ghost bg-gradient-to-br from-white to-rose-400 text-white">Register</button>
  </form>

  <div class="w-full text-center mt-8">
    <a class="link text-white" href="/account/login">You already have an account?</a>
  </div>
</div>
