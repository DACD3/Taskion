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
// Función para ejecutar consultas SQL con parámetros
  function executeQuery($IsSelectOperation, $sql, $values = array())
  {
    global $conn;

    // Preparar la consulta SQL
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
      // Unir los valores a la consulta preparada
      if (!empty($values)) {
        $types = str_repeat('s', count($values)); // Suponemos que todos los valores son cadenas (strings)
        $stmt->bind_param($types, ...$values);
      }

      // Ejecutar la consulta preparada
      $stmt->execute();

      // Si la consulta es SELECT y la ejecución tiene éxito, devolver los resultados en un arreglo asociativo
      if ($IsSelectOperation) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
      }

      // Si la consulta es de otro tipo (INSERT, UPDATE, DELETE) y la ejecución tiene éxito, devolver true
      return $stmt->affected_rows > 0;
    } else {
      // Si hubo un error en la preparación de la consulta, puedes manejarlo aquí
      return false;
    }
  }
?>