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
  '/account/forgot' => [
    'view' => 'account/forgot_password.php',
    'title' => 'Register',
    'nav' => false,
    'footer' => false,
    'container' => false,
  ],
  '/account/forgottwo' => [
    'view' => 'account/password_reset.php',
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
  '/catalog/cake' => [
    'view' => 'catalog/cake.php',
    'title' => 'Cake',
    'nav' => true,
    'footer' => true,
    'container' => true,
  ],
  '/catalog/cakes' => [
    'view' => 'catalog/cakes.php',
    'title' => 'Cake',
    'nav' => true,
    'footer' => true,
    'container' => true,
  ],
  '/add-cart' => [
    'view' => 'user/member/add-cart.php',
    'title' => 'Cake',
    'nav' => true,
    'footer' => true,
    'container' => true,
  ],
  '/cart' => [
    'view' => 'user/member/cart.php',
    'title' => 'Cake',
    'nav' => true,
    'footer' => true,
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
  '/dashboard/cakes/delete' => [
    'view' => 'user/admin/delete-cake.php',
    'title' => 'Delete cakes',
    'nav' => true,
    'footer' => true,
    'container' => true,

  ],
  '/account/history' => [
    'view' => 'user/member/purchase-history.php',
    'title' => 'Delete cakes',
    'nav' => true,
    'footer' => true,
    'container' => true,

  ],
  '/dashboard/cakes/delete' => [
    'view' => 'user/admin/delete-cake.php',
    'title' => 'Delete cakes',
    'nav' => true,
    'footer' => true,
    'container' => true,
    
  ], 
  '/dashboard/cakes/search' => [
    'view' => 'user/admin/search.php',
    'title' => 'Search Cakes',
    'nav' => false,
    'footer' => false,
    'container' => true,
    
],
'/dashboard/admin' => [
  'view' => 'user/admin/add-admin.php',
  'title' => 'Admin',
  'nav' => true,
    'footer' => true,
  'container' => true,
  
],
'/dashboard/category' => [
  'view' => 'user/admin/add-category.php',
  'title' => 'Category',
  'nav' => true,
    'footer' => true,
  'container' => true,
  
],
'/account/favorites' => [
  'view' => 'account/favorites.php',
  'title' => 'Favorite',
  'nav' => true,
  'footer' => true,
  'container' => true,
 
],
'/processpayment' => [
  'view' => 'user/member/checkout.php',
  'title' => 'Check out',
  'nav' => true,
  'footer' => true,
  'container' => true,

],
'/checkout' => [
  'view' => '/user/member/create-checkout-session',
  'title' => 'Check out',
  'nav' => true,
  'footer' => true,
  'container' => true,
  
]
];
