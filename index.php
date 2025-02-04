<?php
session_start();

require_once './seguridad/conexion.php';
require_once './seguridad/seguridad.php';
$segura = new Seguridad(new conexion);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de manhwas</title>
</head>
<body>
    <h1>Bienvenido a la Biblioteca de manhwas</h1>


</body>
</html>