<?php
    require_once '../back.php';
    administrador::delProducto($_GET['id']);
    header("Location: ../../vista/administrador.php");
    die();