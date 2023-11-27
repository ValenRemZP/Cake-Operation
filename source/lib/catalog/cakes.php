<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php'; 

function getAllCakes() {
  $cakes = fetchSingle('SELECT * FROM cakes');

  foreach ($cakes as &$cake) {
    if (strlen($cake['name']) > 20) {
      $cake['name'] = substr_replace($cake['name'], '...', 21);
    }

    if (strlen($cake['description']) > 100) {
      $product['description'] = substr_replace($cake['description'], '...', 101);
    }
  }

  return $cakes;
}


