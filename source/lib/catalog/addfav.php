<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

session_start();

if (isset($_POST["favoriteIt"])) {
    $userid = $_SESSION['user']['id'] ;
    $proid = $_POST['cake_id'];
    $referer = $_POST['refer'];

    $query = "SELECT * FROM favorites WHERE userid = ? AND cakeid = ?";
    $data = fetch($query, ['type' => 'i', 'value' => $userid], ['type' => 'i', 'value' => $proid]);

    if ($data) {
        header('Location: ' . $referer);
        exit();
    }

    $query = "INSERT INTO favorites (userid, cakeid) VALUES (?, ?)";
    insert($query, ['type' => 'i', 'value' => $userid], ['type' => 'i', 'value' => $proid]);
   
   header('Location: ' . $referer);
  }
?>