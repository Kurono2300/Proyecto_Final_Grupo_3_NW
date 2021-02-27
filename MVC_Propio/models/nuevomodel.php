<?php

class NuevoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try {
            $query = $this->db->connect()->prepare('INSERT INTO alumnos (matricula, nombre, apellido) VALUES (:matricula, :nombre, :apellido)');
            $query->execute(['matricula' => $datos['matricula'], 'nombre' => $datos['nombre'], 'apellido' => $datos['apellido']]);
            //echo "Datos Ingresados Correctamente";
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //echo "Ya existe la matricula ingresada";
            return false;
        }


        
    }

}

?>