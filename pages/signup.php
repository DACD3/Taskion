<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taskion - Registro</title>
  <?php include('../includes/styles.php') ?>
  <link rel="stylesheet" href="./assets/css/form.css">

</head>
<body>

  <form class="form" method="POST" action="./signup.php">  

    <img src="https://via.placeholder.com/64x64" width="64" height="64" alt="" class="">

    <section class="form-group">
      <label for="username">Nombre de usuario:</label>
      <input title="username" type="text" name="username" id="username">
    </section>
    
    <section class="form-group">
      <label for="email">Correo electronico</label>
      <input title="email" type="email" name="email" id="email">
    </section>
    
    <section class="form-group">
      <label for="password">Contraseña:</label>
      <input title="password" type="password" name="password" id="password">
    </section>

    <section class="form-group">
      <button class="button">
        Registrarse
      </button>
    </section>
  </form>

  <?php
    include('../includes/config.php');
    include('../includes/database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];

      $message = "";

      // Validación de nombre de usuario
      if (empty($username)) {
        $message = "El campo de nombre de usuario no puede estar vacío.";
      } elseif (!preg_match("/^[a-zA-Z0-9_]{5,20}$/", $username)) {
        $message = "El nombre de usuario debe contener solo letras, números y guiones bajos (_) y tener entre 5 y 20 caracteres.";
      }

      // Validación de correo electrónico
      if (empty($email)) {
        $message = "El campo de correo electrónico no puede estar vacío.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "El correo electrónico ingresado no es válido.";
      }

      if (empty($password)) {
        $message = "El campo de contraseña no puede estar vacío.";
      }

      if ($message !== "") {
        echo "<p class='error'>$message</p>";
      }

      // Hashear y saltear la contraseña
      $salt = bin2hex(random_bytes(16));

      $saltedPassword = $password . $salt;

      $hashedPassword = password_hash($saltedPassword, PASSWORD_BCRYPT);

      $result = executeQuery(false, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)", [$username, $email, $hashedPassword]);

      echo $result;
    }
  ?>


</body>
</html>