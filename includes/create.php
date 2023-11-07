<?php
  require_once 'config.php';
  require_once 'database.php';
  require_once 'queries.php';

  require_once('../models/User.php');
  require_once('../models/Project.php');
  require_once('../models/Task.php');

  $operationsMap = [
    'createProject' => 'handleCreateProject',
    'createTask' => 'handleCreateTask',
    'logout' => 'handleLogout',
    'editProject' => 'handleEditProject',
    'taskHandle' => 'handleTask'
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

      echo '<p class="sucess"> <span onclick="close(e)" class="closeable fas fa-times fa-xl"></span> ¡Tarea creada correctamente!</p>';
    } catch (Exception $e) {
      $conn->rollback();
      echo "Error: " . $e->getMessage();
    }
  }

  function handleEditProject($fields) {

    // Get operation
    $operation = $fields['operation'] ?? null;

    // Get project id 
    $project_id = $fields['project-id'] ?? null;

    // Get project name 
    $project_name = $fields['project-name'] ?? null;

    // Check if name is not equal that is stored already
    $sql = "SELECT Name from projects WHERE id = ?";


    $retrieved_name = executeQuery(false, $sql, [
      $project_id
    ]); // acess to the first position of the "result array"

    if ($project_name == $retrieved_name) {
      return;
    }

    switch($operation) {
      case "delete":

        $sql = "DELETE FROM projects where id = ?";

        executeQuery(false, $sql, [
          $project_id
        ]);

        // Decide what to do here :/

        break;
      case "save":

        $sql = "UPDATE projects SET Name = ? WHERE id = ?";

        executeQuery(false, $sql, [
          $project_name,
          $project_id
        ]);

        break;
    }

    // Update projects session object
    getProjectsByUser();
  }

  function handleTask($fields) {

    $operation = $fields['operation'] ?? null;

    $task_id = $fields['task-id'] ?? null;
    $task_name = $fields['task-name'] ?? null;
    $task_description = $fields['task-description'] ?? null;

    $sql = "SELECT Name from projects WHERE id = ?";


    $retrieved_name = executeQuery(false, $sql, [
      $task_id
    ]); // acess to the first position of the "result array"

    if ($task_name == $retrieved_name) {
      return;
    }

    switch($operation) {
      case "delete":
        
        $sql = "DELETE FROM tasks where id = ?";

        executeQuery(false, $sql, [
          $task_id
        ]);
        
        break;
      case "save":

        $sql = "UPDATE tasks SET Name = ? and Description = ? WHERE id = ?";

        executeQuery(false, $sql, [
            $task_name,
            $task_description,
            $task_id
        ]);

        break;
    }

    var_dump($operation);
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