<?php require_once '../controlador/back.php'; ?>
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
        <form action="../controlador/controladorCompra.php" method="get">
            <input type="number" name="cant" id="cant" placeholder="Cantidad"> <br />
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="user" value="<?= $_SESSION['nombre'] ?>">
            <input type="submit" name="Comprar" value="Comprar">
        </form>
        </form>
        <form action="#"><input type="submit" name="Detalle" value="Detalle"></form>
    </div>
    <!--Fin Contenedor Producto Específico-->
</div>