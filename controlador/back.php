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
# Inicio Objetos tipos de usuarios
class cliente {
    private $rolUsuario = 'Cliente';
    # Constructor del  objeto
    public function __construct($rolUsuario) {
        $this->rolUsuario = $rolUsuario;
    }
    # Getter
    public function getRol() : string {
        return $this->rolUsuario;
    }
    # Acciones específicas de usuario
    public static function addCarrito($user,$prod,$cant) : bool {
        $conex  = db::bdMYSQLI();
        # Comprobaciones de parametros correctos
        $chkCompra = true;
        # Se debe pedir por lo menos un solo producto
        if ($cant < 0) { 
            $chkCompra = false;
        }
        # Comprobamos si el usuario esta pidiendo más de lo que hay disponible
        $stmt   = "SELECT stock FROM productos WHERE idProducto=?";
        $qry    = $conex->execute_query($stmt,[$prod]);
        $rslt   = $qry->fetch_array(MYSQLI_NUM);
        if ($rslt[0] < $cant) {
            $chkCompra = false;
        }
        # En el caso de que una de estas comprobaciones haya fallado, no se añadirá al carrito
        if ($chkCompra) {
            $stmt   = "INSERT INTO carrito (idUser,idProducto,cantidad) VALUES (?,?,?)";
            $conex->execute_query($stmt,[$user,$prod,$cant]);
            return true;  
        } else {
            return false;
        }
    }
    # Función para mostrar los registros con el nombre de usuario con el que hemos iniciado sesión 
    public static function mostrarCarrito($user) : void { 
        $conex          = db::bdMYSQLI();
        $stmt           = "SELECT * FROM carrito WHERE idUser=?";
        $stmtProducto   = "SELECT * FROM productos WHERE idProducto=?";

        $precioTotal = 0;
        include '../vista/carrito/accionGeneralCarrito.php';
        foreach ($conex->execute_query($stmt,[$user]) as $prodCarrito) {
            $carritoProd    = $prodCarrito['idProducto'];    
            $carritoCant    = $prodCarrito['cantidad'];
            # Sacamos los datos del producto en específico
            $datosProd  = $conex->execute_query($stmtProducto,[$carritoProd]);
            $rstlProd   = $datosProd->fetch_assoc();
            $prodNombre     = $rstlProd['nombre'];
            $prodPrecio     = $rstlProd['precio'];
            $prodCategoria  = $rstlProd['categoria'];
            $prodImagen     = $rstlProd['imagenURL'];
            # Calculamos el precio total
            $precioTotal = $precioTotal + ($prodPrecio * $carritoCant);

            include '../vista/carrito/cajaCarrito.php';

        }
        echo "<h3>Precio Total ".round($precioTotal,2)." €</h3>";
    }
    public static function generarPedido($user) : void  {
        $conex      = db::bdMYSQLI();
        # Statements predefinidos
        $stmt       = "SELECT * FROM carrito WHERE idUser=?";
        $stmtPrecio = "SELECT precio FROM productos WHERE idProducto=?"; 
        $stmtStock  = "SELECT stock FROM productos WHERE idProducto=?"; 
        $stmtAdd    = "INSERT INTO pedidos (cantidad,fechaEntrega,idProducto,idUser,precioUnitario) VALUES (?,?,?,?,?)";
        $stmtDel    = "DELETE FROM carrito WHERE idUser=? AND idProducto=?";
        $stmtId     = "SELECT idUser FROM usuarios WHERE nombreLogin=?";
        $stmtUpdt   = "UPDATE productos SET stock=? WHERE idProducto=?";
        # Recogemos id de usuario
        $qryId      = $conex->execute_query($stmtId,[$user]);
        $rstlId     = $qryId->fetch_array();
        $idUser     = $rstlId[0];

        foreach ($conex->execute_query($stmt,[$user]) as $prodCarrito) {
            $idProd = $prodCarrito['idProducto'];
            $nombre = $prodCarrito['idUser'];
            $cant   = $prodCarrito['cantidad'];
            # generación fechaEntrega
                # Cogemos el momento del presente
            $fechaHora = new DateTime();
                # Añadimos 2 semanas al tiempo actual 'periodo(P)2 semanas(2W)
                # Leer https://en.wikipedia.org/wiki/ISO_8601
            $fechaHora->add(new DateInterval('P2W'));
                # Formateamos en un formato que acepte mySQL (AAAA-MM-DD)
            $fechaEntrega = $fechaHora->format('Y-m-d');
            # calculo precioUnitario
            $qryProd    = $conex->execute_query($stmtPrecio,[$idProd]);
            $rstlProd   = $qryProd->fetch_array();
            $precioProd = $rstlProd[0];
            $precioUnitario = round($precioProd * $cant,2);
            # Recogemos el stock del producto actual
            $qryStock       = $conex->execute_query($stmtStock,[$idProd]);
            $rstlStock      = $qryStock->fetch_array();
            $stockInicial   = $rstlStock[0];
            # Calculamos el stock que quedaría después de la compra
            $newStock = $stockInicial-$cant;
            # Adición de pedido
            $conex->execute_query($stmtAdd,[$cant,$fechaEntrega,$idProd,$idUser,$precioUnitario]);
            # Actualizamos el stock de la tabla de productos
            $conex->execute_query($stmtUpdt,[$newStock,$idProd]);
            # Borrado de todas las entradas del carro del usuario
            $conex->execute_query($stmtDel,[$nombre,$idProd]);
        }
    }
    public static function borrarCarrito($user) : void  {
        $conex      = db::bdMYSQLI();
        $stmt       = "DELETE FROM carrito WHERE idUser=?";
        # Borrado de todas las entradas del carro del usuario
        $conex->execute_query($stmt,[$user]);
    }
    public static function borrarProductoCarrito($user,$prod,$cant) {
        $conex      = db::bdMYSQLI();
        $stmt       = "DELETE FROM carrito WHERE idUser=? AND idProducto=? AND cantidad=?";
        # Borrado del registro en específicio que concuerde con los parámetros
        $conex->execute_query($stmt,[$user,$prod,$cant]);
    }
}
class empleado extends cliente {
    public function __construct() {
        # Llamamos al constructor superior y añadimos el rol que queremos
        parent::__construct("Administrador");
    }
    # Acciones específicas de usuario
    static function cambiarStock($newCant,$prod) {
        $conex  = db::bdMYSQLI();
        $stmt   = "UPDATE productos SET stock=? WHERE idProducto=?";
        $conex->execute_query($stmt,[$newCant,$prod]);
    }
    static function productosNoDisponibles() {
        # Mismo funcioamiento que mostrarProducto(), pero con los productos fuera de stock
        # Así podemos acceder gráficamente a productos a los que los clientes no tendrían acceso
        $conex  = db::bdMYSQLI();
        $stmt   = "SELECT * FROM productos WHERE stock = 0";
        foreach ($conex->query($stmt) as $producto) {
    
            $id         = $producto['idProducto'];
            $nombre     = $producto['nombre'];
            $precio     = $producto['precio'];
            $categoria  = $producto['categoria'];
            $stock      = $producto['stock'];
            $imagenURL  = $producto['imagenURL'];
    
            include '../vista/producto/cajaProductoEmpleado.php';
        }
    }
    static function verPedidos() {
        # Genera una tabla HTML relacionando todos los datos del usuario y el pedido en específico
        $conex      = db::bdMYSQLI();
        $stmtPedido = "SELECT * FROM PEDIDOS ORDER BY fechaEntrega";
        $stmtUser   = "SELECT userName,userApe,mail,dir FROM usuarios WHERE idUser=?";
        $stmtProducto   = "SELECT * FROM productos WHERE idProducto=?";
        foreach ($conex->query($stmtPedido) as $pedido) {
            $idPedido = $pedido['idPedido'];
            $cantidad = $pedido['cantidad'];
            $fechaEntrega = $pedido['fechaEntrega'];
            $idProducto = $pedido['idProducto'];
            $idUser = $pedido['idUser'];
            $precioUnitario = $pedido['precioUnitario'];
            # Recogemos datos de cuenta
            $datosUser  = $conex->execute_query($stmtUser,[$idUser]);
            $rstlUser   = $datosUser->fetch_assoc();
            $userNombre     = $rstlUser['userName'];
            $userApellido   = $rstlUser['userApe'];
            $userMail       = $rstlUser['mail'];
            $userDir        = $rstlUser['dir'];
            # Sacamos los datosdel producto en específico
            $datosProd  = $conex->execute_query($stmtProducto,[$idProducto]);
            $rstlProd   = $datosProd->fetch_assoc();
            $prodNombre     = $rstlProd['nombre'];

            include '../vista/pedido/listadoPedido.php';
        }
    }
}
class administrador extends empleado {
    public function __construct() {
        # Llamamos al constructor superior y añadimos el rol que queremos
        parent::__construct("Administrador");
    }
    # Acciones específicas de usuario
    static function productosNoDisponiblesAdmin() {
        # Mismo funcioamiento que mostrarProducto(), pero con los productos fuera de stock
        # Así podemos acceder gráficamente a productos a los que los clientes no tendrían acceso
        $conex  = db::bdMYSQLI();
        $stmt   = "SELECT * FROM productos WHERE stock = 0";
        foreach ($conex->query($stmt) as $producto) {
    
            $id         = $producto['idProducto'];
            $nombre     = $producto['nombre'];
            $precio     = $producto['precio'];
            $categoria  = $producto['categoria'];
            $stock      = $producto['stock'];
            $imagenURL  = $producto['imagenURL'];
    
            include '../vista/producto/cajaProductoAdmin.php';
        }
    }
    static function verPedidosAdmin() {
        # Mismo funcioamiento que verPedidos(), pero a diferencia del empleado este tiene acceso a opciones adicionales
        $conex      = db::bdMYSQLI();
        $stmtPedido = "SELECT * FROM PEDIDOS ORDER BY fechaEntrega";
        $stmtUser   = "SELECT userName,userApe,mail,dir FROM usuarios WHERE idUser=?";
        $stmtProducto   = "SELECT * FROM productos WHERE idProducto=?";
        foreach ($conex->query($stmtPedido) as $pedido) {
            $idPedido = $pedido['idPedido'];
            $cantidad = $pedido['cantidad'];
            $fechaEntrega = $pedido['fechaEntrega'];
            $idProducto = $pedido['idProducto'];
            $idUser = $pedido['idUser'];
            $precioUnitario = $pedido['precioUnitario'];
            # Recogemos datos de cuenta
            $datosUser  = $conex->execute_query($stmtUser,[$idUser]);
            $rstlUser   = $datosUser->fetch_assoc();
            $userNombre     = $rstlUser['userName'];
            $userApellido   = $rstlUser['userApe'];
            $userMail       = $rstlUser['mail'];
            $userDir        = $rstlUser['dir'];
            # Sacamos los datosdel producto en específico
            $datosProd  = $conex->execute_query($stmtProducto,[$idProducto]);
            $rstlProd   = $datosProd->fetch_assoc();
            $prodNombre = $rstlProd['nombre'];

            include '../vista/pedido/listadoPedidoAdmin.php';
        }
    }
    # Acciones Específicas dentro de los pedidos
    static function confirmarEntrega($pedido) {
        $conex  = db::bdMYSQLI();
        $stmt   = "DELETE FROM pedidos WHERE idPedido=?";
        $conex->execute_query($stmt,[$pedido]);
    }
    static function bloquearUsuario($user) {
        $conex  = db::bdMYSQLI();
        $stmt   = "DELETE FROM usuarios WHERE idUser=?";
        $conex->execute_query($stmt,[$user]);
    }
}
# Fin Objetos de usuarios
# Inicio Funciones dedicadas al login y la creación de usuarios
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
# Fin Funciones dedicadas al login y la creación de usuarios
# Inicio Funciones dedicadas a la vista de la página cliente
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

        switch ($_SESSION['rol']) {
            case 'administrador':
                include '../vista/producto/cajaProductoAdmin.php';
                break;    
            case 'empleado':
                include '../vista/producto/cajaProductoEmpleado.php';
                break;                
            default:
                include '../vista/producto/cajaProductoCliente.php';
                break;
        }
        /* 
            Esto muestra cada producto con unidades disponibles en la base de datos.
            Usamos el include para poder configurar fácilmente el HTML que estiliza la consulta
        */        

    }
}
# Fin Funciones dedicadas a la vista de la página cliente
