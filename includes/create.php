<?php
  require_once 'config.php';
  require_once 'database.php';

  require_once('../models/User.php');
  require_once('../models/Project.php');
  require_once('../models/Task.php');

  $operationsMap = [
    'createProject' => 'handleCreateProject',
    'createTask' => 'handleCreateTask',
    'logout' => 'handleLogout'
  ];

  function handleCreateProject($fields) {
    global $conn;

    $conn->beginTransaction();

    try {

      $user = $_SESSION['user'];

      $sql = "INSERT INTO projects (Name) VALUES (?)";
      
      $project_name = htmlspecialchars($fields["Name"], 
                                       ENT_QUOTES, 'UTF-8');

      if (empty($project_name)) {
        echo '<p class="error">El nombre de proyecto no puede estar vacio.</p>';
        return;
      }

      executeQuery(false, $sql, [
        $project_name
      ]);

      $project_id = $conn->lastInsertId();

      $sql = 'INSERT INTO users_has_projects (project_id, user_id) VALUES (?, ?)';

      executeQuery(false, $sql, [
        $project_id,
        $user->getId(),
      ]);

      $conn->commit();

      echo '<p class="sucess"> <span onclick="close(e)" class="closeable fas fa-times fa-xl"></span> ¡Proyecto creado correctamente!
      </p>';
    }
    catch (Exception $e) {
      $conn->rollback();

      echo "Error: " . $e->getMessage();
    }
  }

  function handleCreateTask($fields)
  {
    global $conn;

    $conn->beginTransaction();

    try {
      $project_id = $fields['project'] ?? null;

      $sql = 'INSERT INTO tasks (Name, Description) VALUES (?, ?)';

      $task_name = htmlspecialchars($fields['Name'], ENT_QUOTES, 'UTF-8');

      $task_description = htmlspecialchars($fields['Description'], ENT_QUOTES, 'UTF-8');

      if (empty($task_name)) {
        echo '<p class="error">El nombre de la tarea no puede estar vacio.</p>';
        return;
      }

      executeQuery(false, $sql, [
        $task_name,
        $task_description
      ]);

      $task_id = $conn->lastInsertId();

      $sql = 'INSERT INTO projects_has_tasks (project_id, task_id) VALUES (?, ?)';

      executeQuery(false, $sql, [
        $project_id,
        $task_id
      ]);

      $conn->commit();

      echo '<p class="sucess"> <span onclick="close(e)" class="closeable fas fa-times fa-xl"></span> ¡Proyecto creado correctamente!</p>';
    } catch (Exception $e) {
      $conn->rollback();
      echo "Error: " . $e->getMessage();
    }
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