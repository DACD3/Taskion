<?php

include_once('../models/User.php');
session_start();

if (empty($_SESSION)) {
  header('Location: /login', true);
  exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taskion - App</title>
  <?php include('../includes/styles.php') ?>
  <link rel="stylesheet" href="./assets/css/form.css">
  <link rel="stylesheet" href="./assets/css/app.css">
  <script defer src="./assets/js/initial.js"></script>
  <script defer src="./assets/js/app.js"></script>
</head>
<body>
  <?php include('../components/sidebar.php') ?>
  <?php require_once ('../includes/queries.php') ?>
  <main class="app content">
    <h1>¡Bienvenido <?php echo substr($user->getName(), 0, 7) ?>!</h1>
    
    <section class="tab-component">
      <section class="tab-container">
        <button id="project" class="tab-button active">Crear proyecto</button>
        <button id="task" class="tab-button">Crear tarea</button>
      </section>
      <section class="tab-content" id="tab-content">
        <form id="form-project" class="form visible" action="/app?operation=createProject" method="post">
          <section class="form-group">
            <label for="" class="label">Nombre del proyecto</label>
            <input class='input' type="text" name="Name" id="Name">
          </section>
          <section class="form-group">
            <button type="submit" class="button">
              Crear proyecto
            </button>
          </section>
        </form>

        <form id="form-task" action="/app?operation=createTask" method="post" class="form">

          <section class="form-group">
            <label for="" class="label">Proyecto</label>
            <?php
              echo '<select class="select" id="select" name="project">';
              
                echo "<option disabled selected>Selecciona un proyecto</option>";

              foreach ($_SESSION['projects'] as $project) {
                $project = new Project($project['id'], $project['Name']);

                $project_id = $project->getId();

                echo "<option class='option' value='$project_id'>{$project->getName()}</option>";
              }
                echo '</select>';
            ?>
          </section>

          <section class="form-group">
            <label for="Name" class="label">Nombre de la tarea</label>
            <input class="input" type="text" name="Name" id="Name">
          </section>
          
          <section class="form-group">
            <label for="" class="label">Descripción</label>
            <input class="input" type="text" name="Description" id="Description">
          </section>

          <section class="form-group">
            <button type="submit" class="button">Crear tarea</button>
          </section>

        </form>
        <?php require_once ('../includes/create.php') ?>
      </section>
    </section>

    <h2>Proyectos</h2>
    
    <section class="projects" id="projects">
      
    </section>

  </main>
</body>
</html>