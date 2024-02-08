<?php
require_once '../back.php';

# Comprobación de acceso mediante la
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../../index.html");
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
$errorCreate = comprobacionesUsuario($formLogin,$formPasswd,$formName,$formApe,$formMail,$formDir);
# Comprobamos si el usuario ya ha sido creado
$check = checkUsuario($formLogin,$formPasswd);
if ($check)  {
    array_push($errorCreate,"Este usuario ya existe");
}
if (sizeof($errorCreate) == 0) {
    session_start();
    $_SESSION['nombre']         = $formLogin;
    $_SESSION['autentificado']  = true;

    crearUsuario($formLogin,$formPasswd,$formName,$formApe,$formMail,$formDir);

    header("Location: ../../vista/cliente.php");
    die();
} else {
    include '../../vista/user/falloCreate.php';
}