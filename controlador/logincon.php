<?php
require_once 'modelo/usuario.php';

class LoginController {
    public function showLoginForm() {
        require 'vista/login.php';
    }

    public function processLogin($conn) {
        session_start();

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (usuario::authenticate($conn, $username, $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['authenticated'] = true;
            header("Location: siguiente_pagina.php"); //aqui ponemos la siguiente pagina
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
?>
