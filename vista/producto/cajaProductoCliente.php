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
        <form action="../controlador/carrito/controladorCarrito.php" method="get">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="user" value="<?= $_SESSION['nombre'] ?>">
        <div class="contAccionProducto">
            <div class="accionProducto">
                <input type="number" name="cant" id="cant" min="1" max="<?=$stock?>" placeholder="Cantidad"> <br />
            </div>
            <div class="accionProducto">
                <input type="submit" name="Comprar" value="Comprar">
            </div>
        </div>
        </form>
    </div>
    <!--Fin Contenedor Producto Específico-->
</div>