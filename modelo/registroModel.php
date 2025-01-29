<?php
// Model: RegistroModel.php
class RegistroModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($nombre, $apellidos, $edad, $correo, $login, $password) {
        $salt = random_int(10000000, 99999999);
        $password = password_hash($password . $salt, PASSWORD_DEFAULT);

        try {
            $stmt = $this->conexion->prepare("INSERT INTO usuario (nombre, apellidos, edad, correo, login, password, salt, rol) 
                                              VALUES (?, ?, ?, ?, ?, ?, ?, 'usuario')");
            $stmt->execute([$nombre, $apellidos, $edad, $correo, $login, $password, $salt]);

            $_SESSION['registrado'] = true;
            header('Location: ../vista/login.php'); 
            exit();
        } catch (Exception $e) {
            return "Error al registrar usuario: " . $e->getMessage();
        }
    }
}
