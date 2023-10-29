<?php

include 'config.php';
include 'database.php';

require_once '../models/User.php';

$fields = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  foreach ($_POST as $key => $value) {
    $fields[$key] = $value;
  }

  $fields['Password'] = password_hash($fields['Password'], PASSWORD_DEFAULT);


  $sql = "SELECT * FROM users where Email = ? and Password = ?";

  var_dump($fields);

  $result = executeQuery(true, $sql, [
    $fields['Email'],
    $fields['Password']
  ]);

  var_dump($result);

  if (empty($result)) {
    echo "<p class='error'>Los campos están vacios.</p>";
    exit;
  }

  var_dump($result);
  
  if (isset($result)) {
    $user = new User(
      null,
      $result['Name'],
      $result['Username'],
      $result['Email'],
      $result['Password'],
      $result['Avatar']
    );
  }


  session_start();

  if ($fields['Email'] == $result['Email'] && password_verify($fields['Password'], $result['Password'])) {
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $user;

    header('');
    exit;
  } 
  else {
    echo "<p class='error'>Creedenciales de inicio de sesión invalidas</p>";
    exit;
  }
}
