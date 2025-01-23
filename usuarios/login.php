<?php
require_once '../seguridad/conexion.php';


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
            <input type="text" id="username" required placeholder="nombre usuario"/>
            <br>

            <label for="password">Contraseña </label>
            <input type="password" id="password" required placeholder="contraseña usuario"/>
        </fieldset>

        <input type="submit" value="Enviar" id="enviar"/>   
    </form>
</body>
</html>