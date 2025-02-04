<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
    <form action="" method="POST">
        <h1>Formulario de Registro</h1>

        <?php if (!empty($mensaje)) : ?>
            <p style="color: red;"><?= $mensaje ?></p>
        <?php endif; ?>

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
