<?php
session_start();
require_once '../seguridad/conexion.php';
require_once '../seguridad/seguridad.php';

//crear una instancia de la conexion y de seguridad
$db = new conexion();
$conexion = $db->getConexion();
$segura = new seguridad($conexion);

//si el usuario no esta registrad, redirigirlo a que se registre
if (!isset($_SESSION['registrado'])) {
    header('Location: registro.php');
    exit();
}

if (isset($_POST['login'])) {

    //verifico que los datos no son nulos
    if (!empty($usuario) && !empty($password)) {
        //verificamos si el usuario existe
        if ($segura->login($usuario, $password)) {
            $_SESSION['logeado'] = true;
            header('Location: ../index.php');
            exit();
        } else {
            echo "El usuario o la contraseña son incorrectos.";
        }
    } else {
        echo "Por favor, rellene todos los campos.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <form action="post">
        <h1>Inicio de Sesión</h1>
        <fieldset>
            <legend>Inicio de Sesión</legend>

            <label for="login">Nombre de usuario</label>
            <input type="text" id="username" name="usuario" required placeholder="nombre usuario">

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="contraseña usuario">
        </fieldset>

        <input type="submit" value="Enviar" name="login">
    </form>
</body>
</html>

