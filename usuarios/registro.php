<?php
require_once '../seguridad/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<h1>Formulario de registro de los usuarios</h1>

<form action="post">
    <fieldset>
        <legend>Datos Personales</legend>

        <label for="Nombre">Nombre </label>
        <input type="text" id="nombre" placeholder="Introduzca su nombre" required/>
        <br>

        <label for="Apellidos">Apellidos </label>
        <input type="text" id="apellidos" placeholder="Introduzca sus apellidos" required/>
        <br>

        <label for="edad">Edad </label>
        <input type="number" id="edad" placeholder="Introduzca su edad" required/>
        <br>

        <label for="email">Correo Electronico </label>
        <input type="email" id="email" placeholder="Introduzca un email" required/>
    </fieldset>

    <fieldset>
        <legend>Datos usuario</legend>

        <label for="login">Nombre de usuario </label>
        <input type="text" id="username" required/>
        <br>

        <label for="password">Contraseña </label>
        <input type="password" id="password" required/>
        <br>
    </fieldset>

    <input type="submit" value="Enviar" id="enviar"/>
</form>
</body>
</html>