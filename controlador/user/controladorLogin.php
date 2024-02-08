<?php

require_once '../back.php';

# Comprobación de acceso mediante la
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../../index.html");
    die();
}

$formNombre = $_POST['username'];
$formPasswd = $_POST['passwd'];

$formNombre = trim($formNombre);
$formPasswd = trim($formPasswd);

$check = checkUsuario($formNombre,$formPasswd);

if ($check) { # Si la variable devuelve true el login será correcto 
    session_start();
    $_SESSION['nombre']         = $formNombre;
    $_SESSION['autentificado']  = true;

    switch ($formNombre) { # Acesso a página correspondiente por tipo de usuario
        case 'administrador':
            $_SESSION['rol'] = 'administrador';
            header("Location: ../../vista/administrador.php");
            die();
            break;
        
        case 'empleado':
            $_SESSION['rol'] = 'empleado';
            header("Location: ../../vista/empleado.php");
            die();            
            break;
        default:
            $_SESSION['rol'] = 'cliente';
            header("Location: ../../vista/cliente.php");
            die();
            break;
    }
} else {
    include_once '../../vista/user/falloLogin.html';
}