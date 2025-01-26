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

if(isset($_POST['login'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if($segura->login($usuario, $password)){
        $_SESSION['logeado'] = true;
        header('Location: perfil.php');
    }else{
        echo "El usuario no existe";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
</head>
<body>
    <h1>Inicio de Sesion</h1>

    <form action="post">
        <fieldset>
            <legend>Inicio de Sesion</legend>

            <label for="login">Nombre de usuario </label>
            <input type="text" id="username" name="usuario" required placeholder="nombre usuario"/>
            <br>

            <label for="password">Contraseña </label>
            <input type="password" id="password" name="password" required placeholder="contraseña usuario"/>
        </fieldset>

        <input type="submit" value="Enviar" name="login"/>   
    </form>
</body>
</html>