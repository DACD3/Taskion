<?php

include 'config.php';
include 'database.php';

require_once '../models/User.php';

$fields = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  foreach($_POST as $key => $value) {
    $fields[$key] = $value;
  }

  foreach($_FILES as $key => $value) {
    $fields[$key] = $value;
  }

  foreach($fields as $key => $value) {  
    if (is_array($value)) {
      foreach($value as $file => $file_value) {
        $fields[$file] = $file_value;
      }
    }
  }

  $image_data = file_get_contents($fields['tmp_name']);

  $user = new User(null,
                   $fields['Name'],
                   $fields['Username'],
                   $fields['Email'],
                   null,
                   $image_data,);

  $user->setPassword($fields['Password']);

  $sql = "INSERT INTO users (Name, Username, Email, Password, Avatar) VALUES (?, ?, ?, ?, ?)";

  $result = executeQuery(false, $sql, [
    $user->getName(),
    $user->getUsername(),
    $user->getEmail(),
    $user->getPassword(),
    $user->getAvatar(),
  ]);

  if ($result) {
    echo '<p class="sucess">Usuario registrado</p>';
  }

}
