<?php
    require_once '../back.php';
    cliente::generarPedido($_GET['carro']);
    header("Location: ../../vista/cliente.php");
    die();