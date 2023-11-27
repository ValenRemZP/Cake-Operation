<?php

$routes = [
  '/' => [
    'view' => 'index.php',
    'title' => 'Home',
    'nav' => true,
    'footer' => true,
    'container' => true,
  ],
  // Account routes
  '/account/login' => [
    'view' => 'account/login.php',
    'title' => 'Login',
    'nav' => false,
    'footer' => false,
    'container' => false,
  ],
  '/account/register' => [
    'view' => 'account/register.php',
    'title' => 'Register',
    'nav' => false,
    'footer' => false,
    'container' => false,
  ],
  '/account/logout' => [
    'view' => 'account/logout.php',
    'title' => 'Logout',
    'nav' => false,
    'footer' => false,
    'container' => true,
  ],
  '/account/settings/edit' => [
    'view' => 'account/edit.php',
    'title' => 'Edit account settings',
    'nav' => true,
    'footer' => true,
    'container' => true,
  ],
  '/account/profile' => [
    'view' => 'account/profile.php',
    'title' => 'Edit account settings',
    'nav' => true,
    'footer' => true,
    'container' => true,
  ],
  // product share
  '/products/share' => [
    'view' => 'catalog/share.php',
    'title' => 'Products',
    'nav' => false,
    'footer' => false,
    'container' => true,
  ],
  // Error routes
  '/404' => [
    'view' => 'error/404.php',
    'title' => 'Not Found',
    'nav' => false,
    'footer' => false,
    'container' => false,
  ],
  //admin routes
  '/dashboard/cakes/add' => [
    'view' => 'user/admin/add-cake.php',
    'title' => 'Add cakes',
    'nav' => true,
    'footer' => false,
    'container' => true,
  ],
];
