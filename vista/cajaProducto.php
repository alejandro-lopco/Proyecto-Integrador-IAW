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
<!--Fin Contenedor Producto Específico-->
</div>