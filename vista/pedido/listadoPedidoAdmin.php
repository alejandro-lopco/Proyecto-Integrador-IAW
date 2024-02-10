<!--Inicio Tabla Pedido-->
<div class="pedido">
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
                <td colspan="2">Acciones</td>
            </tr>
            <tr>
                <td><p><?= $userNombre?> <?= $userApellido?></p></td>
                <td><?=$prodNombre?></td>
                <td><?=$cantidad?></td>
                <td><?=$precioUnitario?></td>
                <td><?=$userMail?></td>
                <td><?=$userDir?></td>
                <td>
                    <form action="../controlador/admin/controladorAdminPedido.php" method="get">
                        <input type="hidden" name="idPedido" value="<?= $idPedido;?>">
                        <input type="submit" value="Confirmar Llegada">
                    </form>
                </td>
                <td>
                    <form action="../controlador/admin/controladorAdminUsuario.php" method="get">
                        <input type="hidden" name="idUser" value="<?= $idUser;?>">
                        <input type="submit" value="Bloquear Usuario">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!--Fin Tabla Pedido-->