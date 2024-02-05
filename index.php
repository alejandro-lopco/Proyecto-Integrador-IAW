<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

require 'controlador/logincon.php';
require_once 'config/db.php';

$loginController = new logincon();

switch ($action) {
    case 'showLoginForm':
        $loginController->showLoginForm();
        break;
    case 'login':
        $loginController->processLogin($conn);
        break;
    default:
        break;
}
?>
