<!--Inicio Tabla Pedido-->
<table>
    <thead>
        <tr>
            <b>Pedido #</b><?= $idPedido?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>A nombre de:</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Precio Total</td>
            <td>Contacto</td>
            <td>Dirección de envio</td>
        </tr>
        <tr>
            <td><p><?= $userNombre?> <?= $userApellido?></p></td>
            <td><?=$prodNombre?></td>
            <td><?=$cantidad?></td>
            <td><?=$precioUnitario?></td>
            <td><?=$userMail?></td>
            <td><?=$userDir?></td>
        </tr>
    </tbody>
</table>
<!--Fin Tabla Pedido-->