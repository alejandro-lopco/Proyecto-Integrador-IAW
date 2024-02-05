<?php
class Uusuario {
    public static function authenticate($conn, $username, $password) {
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

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
