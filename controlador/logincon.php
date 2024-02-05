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

            if ($username === 'administrador') {
                header("Location: administrador.php");
            } elseif ($username === 'empleado') {
                header("Location: empleado.php");
            } else {
                header("Location: cliente.php");
            }
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
?>

