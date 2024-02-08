<?php
    require_once '../back.php';
    empleado::cambiarStock($_GET['cant'],$_GET['id']);
    header("Location: ../../vista/administrador.php");
    die();
