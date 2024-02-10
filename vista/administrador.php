<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="Nombre#1" content="Alejandro López Corral" />
  <meta name="Nombre#2" content="Iván Barchín Barrasa" />
  <meta name="Instituto" content="Ies Villabla" />
  <meta name="Modulo" content="Implantación de Aplicaciones Web" />
  <title>Tienda Sneaker</title>
  <link rel="stylesheet" href="css/admin.css" />
  <script src="js/admin.js"></script>
  <?php
  require_once '../controlador/back.php';
  if (!$_SESSION['autentificado']) { # Comprobación de que se ha pasado por el proceso de Login
    header("Location: ../index.html");
    die();
  }
  if ($_SESSION['rol'] != 'administrador') {
    header("Location: ../index.html");
    die();
  }
  ?>
</head>

<body>
  <header>
    <!--Inicio Titulo principal de página-->
    <div class="headerTitulo">
      <p>Bienvenido <?= $_SESSION['nombre'] ?></p>
    </div>
    <!--Fin Titulo principal de página-->
    <!--Inicio Botón Login-->
    <a href="login.php" class="loginLink">
      <figure class="figLogin">
        <a href="../controlador/user/cerrarsesion.php">
          <img src="img/logout.png" alt="login" class="login" />
        </a>
        <figcaption class="loginCaption">Cerrar Sesión</figcaption>
      </figure>
    </a>
    <!--Fin Botón Login-->
  </header>
  <aside></aside>
  <main>
    <section>
      <article>
        <!--Inicio Contenedores Body-->
        <div class="mainBody" id="mainBody">
          <h2>Productos disponibles</h2>
          <hr />
          <!--Inicio Contenedores Productos-->
          <div class="contItems">
            <?php mostrarProductos(); ?>
          </div>
          <!--Fin Contenedores Productos-->
          <h2>Productos No Disponibles</h2>
          <hr />
          <div class="contItems">
            <?php administrador::productosNoDisponiblesAdmin(); ?>
          </div>
          <h2>Listado de pedidos</h2>
          <hr />
          <div class="tablaPedidos">
            <?php administrador::verPedidosAdmin(); ?>
          </div>
          <!--Inicio Contenedores Opciones-->
        </div>
        <div class="opcionesBody">
          <p class="tituloOpciones">Opciones de <?= $_SESSION['nombre'] ?></p>
          <hr />
          <!--Inicio contenedor Opción Específica-->
          <div class="opcion" onmouseover="abrirDeslizable1()" onmouseout="cerrarDeslizable1()">
            <!--Incio Contenedor Opción Toggle-->
            <div class="toggleDeslizable">
              <a href="#" id="tituloOpcion1">
                <b>Añadir nuevo producto</b>
              </a>
            </div>
            <!--Incio Contenedor Opción Contenido-->
            <div class="deslizableOpcion" id="deslizableOpcion1">
              <form action="../controlador/admin/controladorAddProducto.php" method="get">
                <table class="tablaAddProd">
                  <tr>
                    <td><label for="nombre">Nombre Producto</label></td>
                    <td><input type="text" name="nombre" id="nombre"></td>
                  </tr>
                  <tr>
                    <td><label for="Precio">Precio:</label></td>
                    <td><input type="number" name="precio" id="precio"></td>
                  </tr>
                  <tr>
                    <td><label for="categoria">Categoria:</label></td>
                    <td><input type="text" name="categoria" id="categoria"></td>
                  </tr>
                  <tr>
                    <td><label for="stock">Stock:</label></td>
                    <td><input type="number" name="stock" id="stock"></td>
                  </tr>
                  <tr>
                    <td><label for="idProveedor">ID del Proveedor:</label></td>
                    <td><input type="number" name="idProveedor" id="idProveedor"></td>
                  </tr>
                  <tr>
                    <td><label for="urlImagen">Nombre Archivo Imagen:</label></td>
                    <td><input type="text" name="urlImagen" id="urlImagen"></td>
                  </tr>
                </table>
                <input type="submit" value="Añadir" class="inputAdd">
              </form>
              <!--Incio Contenedor Opción Contenido-->
            </div>
            <!--Fin contenedor Opción Específica-->
          </div>
          <!--Inicio contenedor Opción Específica-->
          <!--Fin Contenedores Opciones-->
        </div>
        <!--Fin Contenedores Body-->
      </article>
    </section>
  </main>
  <footer>
    <p>
      Proyecto Integrador IAW - <b>Alejandro López Corral</b> e
      <b>Iván Barchín Barrasa</b> <br />
      <br /><i> snkrs4you.com </i>
    </p>
  </footer>
</body>

</html>