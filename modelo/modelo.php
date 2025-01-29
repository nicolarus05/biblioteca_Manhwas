<?php
class modelo{
    //nombre de la tabla a la que se accede
    protected $tabla;

    //capa de abstraccion de datos
    protected $conexion;

    //contructor de la clase
    public function __construct($nombreTabla){
        $this->tabla = $nombreTabla;

        try{
            $this->conexion = Conexion::getConexion();
        }catch(PDOException $e){
            echo "Conexion fallida" . $e->getMessage();
        }
    }

    //me creo una funcion para obetener todos los datos de una tabla
    public function listar(){
        $query = $this->conexion->query('SELECT * FROM ' . $this->tabla);
        $lista = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $lista;
    }

    //me creo una funcion para obtener algun valor en concreto de una tabla
    public function get($columna, $valor){
        $query = 'SELECT * FROM ' . $this->tabla . 'WHERE ' . $columna . ' = :valor';
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //me creo un metodo para eliminar algo de alguna tabla
    public function eliminar($columna, $valor){
        try {
            $query = 'DELETE FROM ' . $this->tabla . ' WHERE ' . $columna . ' = :valor';
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':valor', $valor);
            $stmt->execute();
    
            //verificamos si se ha eliminado
            if ($stmt->rowCount() > 0) {
                echo "Recurso eliminado correctamente.";
            } else {
                echo "No se encontró el recurso para eliminar.";
            }
        } catch (PDOException $e) {
            echo "Error al recurso usuario: " . $e->getMessage();
        }

    }
}