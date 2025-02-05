<?php
require_once '../modelo/usuarioMode.php';

class UsuarioController {
    
    private $usuarioModel;
    
    public function __construct() {

    }
    //metodo para manejar otras acciones (si es necesario)
    public static function manejarAcciones() {
        //verificamos qué acción se está solicitando y llamamos al método adecuado
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'registrar':
                    if (isset($_SESSION['registrado'])) {
                        header('Location: ../vista/viewLogin.php');
                    }else{
                    Usuario::registro($_POST['nombre'], $_POST['apellidos'], $_POST['edad'], $_POST['correo'], $_POST['login'], $_POST['password']);
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
}