<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taskion - a trello clone</title>
  <?php include('includes/styles.php') ?>
  <?php include_once('includes/config.php') ?>
</head>
<body>
  <?php include('includes/header.php') ?>
  <main class="content">  

    <section class="wrapper">
      <section class="container gap col">
        <h1 class="title">¡Bievenido a Taskion!</h1>
        <p class="paragraph">Tu solución de gestion de proyectos</p>
        <section class="container button-group">
          <a href="/iniciar-sesion" class="button">Iniciar sesión</a>
          <a href="/Taskion/registrarme" class="button">Registrarse</a>
        </section>
      </section>
      <section class="container">
        <img src="./assets/images/man-computer.png" width="400" height="300" alt="figure 1">
      </section>
    </section>

    <section class="wrapper">
      <section class="container">
        <img src="./assets/images/man-chair.png" width="400" height="300" alt="">
      </section>

      <section class="container gap col">
        <h2 class="subtitle">Característícas Destacadas</h2>
        <ul>
          <li>Fácil creación de proyectos y tareas</li>
          <li>Seguimiento en tiempo</li>
          <li>Colaboración en equipo</li>
        </ul>
      </section>
    </section>

  </main>
</body>
</html>