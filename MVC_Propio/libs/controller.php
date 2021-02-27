<?php

class Controller{

    function __construct(){
        //echo "<p>Controlador Base</p>";
        $this->view = new View();
    }

    function loadmodel($model){
        $url= 'models/'.$model.'model.php';

        if(file_exists($url)){
            require $url;
            //echo $url."<br/>";
            $modelName = $model.'Model';
            //echo $modelName;
            $this->model = new $modelName();
        }
    }

}

?>