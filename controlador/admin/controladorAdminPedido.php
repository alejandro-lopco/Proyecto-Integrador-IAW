<?php
    require_once '../back.php';
    administrador::confirmarEntrega($_GET['idPedido']);
    header("Location: ../../vista/administrador.php");
    die();