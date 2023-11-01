<?php

  include 'config.php';

  require_once('../models/User.php');
  require_once('../models/Project.php');
  require_once('../models/Task.php');

  $user = $_SESSION['user'];

  $sql = "SELECT p.* FROM projects p JOIN users_has_projects up ON p.id = up.project_id WHERE up.user_id = ?";

  $result = executeQuery(true, $sql, [
    $user->getId(),
  ]);

  foreach($result as $project) 
  {
    $project = new Project($project['id'], $project['Name']);

    $project_id = $project->getId();

    echo "<article class='project' id=$project_id>";
      echo "<h4>{$project->getName()}</h4>";
    echo "</article>";
  }