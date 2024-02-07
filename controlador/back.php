<?php
# Fichero general para la creación de objetos y funciones
abstract class db { # Objeto para conexiones rápidas a base de datos con PSO o MYSQLI
    private static $servidor    = 'localhost';
    private static $BBDD        = 'tienda';
    private static $user        = 'root';
    private static $pass        = '';

    public static function bdPDO() {
        try {
            $conexPDO = new PDO(
                "mysql:host=".self::$servidor.";
                dbname:".self::$BBDD.";
                charset=utf\8",
                self::$user,
                self::$pass);
        } catch (PDOException $excpPDO) {
            echo "Error en la base de datos.";
            die("Error: ".$excpPDO->getMessage());
        }
        return $conexPDO;
    }
    public static function bdMYSQLI() {
        try {
            $conexMYSQLI = new mysqli(
                self::$servidor,
                self::$user,
                self::$pass,
                self::$BBDD );
        } catch (mysqli_sql_exception $excpMYSQLI) {
            echo "Error en la base de datos.";
            die("Error: ".$excpMYSQLI->getMessage());
        }
        return $conexMYSQLI;
    }
}

function checkUsuario($nombre,$passwd): bool {
    $conex  = db::bdMYSQLI();
    $stmt   = "SELECT nombreLogin FROM usuarios WHERE nombreLogin=? AND passLogin=? LIMIT 1";
    $qry    = $conex->execute_query($stmt,[$nombre,$passwd]);
    if ($qry->num_rows == 1) { # Solo funcionará cuando haya un único registro igual a ambos parámetros
        return true;
    } else {
        return false;
    }
}
function comprobacionesUsuario($login,$passwd,$nombre,$apellido,$correo,$direccion) : array {
    $errorCreate = []; # Devuelve un array con todos los fallos que ha encontrado en los datos
    # Comprobación de usuario existente
    if (checkUsuario($login,$passwd)) {
        array_push($errorCreate,"Este usuario ya existe");
    }
    # Comprobaciones de longitud
    if (strlen($login) > 18) {
        array_push($errorCreate,"El nombre de inicio de sesión es demasiado largo");
    }
    if (strlen($passwd) < 6) {
        array_push($errorCreate,"La Contraseña debe ser más larga");
    }
    if (strlen($passwd) > 18) {
        array_push($errorCreate,"La Contraseña debe ser más corta");
    }
    if (strlen($nombre) > 25) {
        array_push($errorCreate,"El nombre es demasiado largo.") ;
    }
    if (strlen($apellido) > 25) {
        array_push($errorCreate,"El apellido es demasiado largo.") ;
    }
    if (strlen($correo) > 50) {
        array_push($errorCreate,"El correo es demasiado largo.") ;
    }
    if (strlen($direccion) > 200) {
        array_push($errorCreate,"La dirección es demasiado larga.") ;
    }
    # Estas comprobaciones existen para no meter un valor no valido dentro de la base de datos
    return $errorCreate;
}
function crearUsuario($login,$passwd,$nombre,$apellido,$correo,$direccion) {
    $conex  = db::bdMYSQLI();
    $stmt   = "INSERT INTO usuarios (nombreLogin, passLogin, userName, userApe, mail, dir) VALUES (?,?,?,?,?,?)";
    $conex->execute_query($stmt,[$login,$passwd,$nombre,$apellido,$correo,$direccion]);
}
function mostrarProductos() {
    $conex  = db::bdMYSQLI();
    $stmt   = "SELECT * FROM productos WHERE stock > 0";
    foreach ($conex->query($stmt) as $producto) {

        $nombre     = $producto['nombre'];
        $precio     = $producto['precio'];
        $categoria  = $producto['categoria'];
        $stock      = $producto['stock'];
        $imagenURL  = $producto['imagenURL'];

        include 'cajaProducto.php';
        /* 
            Esto muestra cada producto con unidades disponibles en la base de datos.
            Usamos el include para poder configurar fácilmente el HTML que estiliza la consulta
        */        

    }
}