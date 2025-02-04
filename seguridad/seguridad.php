<?php
session_start();
require_once "config.php";
require_once "conexion.php";

class seguridad {
    private $usuario;
    private $rol;
    private $conexion;

    public function __construct($conexion) {
        $db = new conexion();
        $this->conexion = $db->getConexion();
        $this->usuario = "";
        $this->rol = "";
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