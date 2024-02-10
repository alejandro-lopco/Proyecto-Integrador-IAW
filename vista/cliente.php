<?php session_start()?>
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
  <link rel="stylesheet" href="css/cliente.css" />
  <script src="js/cliente.js"></script>
  <?php 
  require_once '../controlador/back.php';
  if (!$_SESSION['autentificado']) { # Comprobación de que se ha pasado por el proceso de Login
    header("Location: ../index.html");
    die();
  }
  if ($_SESSION['rol'] != 'cliente') {
    header("Location: ../index.html");
    die();
  }
  ?>
</head>

<body>
  <header>
    <!--Inicio Titulo principal de página-->
    <div class="headerTitulo">
      <p>Bienvenido <?= $_SESSION['nombre']?></p>
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
            <?php mostrarProductos();?>
          </div>
          <!--Fin Contenedores Productos-->
        <!--Inicio Contenedores Opciones-->
        </div>
        <div class="opcionesBody">
          <p class="tituloOpciones">Bienvenido <?= $_SESSION['nombre']?></p>
          <hr />
          <!--Inicio contenedor Opción Específica-->
          <div class="opcion" onmouseover="abrirDeslizable1()" onmouseout="cerrarDeslizable1()">
            <!--Incio Contenedor Opción Toggle-->
            <!--Incio Contenedor Opción Contenido-->
          </div>
          <!--Inicio contenedor Opción Específica-->
          <div class="opcion" onmouseover="abrirCarrito()" onmouseout="cerrarCarrito()">
            <!--Incio Contenedor Opción Toggle-->
            <div class="toggleDeslizable">
              <a href="#" id="tituloOpcion2">
                <h2><i>Carrito</i></h2>
              </a>
            </div>
            <!--Fin Contenedor Opción Toggle-->
            <!--Incio Contenedor Opción Contenido-->
            <div class="deslizableOpcion" id="deslizableOpcion2">
              <hr />
              <?php cliente::mostrarCarrito($_SESSION['nombre'])?>
              <!--Fin Contenedor Opción Contenido-->
            </div>
            <!--Fin contenedor Opción Específica-->
          </div>
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