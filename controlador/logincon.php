<?php
require_once 'modelo/usuario.php';

class logincon {
    public function showLoginForm() {
        require 'vista/login.php';
    }

    public function processLogin($conn) {
        session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (usuario::autenticar($conn, $username, $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['authenticated'] = true;
            header("Location: siguiente_pagina.php"); //aqui ponemos la siguiente pagina
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
?>
