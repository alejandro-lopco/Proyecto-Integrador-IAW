<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../vista/back.css" />
</head>
<body>

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

        $id         = $producto['idProducto'];
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
function comprar($user,$prod,$cant) {
    $conex  = db::bdMYSQLI();
    if ($cant < 0) {
        header("Location: ../index.html");
    } else {
        $stmt   = "INSERT INTO carrito (idUser,idProducto,cantidad) VALUES (?,?,?)";
        $conex->execute_query($stmt,[$user,$prod,$cant]);    
    }
}
function mostrarContenidoCarrito() {
    $contenidoCarrito = ''; // Aquí vamos a guardar las cosas del carro para mostrarlas después
    $conex = db::bdMYSQLI(); // Conectamos para sacar los datos de la base
    $stmt = "SELECT productos.nombre, productos.imagenURL, carrito.cantidad, productos.precio AS preciouna, carrito.cantidad * productos.precio AS total FROM carrito INNER JOIN productos ON carrito.idProducto = productos.idProducto";
    $meter = $conex->query($stmt);

    // Creamos la tabla para mostrarla en el desplegable
    if ($meter->num_rows > 0) {
        $contenidoCarrito .= '<h3>Contenido del Carrito:</h3>';
        $contenidoCarrito .= '<table>';
        $contenidoCarrito .= '<thead>';
        $contenidoCarrito .= '<tr>';
        $contenidoCarrito .= '<th></th>';
        $contenidoCarrito .= '<th>Producto</th>';
        $contenidoCarrito .= '<th>Cantidad</th>';
        $contenidoCarrito .= '<th>Precio SNKR</th>';
        $contenidoCarrito .= '<th>TOTAL</th>';
        $contenidoCarrito .= '</tr>';
        $contenidoCarrito .= '</thead>';
        $contenidoCarrito .= '<tbody>';

        while ($filita = $meter->fetch_assoc()) {
            $contenidoCarrito .= '<tr>';
            $contenidoCarrito .= '<td class="centrado"><img src="../vista/img/' . $filita['imagenURL'] . '" alt="' . $filita['nombre'] . '" width="130"></td>';
            $contenidoCarrito .= '<td class="centrado">' . $filita['nombre'] . '</td>';
            $contenidoCarrito .= '<td class="centrado">' . $filita['cantidad'] . '</td>';
            $contenidoCarrito .= '<td class="centrado">' . $filita['preciouna'] . '</td>';
            $contenidoCarrito .= '<td class="centrado">' . $filita['total'] . '</td>';
            $contenidoCarrito .= '</tr>';
        }

        // Calcular el total de los subtotales
        $stmt = "SELECT SUM(carrito.cantidad * productos.precio) AS total_carrito FROM carrito INNER JOIN productos ON carrito.idProducto = productos.idProducto";
        $result = $conex->query($stmt);
        $totalcarrito = 0;
        if ($result && $filita = $result->fetch_assoc()) {
            $totalcarrito = $filita['total_carrito'];
        }

        // Agregar la fila del total al final de la tabla
        $contenidoCarrito .= '<tr>';
        $contenidoCarrito .= '<td colspan="4"><b>Total:</b></td>';
        $contenidoCarrito .= '<td class="centrado">' . $totalcarrito . '</td>';
        $contenidoCarrito .= '</tr>';

        $contenidoCarrito .= '</tbody>';
        $contenidoCarrito .= '</table>';
//AQUI ESTA EL BTON DE VACIAR TODO
/*         $contenidoCarrito .= '<form action="" method="POST">';
        $contenidoCarrito .= '<input type="hidden" name="accion" value="vaciarCarrito">';
        $contenidoCarrito .= '<input type="submit" value="Vaciar Carrito">';
        $contenidoCarrito .= '</form>'; */
    } else {
        $contenidoCarrito .= '<p>No hay elementos en el carrito</p>';
    }

    return $contenidoCarrito;
}
/* function vaciarCarritoUsuario($nombreUsuario) {
    $conex = db::bdMYSQLI(); // Conexión a la base de datos

    // Consulta para eliminar los elementos del carrito del usuario dado
    $stmt = "DELETE FROM carrito WHERE idUser = ?";
    
    // Preparar la declaración
    $query = $conex->prepare($stmt);

    // Vincular parámetros
    $query->bind_param("s", $nombreUsuario);

    // Ejecutar la consulta
    if ($query->execute()) {
        return true; // Éxito al vaciar el carrito del usuario
    } else {
        return false; // Falla al vaciar el carrito del usuario
    }
    $nombreUsuario = "<?= $_SESSION['nombre']?>"; // Nombre del usuario cuyo carrito queremos vaciar
} */
?>
</body>
</html>


