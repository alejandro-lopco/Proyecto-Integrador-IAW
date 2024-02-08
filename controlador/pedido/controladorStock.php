<?php
    require_once '../back.php';
    empleado::cambiarStock($_GET['cant'],$_GET['id']);
    if ($_SESSION['rol'] = 'administrador') {
        header("Location: ../../vista/administrador.php");
    } else {
        header("Location: ../../vista/empleado.php");
    }
    die();