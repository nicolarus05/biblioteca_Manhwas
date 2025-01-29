<?php
// Controller: LoginController.php
session_start();
require_once '../seguridad/seguridad.php';

class LoginController {
    private $seguridad;

    public function __construct($seguridad) {
        $this->seguridad = $seguridad;
    }

    public function login() {

        // Si el usuario ya está logeado, redirigirlo al índice
        if (isset($_SESSION['logeado'])) {
            header('Location: ../index.php');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitizar entradas
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if ($usuario && $password) {
                if ($this->seguridad->login($usuario, $password)) {
                    $_SESSION['logeado'] = true;
                    header('Location: ../index.php');
                } else {
                    $mensaje = "El usuario o la contraseña son incorrectos.";
                }
            } else {
                $mensaje = "Por favor, rellene todos los campos.";
            }
        }

        // Incluir la vista con el mensaje de error (si existe)
        include_once '../vista/login.php';
    }
}
