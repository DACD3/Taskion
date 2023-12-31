<?php

include 'config.php';
include 'database.php';

require_once '../models/User.php';

$fields = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  foreach ($_POST as $key => $value) {
    $fields[$key] = $value;
  }

  $sql = "SELECT * FROM users where Email = ?";

  $result = executeQuery(true, $sql, [
    $fields['Email'],
  ]);

  if (empty($result)) {
    echo "<p class='error'>Los campos están vacios.</p>";
    exit;
  }

  if ($result) {
    $user = new User(
      $result[0]['id'],
      $result[0]['Name'],
      $result[0]['Username'],
      $result[0]['Email'],
      $result[0]['Password'],
      $result[0]['Avatar']
    );

    session_start();

    if (password_verify($fields['Password'], $result[0]['Password'])) {
      $_SESSION['loggedin'] = true;
      $_SESSION['user'] = $user;

      echo "<p class='sucess'>Autenticado correctamente</p>";
      
      header('Location: /app', true);
      exit;
    } 
    else {
      echo "<p class='error'>Creedenciales de inicio de sesión invalidas</p>";
      exit;
    }
  }
}
