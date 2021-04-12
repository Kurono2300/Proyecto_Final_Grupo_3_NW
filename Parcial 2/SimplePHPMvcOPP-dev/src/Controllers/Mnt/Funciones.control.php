<?php 
namespace Controllers\Mnt;

class Funciones extends \Controllers\PublicController
{
    public function run() :void
    {
        $dataview = array();
        $dataview["items"] = \Dao\Mnt\Funciones::getAll();
        \Views\Renderer::render("mnt/funciones", $dataview);
    }
}

// index.php?page=mnt_funciones