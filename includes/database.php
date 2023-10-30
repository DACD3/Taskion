<?php

  $servername = "localhost"; // Servidor de la base de datos
  $username = "root"; // Nombre de usuario de la base de datos
  $password = getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : ''; // Contraseña de la base de datos
  $database = "taskion"; // Nombre de la base de datos
  
  $dsn = "mysql:host=$servername;dbname=$database;charset=utf8mb4";

  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  ];

  $conn = new PDO($dsn, $username, $password, $options);


  function executeQuery($isSelect, $query, $values = array()) {
    
    global $conn;

    try {
      $stmt = $conn->prepare($query);

      $stmt->execute($values);

      if ($isSelect) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      return $stmt->rowCount();
    }
    catch (PDOException $e) {
      echo "Error: ". $e->getMessage() ."";
      return false;
    }
  }

?>