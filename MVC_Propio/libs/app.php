<?php

require_once 'controllers/error.php';


class App{

    function __construct(){
        //echo "<p>Nueva App</p>";

        $url = isset($_GET['url']) ? $_GET['url']: null;
        //is this condition true ? yes : no
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        //var_dump($url);


        //CUANDO SE INGRESA SIN DEFINIR CONTROLADOR
        if(empty($url[0])){
            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }


        $archivoController = 'controllers/'. $url[0].'.php';

        if(file_exists($archivoController)){
            require_once $archivoController;

            //INICIALIZAR CONTROLADOR
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            //echo "<br/>".$url[0];

            //Numero de elementos del arreglo
            $nparam = sizeof($url);

            if($nparam > 1){
                if($nparam > 2){
                    $param = [];
                    for($i = 2; $i<$nparam; $i++){
                        array_push($param, $url[$i]);
                        //var_dump($param);
                    }
                    $controller->{$url[1]}($param);
                }else{
                    $controller->{$url[1]}();
                }
            }
            else{
                $controller->render();
            }


            //SI HAY UN METODO QUE SE REQUIERE CARGAR
            // if(isset($url[1])){
            //     $controller->{$url[1]}();
            // }
            // else{
            //     $controller->render();
            // }

        }
        else{
            $controller = new Errorsito();
        }


    
    }
}

?>