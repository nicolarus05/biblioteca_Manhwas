<?php
require_once 'modelo.php';
require_once '../seguridad/seguridad.php';

class Usuario extends Modelo {
    // Constructor de la clase
    public function __construct() {
        parent::__construct('usuario');
    }

    //metodo para añadir usuarios
    public function crear($nombre, $apellidos, $edad, $correo, $login, $password, $rol = 'usuario') {
        $salt = random_int(10000000, 99999999);
        $passwordHash = password_hash($password . $salt, PASSWORD_DEFAULT);

        try {
            $stmt = $this->conexion->prepare("INSERT INTO usuario (nombre, apellidos, edad, correo, login, password, salt, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
            return $stmt->execute([$nombre, $apellidos, $edad, $correo, $login, $passwordHash, $salt, $rol]);
        } catch (PDOException $e) {
            error_log("Error al añadir un usuario: " . $e->getMessage());
        }
    }

    //metodo para modificar usuarios
    public function actualizar($nombre, $apellidos, $edad, $correo, $rol, $login) {
        try {
            $stmt = $this->conexion->prepare("UPDATE usuario SET nombre = ?, apellidos = ?, edad = ?, correo = ?, rol = ? WHERE login = ?;");
            return $stmt->execute([$nombre, $apellidos, $edad, $correo, $rol, $login]);
        } catch (PDOException $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
        }
    }

    //metodo para actualizar el perfil del usuario
    public function actualizarPerfil($nombre, $apellidos, $edad, $correo, $login) {
        return $this->actualizar($nombre, $apellidos, $edad, $correo, 'usuario', $login);
    }

    //metodo para cambiar la contraseña del usuario
    public function cambiarPassword($login, $nueva) {
        $salt = random_int(10000000, 99999999);
        $passwordHash = password_hash($nueva . $salt, PASSWORD_DEFAULT);

        try {
            $stmt = $this->conexion->prepare("UPDATE usuario SET password = ?, salt = ? WHERE login = ?;");
            return $stmt->execute([$passwordHash, $salt, $login]);
        } catch (PDOException $e) {
            error_log("Error al actualizar la contraseña: " . $e->getMessage());
        }
    }

    //metodo para registrar un usuario
    public function registro($nombre, $apellidos, $edad, $correo, $login, $password) {
        if ($this->crear($nombre, $apellidos, $edad, $correo, $login, $password)) {
            $_SESSION['registrado'] = true;
            header('Location: ../vista/login.php');
        } else {
            echo "Error al registrar usuario.";
        }
    }

    //metodo para loguear a los usuarios
    public function login($usuario, $password) {
        $segura = new Seguridad($this->conexion);
        
        if ($segura->login($usuario, $password)) {
            $_SESSION['logeado'] = true;
            header('Location: ../index.php');
        } else {
            echo "El usuario o la contraseña son incorrectos.";
        }
    }
}