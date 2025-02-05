<?php
require_once '../modelo/usuarioMode.php';

class UsuarioController {
    
    private $usuarioModel;
    
    public function __construct() {
        //instanciamos el modelo Usuario
        $this->usuarioModel = new Usuario();
    }
    //metodo para manejar otras acciones (si es necesario)
    public function manejarAcciones() {
        //verificamos qué acción se está solicitando y llamamos al método adecuado
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'registrar':
                    if (isset($_SESSION['registrado'])) {
                        header('Location: ../vista/viewLogin.php');
                    }else{
                        $this->usuarioModel->registro($_POST['nombre'], $_POST['apellidos'], $_POST['edad'], $_POST['correo'], $_POST['login'], $_POST['password']);
                    }
                    break;
                case 'login':
                    if (!isset($_SESSION['registrado'])) {
                        header('Location: ../vista/viewRegistro.php');
                    }else{
                        if(isset($_POST['login'])){
                            //verifico que los datos no son nulos
                            if (!is_null($_POST['usuario']) || !is_null($_POST['password'])) {
                                //verificamos si el usuario existe
                                if ($this->usuarioModel->login($_POST['usuario'], $_POST['password'])) {
                                    $_SESSION['logeado'] = true;
                                    header('Location: ../index.php');
                                } else {
                                    echo "El usuario o la contraseña son incorrectos.";
                                }
                            } else {
                                echo "Por favor, rellene todos los campos.";
                            }
                        }
                    }
                    break;
                case 'actualizarPerfil':
                    
                    break;
                case 'cambiarPassword':
                    
                    break;
                default:
                    echo "Acción no encontrada.";
            }
        }
    }

    /* 
    //metodo para registrar un nuevo usuario
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'], $_POST['apellidos'], $_POST['edad'], $_POST['correo'], $_POST['login'], $_POST['password'])) {
            //recogemos los datos del formulario
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $edad = $_POST['edad'];
            $correo = $_POST['correo'];
            $login = $_POST['login'];
            $password = $_POST['password'];

            //llamamos al metodo de registro del modelo
            $this->usuarioModel->registro($nombre, $apellidos, $edad, $correo, $login, $password);
        } else {
            echo "Faltan datos para el registro.";
        }
    }

    //metodo para loguear al usuario
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'], $_POST['password'])) {
            //recogemos los datos del formulario
            $usuario = $_POST['login'];
            $password = $_POST['password'];

            //llamamos al metodo de login del modelo
            $this->usuarioModel->login($usuario, $password);
        } else {
            echo "Faltan datos para el login.";
        }
    }

    //metodo para actualizar los datos del perfil del usuario
    public function actualizarPerfil() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'], $_POST['apellidos'], $_POST['edad'], $_POST['correo'], $_POST['login'])) {
            //recogemos los datos del formulario
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $edad = $_POST['edad'];
            $correo = $_POST['correo'];
            $login = $_POST['login'];

            //llamamos almetodo de actualizar perfil del modelo
            $this->usuarioModel->actualizarPerfil($nombre, $apellidos, $edad, $correo, $login);
        } else {
            echo "Faltan datos para actualizar el perfil.";
        }
    }

    //metodo para cambiar la contraseña
    public function cambiarPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'], $_POST['nueva_password'])) {
            //recogemos los datos del formulario
            $login = $_POST['login'];
            $nueva_password = $_POST['nueva_password'];

            //llamamos al método de cambiar contraseña del modelo
            $this->usuarioModel->cambiarPassword($login, $nueva_password);
        } else {
            echo "Faltan datos para cambiar la contraseña.";
        }
    }
 */
}