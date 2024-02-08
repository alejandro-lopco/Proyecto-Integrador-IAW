<div class="contProdCarrito">
    <b><?=$prodNombre?></b> <br />
    <p><?=$prodPrecio ?></p>
    <p><?=$prodCategoria?></p>
    <p>Cantidad: <?= $carritoCant ?></p>
    <img src="img/<?= $prodImagen?>" alt="<?=$prodNombre?>" height="100px" width="150px">
    <form action="../controlador/carrito/controladorBorrarProductoCarro.php" method="get">
        <input type="hidden" name="nombre" value="<?= $_SESSION['nombre']?>">
        <input type="hidden" name="producto" value="<?= $carritoProd?>">
        <input type="hidden" name="cantidad" value="<?= $carritoCant?>">
        <input type="submit" value="Borrar">
    </form>
</div>