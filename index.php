<?php
session_start();

require_once './seguridad/conexion.php';
require_once './seguridad/seguridad.php';
require_once './modelo/usuarioMode.php';
require_once './vista/view.php';
$usuarioController = new UsuarioController();
$segura = new Seguridad(new conexion);

if(isset($_POST['login'])){
    $usuario = $_POST['login'];
    $password = $_POST['password'];

    if($usuarioMode->login($login, $password)){
        $_GET['vista'] = './vista/viewPrueba.php';
    }
}

if(isset($_SESSION['logeado'])){
    switch($vista){
        case 'login':
            $usuarioController->manejarAcciones();

        default: 
        if(!isset($_SESSION['logeado'])){
            $datos = $segura->getRol();
            View::mostrar('viewPrueba', $datos);
        }
    }
}
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