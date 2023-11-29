<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php'; 
include_once LIBRARY . '/catalog/cakes.php';

if (isset($_GET['id'])) {
  header('location: /catalog/cake?id=' . $_GET["id"] . '');
}
?> 