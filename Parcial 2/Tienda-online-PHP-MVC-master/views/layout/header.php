<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Mamazon: Textiles Online</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= base_url ?>assets/css/style2.css">
    </head>
    <body style="background: #031417">
        <div class="container mt-4">
            <header>
                <div class="bg-light p-3">
                    <a href="<?=base_url?>"><img src="<?= base_url ?>assets/img/logosmashito.png" alt="" width="120"></a>
                    <a href="<?=base_url?>" class="title ml-4 mt-1" style="color: black; text-shadow: 2px 2px #05bbdb;">Tienda de Textiles Mamazon</a>
                </div>
                <nav class="navbar navbar-expand-sm bg-light navbar-light border-top">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-start mr-4" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url ?>">Inicio </a>
                            </li> 
                            <?php $categoriaMenu = Utils::showCategorias();?>
                            
                            <?php while ($cate = $categoriaMenu->fetch_object()): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url ?>Categorias/ver&id=<?= $cate->id ?>"><?= $cate->nombre ?></a>
                                </li>
                            <?php endwhile; ?>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="<?= base_url ?>usuarios/registrar">Sobre Nosotros </a>
                                Esta idea quedo sin desarrollarse por falta de tiempo e ideas.
                            </li>  -->
                        </ul>
                    </div>
                </nav>
            </header>
