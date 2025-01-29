<?php
session_start();
require_once '../seguridad/conexion.php';

//crear una instancia de la conexion
$db = new conexion();
$conexion = $db->getConexion();

//si el usuario ya está logeado, redirigirlo al login
if (isset($_SESSION['registrado'])) {
    header('Location: login.php');
}

//funcion para registrar al usuario
function registro($conexion, $nombre, $apellidos, $edad, $correo, $login, $password) {
    $salt=random_int(10000000,99999999);
    $password = password_hash($password.$salt,PASSWORD_DEFAULT);

    try {
        $stmt = $conexion->prepare("INSERT INTO usuario (nombre, apellidos, edad, correo, login, password, salt, rol) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'usuario')");
        $stmt->execute([$nombre, $apellidos, $edad, $correo, $login, $password, $salt]);

        //si el usuario se ha creado con exito, redirigirlo para que incie sesion
        $_SESSION['registrado'] = true;
        header('Location: ../vista/login.php'); //redirigir al login
        exit();
    } catch (Exception $e) {
        echo "Error al registrar usuario: " . $e->getMessage();
    }
}

//comprobamos que el formulario de registro ha sido enviado.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
    $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
    $login = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($nombre && $apellidos && $edad && $correo && $login && $password) {
        registro($conexion, $nombre, $apellidos, $edad, $correo, $login, $password);
    } else {
        echo "Por favor, rellene todos los campos correctamente.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
    <form action="" method="POST">
        <h1>Formulario de Registro</h1>
        <fieldset>
            <legend>Datos Personales</legend>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre" required>

            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Introduzca sus apellidos" required>

            <label for="edad">Edad</label>
            <input type="number" id="edad" name="edad" placeholder="Introduzca su edad" required>

            <label for="correo">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" placeholder="Introduzca un email" required>
        </fieldset>

        <fieldset>
            <legend>Datos de Usuario</legend>

            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" placeholder="Introduzca su nombre de usuario" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Introduzca su contraseña" required>
        </fieldset>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>