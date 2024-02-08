<?php
    require_once '../back.php';
    administrador::bloquearUsuario($_GET['idUser']);
    header("Location: ../../vista/administrador.php");
    die();