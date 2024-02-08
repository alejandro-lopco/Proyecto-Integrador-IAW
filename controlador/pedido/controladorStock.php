<?php
    require_once '../back.php';
    empleado::cambiarStock($_GET['cant'],$_GET['id']);
    if ($_SESSION['nombre'] == 'empleado') {
        header("Location: ../../vista/empleado.php");
        die();
    } else {
        header("Location: ../../vista/administrador.php");
        die();        
    }
    
