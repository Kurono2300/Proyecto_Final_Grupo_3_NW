<?php 
namespace Controllers\Mnt;

class Productos extends \Controllers\PublicController
{
    public function run() :void
    {
        $dataview = array();
        $dataview["items"] = \Dao\Mnt\Productos::getAll();
        \Views\Renderer::render("mnt/productos", $dataview);
    }
}

// index.php?page=mnt_productos