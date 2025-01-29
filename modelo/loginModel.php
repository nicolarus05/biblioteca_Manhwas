<?php
// Model: LoginModel.php
/* class LoginModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function login($usuario, $password) {
        try {
            $stmt = $this->conexion->prepare("SELECT password, salt FROM usuario WHERE login = :usuario");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();

                // Combinar la contraseña con el salt y verificarla
                $hashPassword = $row['password'];
                $salt = $row['salt'];
                if (password_verify($password . $salt, $hashPassword)) {
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            echo "Error al iniciar sesión: " . $e->getMessage();
            return false;
        }
    }
} */
