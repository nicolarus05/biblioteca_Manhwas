<?php
// Configuración de la base de datos
$host = '172.21.0.2'; // Cambiar si usas un servidor remoto
$user = 'manhwas'; // Usuario de MySQL
$password = '261205'; // Contraseña de MySQL
$dbname = 'ManhwasDB'; // Nombre de la base de datos

try {
    // Crear una nueva conexión PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);

    // Configurar el modo de errores de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // Capturar errores de conexión
    echo("Error de conexión: " . $e->getMessage());
}
?>
