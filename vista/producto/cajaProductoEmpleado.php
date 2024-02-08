<!--Inicio Contenedor Producto Específico-->
<div class="item">
    <figure>
        <img src="img/<?= $imagenURL ?>" alt="<?php $nombre ?>" />
    </figure>
    <div class="info-product">
        <h2><?= $nombre ?></h2>
        <p class="price"><?= $precio ?></p>
        <b><?php $categoria ?></b>
        <p>Unidades Restantes: <?= $stock ?></p>
    </div>
    <div>
        <form action="../controlador/pedido/controladorStock.php" method="get">
            <input type="number" name="cant" id="cant" placeholder="Nuevo Stock"> <br />
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" name="Actualizar" value="Actualizar">
        </form>
    </div>
    <!--Fin Contenedor Producto Específico-->
</div>