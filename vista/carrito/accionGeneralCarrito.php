<form action='../../controlador/pedido/controladorPedido.php' method='get'>
    <input type='hidden' name='carro' value='<?= $_SESSION['nombre'] ?>'>
    <input type='submit' name='Check Out' value='Check Out'>
</form>
<form action='../../controlador/carrito/controladorBorrarProductoCarro.php' method='get'>
    <input type='hidden' name='NombreCarro' value='<?= $_SESSION['nombre'] ?>'>
    <input type='submit' name='Borrar Carrito' value='Borrar Carrito'>
</form>
