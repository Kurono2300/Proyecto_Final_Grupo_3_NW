<?php

class Errorsito extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "Error al cargar la pagina o Pagina no Encontrada";
        $this->view->render('error/index');
        //echo "<p>Error al cargar el recurso</p>";
    }
}

?>