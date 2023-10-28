<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taskion - Registro</title>
  <?php include("../includes/styles.php") ?>
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/form.css">
  <script defer src="./assets/js/initial.js"></script></script>
  <script defer src="./assets/js/register.js"></script></script>
</head>
<body>
  <?php include('../includes/header.php') ?>
  <main class="content center col">

    <h1 class="title">
      Creá una cuenta nueva
    </h1>

    <p>
      ¿Ya estas registrado?
      <a href="/login">Inicia sesión</a>
    </p>

    <form action="/register" method="post" class="form" enctype="multipart/form-data">
      <section class="form-group">
        <label for="" class="label">Nombre</label>
        <input class="input" type="text" name="Name" id="Name">
      </section>

      <section class="form-group">
        <label for="" class="label">Nombre de usuario</label>
        <input class="input" type="text" name="Username" id="Username" required>
      </section>

      <section class="form-group">
        <label for="" class="label">Email</label>
        <input class="input" type="email" name="Email" id="Email" required>
      </section>

      <section class="form-group">
        <label for="" class="label">Contraseña</label>
        <input type="password" name="Password" id="Password" class="input">
      </section>

      <section class="form-group">
        <label for="" class="label">Avatar</label>
        <input type="file" accept="image/*" name="Avatar" id="Avatar">

        <section id="image-container">
          <img class="avatar" w id="Avatar-image" src="" alt="">
        </section>

      </section>

      <section class="form-group">
        <button type="submit" class="button">
          Registarme
        </button>
      </section>
    </form>
  </main>

  <?php include_once('../includes/registration.php') ?>
</body>
</html>