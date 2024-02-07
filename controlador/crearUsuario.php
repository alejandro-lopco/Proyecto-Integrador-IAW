<?php
require_once 'back.php';

# Comprobación de acceso mediante la
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../vista/login.html");
    die();
}
# Regcogemos todos los datos introducidos
$formLogin  = $_POST['loginName'];
$formPasswd = $_POST['passwd'];
$formName   = $_POST['userName'];
$formApe    = $_POST['userApe'];
$formMail   = $_POST['userMail'];
$formDir    = $_POST['userDir'];
# Comprobamos si los datos que hemos insertado son válidos

# Comprobamos si el usuario ya ha sido creado
$check = checkUsuario($formLogin,$formPasswd);
$errorCreate = comprobacionesUsuario($formLogin,$formPasswd,$formName,$formApe,$formMail,$formDir);
if (sizeof($errorCreate) == 0) {
    session_start();
    $_SESSION['nombre']         = $formName;
    $_SESSION['autentificado']  = true;

    crearUsuario($formLogin,$formPasswd,$formName,$formApe,$formMail,$formDir);

    header("Location: ../vista/cliente.php");
    die();
}