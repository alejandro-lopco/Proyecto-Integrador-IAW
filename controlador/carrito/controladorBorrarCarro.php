<?php
    require 'back.php';
    cliente::borrarCarrito($_GET['NombreCarro']);
    header("Location: ../vista/cliente.php");
    die();