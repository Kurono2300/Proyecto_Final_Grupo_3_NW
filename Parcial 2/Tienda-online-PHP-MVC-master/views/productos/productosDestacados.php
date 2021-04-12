<H3 class="w-100 border-bottom pb-3">¡Te recomendamos estos productos!</H3>
<?php while ($produc = $producto->fetch_object()) : ?>
    <a href="<?= base_url ?>Productos/ver&id=<?= $produc->id ?>" class="hover pt-2 decoration">
        <div class="card col-4 p-3 bg-light border-light" >
            <?php if ($produc->imagen != NULL): ?>
                <img class="" height="150" src="<?= base_url ?>uploads/images/<?= $produc->imagen ?>" class="card-img-top w-50 p-3 mx-auto" alt="">
            <?php else: ?>
                <img class="" height="150" src="<?= base_url ?>assets/img/camiseta.png" />
            <?php endif; ?>
            <div class="card-body text-decoration-none">
                <h4 class="card-title  mb-0 text-success"><?= $produc->nombre ?></h4>
                <p class="card-text mb-0 text-dark"><?= $produc->precio ?> $</p>
                <p class="card-text  text-dark font-weight-bold"> <?= $produc->stock ?> Unidades disponibles</p>
                <?php $descripcion = $produc->descripcion ?>
                <p class="card-text  text-dark"><?= substr($descripcion, 0, 30) ?>...</p>
                <a class="card-text" href="<?=base_url?>Productos/ver&id=<?=$produc->id?>">...ver mas informacion</a>
            </div>
            <a href="<?=base_url?>Carrito/add&id=<?=$produc->id?>" class="btn btn-success">Agregar a carrito</a>
        </div>
    </a>
<?php endwhile; ?>