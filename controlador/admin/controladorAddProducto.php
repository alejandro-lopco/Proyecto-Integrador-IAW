<?php
    require_once '../back.php';
    administrador::addProducto(
        $_GET['nombre'],
        $_GET['precio'],
        $_GET['categoria'],
        $_GET['stock'],
        $_GET['idProveedor'],
        $_GET['urlImagen'],);
    header("Location: ../../vista/administrador.php");
    die();