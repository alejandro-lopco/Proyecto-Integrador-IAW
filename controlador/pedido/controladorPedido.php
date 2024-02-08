<?php
    require_once '../controlador/back.php';
    cliente::generarPedido($_GET['carro']);
    header("Location: ../vista/cliente.php");
    die();