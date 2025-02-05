<?php
require_once 'modelo.php';

class Usuario extends Modelo {
    //atributos privados de la clase
    private $session;
    private $usuario;
    private $rol;
    // Constructor de la clase
    public function __construct() {
        parent::__construct('usuario');
        $this->session = false;
        $this->usuario = "";
        $this->rol = "";
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
    public function login($login, $password) {
        $segura = new Seguridad($this->conexion);
        
        // Sanitizamos el campo de entrada
        $login = filter_var($login, FILTER_SANITIZE_STRING);
    
        // Consulta segura con parámetros preparados
        $sql = "select * FROM usuario WHERE login = :login";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
    
        // Obtenemos el usuario (si existe)
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario) {
            // Verificamos la contraseña concatenando el salt y utilizando password_verify
            if (password_verify($password . $usuario['salt'], $usuario['password'])) {
                // Configuramos variables de sesión
                $_SESSION['usuario'] = $usuario['login'];
                $_SESSION['rol'] = $usuario['rol'];
    
                // Guardamos estado en las propiedades de la clase
                $this->session = true;
                $this->usuario = $usuario['login'];
                $this->rol = $usuario['rol'];
                return true; // Login exitoso
            }
        }
    
        return false; // Credenciales incorrectas
    }

    //metodo para cerrar sesion
    public function logout() {
        $this->session = false;
        $this->usuario = "";
        session_unset();
        session_destroy();
    }
}