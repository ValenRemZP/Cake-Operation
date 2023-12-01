<?php
// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cakeoperation');

// Import aliases
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ROUTES', ROOT . '/routes.php');
define('PUBLIC_R', ROOT . '/public');
define('SRC', ROOT . '/source');
define('COMPONENTS', SRC . '/components');
define('DATABASE', SRC . '/database');
define('LIBRARY', SRC . '/lib');
define('PUBLIC_S', SRC . '/public');

// User structure
define('USER_STRUCTURE', [
  'id' => null,
  'username' => null,
  'email' => null,
  'theme' => null,

]);

// Error mapping
define('ERROR_MAPPING', [
  'server' => 'Something went wrong on our end, please try again later',
  'missing' => 'Missing email or password',
  'empty' => 'Empty email or password',
  'invalid' => 'Invalid email or password',
  'password' => 'Passwords do not match',
  'email' => 'Email is already in use',
  'noChanges' => 'No changes were made',
  'Purchase' => 'The purchase has not been successful.',
  'accountUpdate' => 'Something went wrong while updating your account',
  'usernameTaken' => 'Username is already taken',
  'deletecake' => 'Failed to delete cake',
  'leaveReview' => 'Failed to leave review',
  'cakeAdd' => 'Failed to add cake to the Database.',
]);

// Success mapping
define('SUCCESS_MAPPING', [
  'register' => 'You have been succesfully registered',
  'accountUpdate' => 'Your account has been updated',
  'deletecake' => 'cake has been deleted',
  'Purchase' => 'The purchase has been successful.',
  'leaveReview' => 'Review has been left',
  'cakeAdd' => 'Succesfully added cake to the Database.',

]);

// Theme mapping
define('THEME_MAPPING', [
  'default' => 'customLight',
  'dark' => 'customDark',
  'light' => 'customLight',
]);

?>
