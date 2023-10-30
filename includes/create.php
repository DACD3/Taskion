<?php
  include 'config.php';
  include 'database.php';

  require_once('../models/User.php');
  require_once('../models/Project.php');
  require_once('../models/Task.php');

  $operationsMap = [
    'createProject' => 'handleCreateProject',
    'createTask' => 'handleCreateTask',
    'logout' => 'handleLogout'
  ];

  $message = "";


  function handleCreateProject($fields) {
    global $conn;

    $conn->beginTransaction();

    try {

      $user = $_SESSION['user'];

      $sql = "INSERT INTO projects (Name) VALUES (?)";

      executeQuery(false, $sql, [
        $fields['Name']
      ]);

      $project_id = $conn->lastInsertId();

      $sql = 'INSERT INTO users_has_projects (project_id, user_id) VALUES (?, ?)';

      executeQuery(false, $sql, [
        $project_id,
        $user->getId(),
      ]);

      $conn->commit();

      echo '<p class="sucess">¡Proyecto creado correctamente!</p>';
    }
    catch (Exception $e) {
      $conn->rollback();

      echo "Error: " . $e->getMessage();
    }
  }
  
  function handleCreateTask($fields) {
    $sql = '';
  }

  function handleLogout() {
    session_unset();
    session_destroy();

    header('Location: /');
    
    exit;
  }

  $operation = $_GET['operation'] ?? null;

  if (isset($operationsMap[$operation])) { 
    $operationsMap[$operation]($_POST);
  } 