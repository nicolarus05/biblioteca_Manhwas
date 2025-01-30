<?php
require_once 'modelo.php';
class Usuario extends Modelo{
    //los atributos de esta clase seran heredados de modelo.

    //constructor de la clase
    public function __construct($nombreTabla){
        parent::__construct($nombreTabla);
    }

    //me creo una funcion para añadir usuarios
    public function crear($nombre, $apellidos, $edad, $correo, $login, $password, $rol = 'usuario'){
        $salt=random_int(10000000,99999999);
        $password = password_hash($password.$salt,PASSWORD_DEFAULT);

        try{
            $stmt = $this->conexion->prepare("INSERT INTO usuario(nombre, apellidos, edad, correo, login, password, salt, rol) VALUES (?, ?, ?, ? ,?, ?, ?, ?);");
            $stmt->execute([$nombre, $apellidos, $edad, $correo, $login, $password, $salt, $rol]);
        }catch(PDOException $e){
            echo "Error al añadir un usuario: " . $e->getMessage();
        }
    }

    //me creo una funcion para modificar usuarios
    public function actualizar($nombre, $apellidos, $edad, $correo, $rol){
        $query = "UPDATE `usuario` SET `nombre` = ?, `apellidos` = ?, `edad` = ?, `correo` = ?,`rol` = ? WHERE `login` = ?;";
        $stmt = $this->conexion->prepare($query);

        try{
            $stmt->execute([$nombre, $apellidos, $edad, $correo, $rol]);
        }catch(PDOException $e){
            echo "Error al actualizar al usuario: " . $e->getMessage();
        }
    }

    //me creo una funcion para actualizar mi perfil de usuario.
    public function actualizarPerfil(){

    }

    //me creo una funcion para poder cambiar la contraseña del usuario.
    public function cambiarPassword(){

    }
}