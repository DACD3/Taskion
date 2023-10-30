<?php

  include_once('../models/User.php');
  session_start();

  if (empty($_SESSION)) {
    header('Location: /login', true);
    exit;
  }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=s, initial-scale=1.0">
  <title>Taskion - App</title>
  <?php include('../includes/styles.php') ?>
  <link rel="stylesheet" href="./assets/css/app.css">
</head>
<body>
  <?php 
    $user = $_SESSION['user'];
  ?>
</body>
</html>