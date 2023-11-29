<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

if (isset($_SESSION['user']) && isset($_POST['update'])) {
    updateProfile($_SESSION['user']['id'], $_POST);
    return;
}

header('Location: /');
exit();

function updateProfile($userId, $formData) {
    $query = 'SELECT * FROM users WHERE username = ?';
    $data = fetch($query, ['type' => 's', 'value' => $formData['username']]);

    if ($data && $data['id'] !== $userId) {
        header('Location: /account/settings/edit?error=usernameTaken');
        exit();
    }

    $newUsername = $formData['username'];
    $newEmail = $formData['email'];
    $newFirstname = $formData['firstname'];
    $newLastname = $formData['lastname'];
    $newStreet = $formData['street']; // Assuming 'street' is the name attribute in the HTML form
    $newCity = $formData['city'];
    $newState = $formData['state'];
    $newZipcode = $formData['zipcode'];

    $query = 'SELECT * FROM users WHERE id = ?';
    $data = fetch($query, ['type' => 'i', 'value' => $userId]);

    if (
        $data['username'] === $newUsername &&
        $data['email'] === $newEmail &&
        $data['firstname'] === $newFirstname &&
        $data['lastname'] === $newLastname &&
        $data['street'] === $newStreet &&
        $data['city'] === $newCity &&
        $data['state'] === $newState &&
        $data['zipcode'] === $newZipcode
    ) {
        header('Location: /account/settings/edit?error=noChanges');
        exit();
    }

    $query =
        'UPDATE users SET username = ?, email = ?, firstname = ?, lastname = ?, street = ?, city = ?, state = ?, zipcode = ? WHERE id = ?';
    $update = insert(
        $query,
        ['type' => 's', 'value' => $newUsername],
        ['type' => 's', 'value' => $newEmail],
        ['type' => 's', 'value' => $newFirstname],
        ['type' => 's', 'value' => $newLastname],
        ['type' => 's', 'value' => $newStreet],
        ['type' => 's', 'value' => $newCity],
        ['type' => 's', 'value' => $newState],
        ['type' => 's', 'value' => $newZipcode],
        ['type' => 's', 'value' => $userId],
    );

    if ($update) {
        header('Location: /account/settings/edit?success=accountUpdate');
        exit();
    }

    header('Location: /account/settings/edit?error=accountUpdate');
    exit();
}
?>
