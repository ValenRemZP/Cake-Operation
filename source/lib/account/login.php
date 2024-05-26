<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';


if (isset($_POST['login'])) {
  session_start();
  login($_POST);
  return;
}

header('Location: /');
exit();

function login($formData) {
  if (!isset($formData['email']) || !isset($formData['password'])) {
    header('Location: /account/login?error=missing');
    return;
  }
  
  $email = $formData['email'];
  $password = $formData['password'];
  
  if (empty($email) || empty($password)) {
    header('Location: /account/login?error=empty');
    return;
  }
  
  $auth = authenticate($email, $password);
  
  if (!$auth) {
    header('Location: /account/login?error=invalid');
    return;
  }
  
  $_SESSION['user'] = [
    'id' => $auth['id'],
    'email' => $auth['email'],
    'username' => $auth['username'],
    'theme' => $auth['theme']
  ];
  
  // Fetch user roles
  $roles = fetchall(
    'SELECT roleid FROM userrole_mapping WHERE userid = ?',
    [
      'type' => 'i',
      'value' => $auth['id'],
    ]
  );

  $_SESSION['roles'] = array_column($roles, 'roleid');

  header('Location: /');
  exit();
}

function authenticate($email, $password) {
  var_dump($email, $password);
  $data = fetch(
    'SELECT * FROM userprofile
    JOIN users ON users.id = userprofile.id 
    WHERE users.email = ?',
    [
      'type' => 's',
      'value' => $email,
    ]
  );

  if (!$data) {
    return false;
  }

  if (!password_verify($password, $data['password'])) {
    return false;
  }

  return $data;
}
