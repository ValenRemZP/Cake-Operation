<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: /');
  exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

if (isset($_POST['create'])) {
  $categoryid = $_POST['category'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $file = $_FILES['image'];

  $insertData = addProduct(
    $categoryid,
    $title,
    $description,
    $price,
    $file
  );
}

header('Location: /dashboard/cakes/add?success=cakeAdd');
exit();

function addProduct(

  $categoryid,
  $name,
  $description,
  $price,
  $file
) {
  $query = 'INSERT INTO cakes ( category_id, name, description, price, imageUrl)
            VALUES (?, ?, ?, ?, ?)';

  $imageName = $file['name'];
  $imageTmpName = $file['tmp_name'];

  $targetDir = PUBLIC_R . "/pics/";
  $baseImageName = basename($imageName);
  $targetFile = $targetDir . $baseImageName;

  move_uploaded_file($imageTmpName, $targetFile);

  $insertData = insert(
    $query,
 
    ['type' => 'i', 'value' => $categoryid],
    ['type' => 's', 'value' => $name],
    ['type' => 's', 'value' => $description],
    ['type' => 'd', 'value' => $price],
    ['type' => 's', 'value' => $baseImageName]
  );

  return $insertData;
}
