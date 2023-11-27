<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

if (isset($_POST['register'])) {
  register($_POST);
  exit();
}

header('Location: /register');
exit();

function register($formData) {
  $firstname = $formData['firstname'];
  $lastname = $formData['lastname'];
  $email = $formData['email'];
  $username = $formData['username'];
  $password = $formData['password'];
  $passwordConfirm = $formData['passwordConfirm'];
  
  $data = fetch('SELECT * FROM users WHERE email = ?', [
    'type' => 's',
    'value' => $email,
  ]);

  if ($data) {
    header('Location: /account/register?error=email');
    exit();
  }
  
  $data = fetch('SELECT * FROM users WHERE username = ?', [
    'type' => 's',
    'value' => $username,
  ]);
  
  if ($data) {
    header('Location: /account/register?error=username');
    exit();
  }
  
  if ($password !== $passwordConfirm) {
    header('Location: /account/register?error=password');
    exit();
  }
  
  $password = password_hash($password, PASSWORD_ARGON2ID);
  $initialized = insertUser($username, $password, $email, $firstname, $lastname);

  if (!$initialized) {
    header('Location: /account/register?error=server');
    return;
  }
  
  header('Location: /account/login?success=register');
  exit();
}

function insertUser($username, $password, $email, $firstname, $lastname) {
  global $connection;


  $userData = insert(
    'INSERT INTO users (username, email, password, firstname, lastname) VALUES (?, ?, ?, ?, ?)',
    ['type' => 's', 'value' => $username],
    ['type' => 's', 'value' => $email],
    ['type' => 's', 'value' => $password],
    ['type' => 's', 'value' => $firstname],
    ['type' => 's', 'value' => $lastname],
  );
 
  if (!$userData) {
    echo "Error during user insertion: " . $connection->error;
    return false;
  }

  // Get the last inserted ID immediately after the insert statement
  $userId = $connection->insert_id;

  if ($userId === 0) {
    echo "Error: Could not retrieve last inserted ID.";
    return false;
  }

  $userProfileData = insert(
    'INSERT INTO userprofile (profilePicture, theme) VALUES ( ?, ?)',

    ['type' => 's', 'value' => 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg'],
    ['type' => 's', 'value' => 'light'],
  
  );
  if (!$userProfileData) {
    echo "Error during user profile insertion: " . $connection->error;
    return false;
  }

  return true;
}