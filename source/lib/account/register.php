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

    // Begin a transaction
    $connection->begin_transaction();

    try {
        // Insert new user into the users table
        $stmt = $connection->prepare('INSERT INTO users (username, email, password, firstname, lastname) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $username, $email, $password, $firstname, $lastname);
        if (!$stmt->execute()) {
            throw new Exception('User insertion failed: ' . $stmt->error);
        }

        // Get the last inserted ID
        $userId = $stmt->insert_id;

        // Insert new user profile
        $profilePicture = 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg';
        $theme = 'light';
        $stmt = $connection->prepare('INSERT INTO userprofile (profilePicture, theme) VALUES (?, ?)');
        $stmt->bind_param('ss', $profilePicture, $theme);
        if (!$stmt->execute()) {
            throw new Exception('User profile insertion failed: ' . $stmt->error);
        }

        // Assign the default 'user' role to the new user
        $roleId = 2; // 'user' role id
        $stmt = $connection->prepare('INSERT INTO userrole_mapping (userid, roleid) VALUES (?, ?)');
        $stmt->bind_param('ii', $userId, $roleId);
        if (!$stmt->execute()) {
            throw new Exception('User role mapping failed: ' . $stmt->error);
        }

        // Commit the transaction
        $connection->commit();
        return true;

    } catch (Exception $e) {
        // Roll back the transaction if any query fails
        $connection->rollback();
        echo $e->getMessage();
        return false;
    }
}
