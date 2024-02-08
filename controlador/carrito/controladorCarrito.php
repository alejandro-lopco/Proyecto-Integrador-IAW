<?php
    require_once '../back.php';
    $cntrlCompra = new cliente('Cliente');
    $chkCompra = cliente::addCarrito($_GET['user'],$_GET['id'],$_GET['cant']);
    if (!$chkCompra) {
        include "../vista/carrito/falloCarrito.php";
    } else {
        header("Location: ../vista/cliente.php");
        die();
    }
