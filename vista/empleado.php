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
  <link rel="stylesheet" href="css/empleado.css" />
  <script src="js/index.js"></script>
  <?php 
  require_once '../controlador/back.php';
  if (!$_SESSION['autentificado']) { # Comprobación de que se ha pasado por el proceso de Login
    header("Location: ../index.html");
    die();
  }
  if (!$_SESSION['rol'] = 'empleado') {
    header("Location: ../index.html ");
    die();
  }
  ?>
</head>

<body>
  <header>
    <!--Inicio Titulo principal de página-->
    <div class="headerTitulo">
      <p>Bienvenido <?= $_SESSION['nombre']?> </p>
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
          <h2>Productos No Disponibles</h2>
          <hr />
          <div class="contItems">
          <?php empleado::productosNoDisponibles();?>
          </div>
          <h2>Listado de pedidos</h2>
          <hr />
          <div class="tablaPedidos">
            <?php empleado::verPedidos();?>
          </div>

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