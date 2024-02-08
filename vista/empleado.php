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
  <link rel="stylesheet" href="../index.css" />
  <script src="../index.js"></script>
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
      <p>VISTA DEL EMPLEADO CON SUELDO MINIMO</p>
    </div>
    <!--Fin Titulo principal de página-->
    <!--Inicio Botón Login-->
    <a href="login.php" class="loginLink">
      <figure class="figLogin">
        <a href="index.php">
          <img src="img/login.png" alt="login" class="login" />
      </a>
        <figcaption class="loginCaption">Iniciar Sesión</figcaption>
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
          <div>
            <?php empleado::verPedidos();?>
          </div>
        <!--Inicio Contenedores Opciones-->
        </div>
        <div class="opcionesBody">
          <p class="tituloOpciones">Bienvenido <?= $_SESSION['nombre']?></p>
          <hr />
          <!--Inicio contenedor Opción Específica-->
          <div class="opcion" onmouseover="abrirDeslizable1()" onmouseout="cerrarDeslizable1()">
            <!--Incio Contenedor Opción Toggle-->
            <div class="toggleDeslizable">
              <a href="#" id="tituloOpcion1">
                <b>Opcion</b>
              </a>
            </div>
            <!--Incio Contenedor Opción Contenido-->
            <div class="deslizableOpcion" id="deslizableOpcion1">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae,
                quia mollitia. Tenetur tempore itaque, architecto perspiciatis
                consequuntur explicabo natus quas nobis minima totam ullam
                sint mollitia libero quia qui? Iste!
              </p>
              <!--Incio Contenedor Opción Contenido-->
            </div>
            <!--Fin contenedor Opción Específica-->
          </div>
          <!--Inicio contenedor Opción Específica-->
          <div class="opcion" onmouseover="abrirDeslizable2()" onmouseout="cerrarDeslizable2()">
            <!--Incio Contenedor Opción Toggle-->
            <div class="toggleDeslizable">
              <a href="#" id="tituloOpcion2">
                <b>Opcion</b>
              </a>
            </div>
            <!--Fin Contenedor Opción Toggle-->
            <!--Incio Contenedor Opción Contenido-->
            <div class="deslizableOpcion" id="deslizableOpcion2">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae,
                quia mollitia. Tenetur tempore itaque, architecto perspiciatis
                consequuntur explicabo natus quas nobis minima totam ullam
                sint mollitia libero quia qui? Iste!
              </p>
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