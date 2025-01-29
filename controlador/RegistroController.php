<?php
// Controller: RegistroController.php
require_once '../controlador/RegistroController.php';

class RegistroController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function registro() {
        session_start();

        // Redirigir si ya está registrado
        if (isset($_SESSION['registrado'])) {
            header('Location: login.php');
        }

        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
            $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
            $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
            $login = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if ($nombre && $apellidos && $edad && $correo && $login && $password) {
                $error = $this->model->registrarUsuario($nombre, $apellidos, $edad, $correo, $login, $password);
                if ($error) {
                    $mensaje = $error;
                }
            } else {
                $mensaje = "Por favor, rellene todos los campos correctamente.";
            }
        }

        include '../vista/registro.php';
    }
}
