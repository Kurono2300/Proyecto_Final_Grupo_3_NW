<?php

namespace Controllers\Clases;

class About extends \Controllers\PublicController
{

    public function run() :void 
    {
        $viewdata = array(
            "cuenta" => "0501199907081",
            "nombre" => "Emilio Escoto",
            "correo"=> "emilioescoto@gmail.com"
        );

        \Views\Renderer::render("clases/about", $viewdata);
    }

    //index.php?page=clases_about     -  Para verlo
}

?>