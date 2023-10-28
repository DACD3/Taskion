<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taskion - Inicio de sesión</title>
  <?php include("../includes/styles.php") ?>
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/form.css">
</head>
<body>
  <?php include('../includes/header.php') ?>
  <main class="content center col">

    <h1 class="title">
      Ingresá
    </h1>

    <p>
      Inicia sesión para continuar a la aplicación
    </p>

    <form class="form" action="" method="post">
      <section class="form-group">
        <label for="" class="label">Email</label>
        <input class="input" type="text" name="" id="">
      </section>
      
      <section class="form-group">
        <label for="" class="label">Contraseña</label>
        <input class="input" type="password" name="" id="">
      </section>

      <section class="form-group">
        <button type="submit" class="button">Iniciar sesión</button>
      </section>

    </form>

  </main>
</body>
</html>