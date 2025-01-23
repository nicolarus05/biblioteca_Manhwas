<?php
require_once 'config.php';

class conexion{
    //atributo de la clase conexion
    protected static $conexion;

    //constructor de la clase conexion
    public function __construct(){
        self::getConexion();
    }

    //metodo para generar la conexion a la base de datos
    public static function getConexion(){
        if(!isset(self::$conexion)){
            try{
                self::$conexion = new PDO("mysql:host=".HOST.";port=".PUERTO.";dbname=".BASEDATOS, USUARIO, PASSWORD);
            }catch(PDOException $e){
                echo "Conexion con base de datos fallida" . $e->getMessage();
            }
        }
        return self::$conexion;
    }
    
    public function __destruct(){
        self::$conexion = null;
    }

    public static function lastError(){
        return self::$conexion->errorInfo();
    }
}