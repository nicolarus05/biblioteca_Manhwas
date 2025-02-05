<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manhwas</title>
</head>
<body>
    <header>
        <h1>Bienvenido a la Biblioteca de Manhwas</h1>
        <nav>
            <ul>
                <?php
                    if(isset($_SESSION['rol'])){
                        if($_SESSION['rol'] == 'usuario'){
                            echo "<li><a href='?vista=viewPrueba'>Prueba1</a></li>";
                        }elseif($_SESSION['rol'] == 'administrador'){
                            echo "<li><a href='?vista=vistaUsuarios'>Listado de usuarios</a></li>";
                            echo "<li><a href='?vista=insertarUsuario'>Insertar usuario</a></li>";
                        }

                        echo "<li><a href='?vista=miPerfil'>Mi Perfil</a></li>"; 
                        echo "<li><a href='?vista=cerrarSesion'>Cerrar sesion</a></li>";
                        echo "</ul>";
                    }else{
                        echo "<h2><a href='?vista=viewLogin'>Iniciar Sesion</a></h2>";
                    }
                ?>
        </nav>
    </header>
</body>
</html>