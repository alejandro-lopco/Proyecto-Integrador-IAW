<div class="contProdCarrito">
    <div class="contDatosProd">
        <div class="datosProd">
            <b><?=$prodNombre?></b> <br />
            <p><?=$prodPrecio ?> €</p>
            <p><?=$prodCategoria?></p>
            <p>Cantidad: <?= $carritoCant ?></p>
        </div>
        <div class="imgProd">
            <img src="img/<?= $prodImagen?>" alt="<?=$prodNombre?>" height="100px" width="150px">
        </div>
    </div>
    <div>
    <form action="../controlador/carrito/controladorBorrarProductoCarro.php" method="get">
        <input type="hidden" name="nombre" value="<?= $_SESSION['nombre']?>">
        <input type="hidden" name="producto" value="<?= $carritoProd?>">
        <input type="hidden" name="cantidad" value="<?= $carritoCant?>">
        <input type="submit" value="Borrar" class="accProdCarrito">
    </form>
    </div>
</div>
