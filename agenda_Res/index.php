<?php  
require_once 'includes/global.inc.php';  
?> 

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Seguimiento de Tarea</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="happy.ico"> 
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" class="active" href="index.php">Seguimiento de tareas</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
             <?php if(isset($_SESSION['logged_in'])) : ?>  
              <?php $user = unserialize($_SESSION['usuario']); ?>  
              <?php echo $user->usuario; ?>
              <li><a href="salir.php">Logout</a></li>   
              <?php else : ?>  
              <li><a href="login.php">Log In</a></li>
              <?php endif; ?>

              <li><a href="crear.php">Crear Cuenta</a></li>
              <li><a href="tareas.php">Tareas</a></li>              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
  
      <h1>Seguimiento de Tareas</h1>
      <p>Pagina de inicio<br>
        Cuerpo de la pagina de correo
      </p>
      <p>
</p>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
