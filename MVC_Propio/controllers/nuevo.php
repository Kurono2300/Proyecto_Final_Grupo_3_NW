
<?php

class Nuevo extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //$this->view->render('nuevo/index');
        //echo "<p>Nuevo Controlador Main</p>";
    }


    function render(){
        $this->view->render('nuevo/index');
    }


    function registrarAlumno(){
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        $mensaje = "";
        if($this->model->insert(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido])){
            $mensaje = "Nuevo Alumno Creado";
        }else{
            $mensaje = "Error al crear Alumno, la matricula ya existe";   
        }
        //$this->model->insert();
        $this->view->mensaje = $mensaje;
        $this->render();
    }
}


?>