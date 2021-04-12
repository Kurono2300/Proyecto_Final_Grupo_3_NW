<?php 
namespace Controllers\Mnt;

class Clientes extends \Controllers\PublicController
{
    public function run() :void
    {
        $dataview = array();
        $dataview["items"] = \Dao\Mnt\Clientes::getAll();
        \Views\Renderer::render("mnt/clientes", $dataview);
    }
}

// index.php?page=mnt_clientes