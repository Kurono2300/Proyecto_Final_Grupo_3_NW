<?php 
namespace Controllers\Mnt;

class Usuarios extends \Controllers\PublicController
{
    public function run() :void
    {
        $dataview = array();
        $dataview["items"] = \Dao\Mnt\Usuarios::getAll();
        \Views\Renderer::render("mnt/usuarios", $dataview);
    }
}

// index.php?page=mnt_usuarios