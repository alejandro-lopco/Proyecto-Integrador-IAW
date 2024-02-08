<?php
    require_once '../controlador/back.php';
    comprar($_GET['user'],$_GET['id'],$_GET['cant']);

    header("Location: ../vista/cliente.php");
    die();