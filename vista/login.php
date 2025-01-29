<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <form action="../controlador/loginController.php" method="post">
        <h1>Inicio de Sesión</h1>
        <fieldset>
            <legend>Inicio de Sesión</legend>

            <label for="login">Nombre de usuario</label>
            <input type="text" id="username" name="usuario" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </fieldset>

        <?php if (isset($mensaje)): ?>
            <p style="color: red;"><?= $mensaje; ?></p>
        <?php endif; ?>

        <input type="submit" value="Enviar" name="login">
    </form>
</body>
</html>
