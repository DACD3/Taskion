<?php

include 'config.php';
include 'database.php';


$fields = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  foreach($_POST as $key => $value) {
    $fields[$key] = $value;
  }

  foreach($_FILES as $key => $value) {
    $fields[$key] = $value;
  }

  foreach($fields as $key => $value) {

    if (!is_array($value)) {
      echo "$key:$value<br>";
    }

    if (is_array($value)) {
      foreach($value as $file => $file_value) {
        echo "$file:$file_value<br>";
      }
    }
  }

  $hased_password = "";
  $image_data = "";

  $user = new User(null,
                   $fields['Name'],
                   $fields['Username'],
                   $fields['Email'],
                   $hashed_password,
                   $image_data,);


}
