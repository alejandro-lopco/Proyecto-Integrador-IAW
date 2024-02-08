<?php
    require '../back.php';
    cliente::borrarProductoCarrito($_GET['nombre'],$_GET['producto'],$_GET['cantidad']);
    header("Location: ../../vista/cliente.php");
    die();