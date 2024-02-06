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
    $rslt   = $qry->fetch_all();
    if (sizeof($rslt) == 1) { # Solo funcionará cuando haya un único registro igual a ambos parámetros
        return true;
    } else {
        return false;
    }
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