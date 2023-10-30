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
  <link rel="stylesheet" href="./assets/css/app.css">
  <script defer src="./assets/js/initial.js"></script>
  <script defer src="./assets/js/app.js"></script>
</head>
<body>
  <?php include('../components/sidebar.php') ?>
  <main class="app content">
    <h1>¡Bienvenido <?php echo substr($user->getName(), 0, 7) ?>!</h1>
    
    <section class="create">
      <a class="button-link" href="/project">Crear proyecto</a>
      <a class="button-link" href="/task">Crear tarea</a>
    </section>

    <section class="projects">
      <h2>Proyectos</h2>
    </section>

    <section class="tasks">
      <h2>Tareas</h2>
    </section>

  </main>
</body>
</html>