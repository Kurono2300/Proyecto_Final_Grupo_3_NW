
<?php

class Consulta extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->alumnos = [];
        //$this->view->render('consulta/index');
        //echo "<p>Nuevo Controlador Main</p>";
    }

    function render(){
        $alumnos = $this->model->get();
        $this->view->alumnos = $alumnos;
        
        $this->view->render('consulta/index');
    }
    
    function verAlumno($param = null){
        //var_dump($param);
        $idAlumno = $param[0];
        $alumno = $this->model->getById($idAlumno);

        session_start();
        $_SESSION['id_verAlumno'] = $alumno->matricula;

        $this->view->mensaje = "";
        $this->view->alumno = $alumno;
        $this->view->render('consulta/detalle');

    }

    function actualizarAlumno(){
        session_start();
        $matricula = $_SESSION['id_verAlumno'];

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        unset($_SESSION['id_verAlumno']);

        if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido] )){
            //ACTUALIZAR ALUMNO EXITO
            $alumno = new Alumno();
            $alumno->matricula = $matricula;
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;

            $this->view->alumno = $alumno;
            $this->view->mensaje = "Alumno Actualizado correctamente";
        }
        else{
            //MENSAJE ERROR
            $this->view->mensaje = "No se pudo actualizar";
        }

        //$this->view->render('consulta/detalle');
        $this->render();
    }

    function eliminarAlumno($param = null){
        $matricula = $param[0];

        if($this->model->delete($matricula)){
            $this->view->mensaje = "Alumno eliminado correctamente";
        }
        else{
            //MENSAJE ERROR
            $this->view->mensaje = "No se pudo eliminar";
        }

        $this->render();
    }

}


?>