<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

session_start();

if (isset($_POST["favoriteIt"])) {
    $userid = $_SESSION['user']['id'] ;
    $proid = $_POST['cakeid'];
    $referer = $_POST['refer'];

    $sql = insert("INSERT INTO favorites (userid, cakeid) VALUES ($userid, $proid)");
   
   header('Location: ' . $referer);
  }


?>