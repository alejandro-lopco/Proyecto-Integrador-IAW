<h1>Hay errores en los datos introducidos</h1>
<h2>Erorres:</h2>
<ol>
    <?php 
        foreach ($errorCreate as $error) { ?>
            <li><?= $error ?></li>
    <?php } ?>
</ol>

<a href="../../vista/user/crearUsuario.html"><button>Volver a la creación de usario</button></a>
<link rel="stylesheet" href="../../vista/css/fallologin.css" />