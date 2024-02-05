<?php
class Usuario {
    public static function autenticar($conn, $username, $password) {
        $query = "SELECT * FROM usuarios WHERE nombreLogin='$username' AND passLogin='$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>
