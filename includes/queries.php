<?php

  require_once 'config.php';
  require_once 'database.php';

  require_once('../models/User.php');
  require_once('../models/Project.php');
  require_once('../models/Task.php');


  function getUserData() {
    $user = $_SESSION['user'];

    return $user;
  }

  function getProjectsByUser() {
    $user = getUserData();

    $sql = "SELECT p.* FROM projects p JOIN users_has_projects up ON p.id = up.project_id WHERE up.user_id = ?";

    $result = executeQuery(true, $sql, [
      $user->getId()
    ]);

    $_SESSION['projects'] = $result;
  }

  getProjectsByUser(); 