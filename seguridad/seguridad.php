<?php
session_start();
require_once "config.php";
require_once "conexion.php";

class seguridad {
    private $session;
    private $usuario;
    private $conexion;
    private $rol;

    public function __construct($conexion) {
        $db = new conexion();
        $this->conexion = $db->getConexion();
        $this->session = false;
        $this->usuario = "";
        $this->rol = "";

        //comprobamos si hay una sesión activa
        if (isset($_SESSION['logeado'])) {
            $this->session = true;
            $this->usuario = $_SESSION['usuario'];
            $this->rol = $_SESSION['rol'];
        }
    }

    public function login($login, $password) {
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
    
                // Guardamos estado en las propiedades de la clase (si las necesitas)
                $this->session = true;
                $this->usuario = $usuario['login'];
                $this->rol = $usuario['rol'];
                echo "FUnciona";
                return true; // Login exitoso
            }
        }
    
        return false; // Credenciales incorrectas
    }
    

    public function logout() {
        $this->session = false;
        $this->usuario = "";
        session_unset();
        session_destroy();
    }

    public function isLogged() {
        return $this->session;
    }

    public function getusuario() {
        return $this->usuario;
    }

    public function getRol() {
        return $this->rol;
    }

    public static function secureRol($rol) {

        if (!in_array($_SESSION['rol'], $rol)) {
            return false;
        }else{
            return true;
        }
    }
}
?>