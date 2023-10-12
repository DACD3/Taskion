<?php
// Obtiene la ubicación del archivo config.php
$rootDir = __DIR__;
// Remueve la carpeta "includes" de la ruta
$taskionDir = realpath(dirname($rootDir));
$envFilePath = $taskionDir . '/.env';

if (file_exists($envFilePath)) {
  $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  if ($lines !== false) {
    foreach ($lines as $line) {
      // Divide cada línea en nombre y valor de la variable
      list($name, $value) = explode('=', $line, 2);

      // Establece las variables de entorno
      putenv("$name=$value");
    }
  }
} else {
  die("El archivo .env no se encontró en la ruta especificada.");
}
?>
