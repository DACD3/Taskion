<?php
  $servername = "localhost"; // Servidor de la base de datos
  $username = "root"; // Nombre de usuario de la base de datos
  $password = getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : ''; // Contraseña de la base de datos
  $database = "taskion"; // Nombre de la base de datos

  // Crear una nueva conexión a la base de datos e incluir la base de datos "taskion" en la conexión
  $conn = new mysqli($servername, $username, $password, $database);

  // Verificar la conexión y manejar errores en caso de falla
  if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
  }

  // Función para ejecutar consultas SQL
  function executeQuery($IsSelectOperation, $sql)
  {
    global $conn;

    // Ejecutar la consulta SQL
    $result = $conn->query($sql);

    // Si la consulta es SELECT y la ejecución tiene éxito, devolver los resultados en un arreglo asociativo
    if ($result && $IsSelectOperation) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Si la consulta es de otro tipo (INSERT, UPDATE, DELETE) y la ejecución tiene éxito, devolver true
    return $conn->query($sql) === TRUE;
  }
?>