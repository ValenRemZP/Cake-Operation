<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';

function getUserDetailsByEmail($email) {
  global $connection;

    $sql = "SELECT * FROM users WHERE email = ?";
    
   
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    
    
    $stmt->execute();
    
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
   
        $row = $result->fetch_assoc();
        
        $connection->close();
      
        return $row;
    } else {
      
        return false;
    }
}


function fetch($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connection->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();

  return $result->num_rows > 1 || empty($data) ? $data : $data[0];
}

function fetchSingle($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connection->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();

  return $data;
}

function fetchSin($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connection->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_assoc();

  $stmt->close();

  return $data;
}

function insert($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!$stmt) {
      // Error in preparing the statement
      error_log("Error in preparing the statement: " . $connection->error);
      return false;
  }

  if (!empty($params)) {
      $paramTypes = '';
      $paramValues = [];

      foreach ($params as $param) {
          $paramTypes .= $param['type'];
          $paramValues[] = $param['value'];
      }

      $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
      // Error in executing the statement
      error_log("Error in executing the statement: " . $stmt->error);
      $stmt->close();
      $connection->close();
      return false;
  }

  $stmt->close();
  return true;
}

function fetchAll($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connection->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();

  return $data;
}
