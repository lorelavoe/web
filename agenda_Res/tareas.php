
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Tarea</title>

    <!-- Le styles -->
    <link rel="shortcut icon" href="happy.ico"> 
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-select.css" rel="stylesheet">
     <link href="bootstrap/css/bootstrap-select.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
  
    <style>
      body { padding-top: 60px; }
    table { width: 100%; }
    td, th {text-align: left; white-space: nowrap;}
    td.numeric, th.numeric { text-align: right; }
    h2, h3 {margin-top: 1em;}
    section {padding-top: 40px;}


  @media screen and (max-width : 480px) and (max-width: 800px) {
  
  /* Force table to not be like tables anymore */
  #no-more-tables table, 
  #no-more-tables thead, 
  #no-more-tables tbody, 
  #no-more-tables th, 
  #no-more-tables td, 
  #no-more-tables tr { 
    display: block; 
  }
 
  /* Hide table headers (but not display: none;, for accessibility) */
  #no-more-tables thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
 
  #no-more-tables tr { border: 1px solid #ccc; }
 
  #no-more-tables td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
    white-space: normal;
    text-align:left;
  }
 
  #no-more-tables td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
    text-align:left;
    font-weight: bold;
  }
 
  /*
  Label the data
  */
  #no-more-tables td:before { content: attr(data-title); }
}

  
    </style>


    <?php  
//register.php  
  
require_once 'includes/global.inc.php';  
  
//initialize php variables used in the form  
$titulo = "";
$objetivo = "";  
$fechainicio = "";  
$fechafin = "";  
$estatus = "";  
$error = "";  

 $newEstatus = new Estatus();
 $listaEstatus = $newEstatus->getAll();

//check to see that the form has been submitted  
if(isset($_POST['submit-tarea'])) {   
  
    //retrieve the $_POST variables 
    $titulo = $_POST['titulo'];
    $objetivo = $_POST['objetivo'];  
    $fechainicio = $_POST['fechainicio'];  
    $fechafin = $_POST['fechafin'];  
    $estatus = $_POST['estatus'];

    $user = unserialize($_SESSION['usuario']);  

    //prep the data for saving in a new user object  
    $data['titulo'] = $titulo;
    $data['objetivo'] = $objetivo;  
    $data['fecha_inicio'] = $fechainicio." ".date("H:m:s", time());  
    $data['fecha_fin'] = $fechafin." ".date("H:m:s", time());  
    $data['id_estatus'] = $estatus;
    $data['id_Usuario'] = $user->id_Usuario;

    //create the new user object  
    $newTarea = new Tarea();  

    //save the new user to the database  
    $newTarea->save($data, true);  

    $ListaTarea = $newTarea->getAllTarea($user->id_Usuario);


}else
{
  if(!is_null($user))
  {
    $newTarea = new Tarea();
    $ListaTarea = $newTarea->getAllTarea($user->id_Usuario);
  }else
  {
     header("Location: login.php");  
  }
  
}  
  
//If the form wasn't submitted, or didn't validate  
//then we show the registration form again  
?>  
  
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
          <a class="brand" href="index.php">Seguimiento de tareas</a>
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

      <div id="global">

    <div class="container">
  <form class="contact_form" action="tareas.php" method="post">
     <div class="controls">
      <p>Nueva Tarea</p>
      <input type="text" class="span6" name="titulo" id="usuario" placeholder="Titulo de la tarea" required />
     </div>
     <div class="controls controls-row">
        <input type="text" class="span4" name="objetivo" id="objetivo" placeholder="Objetivo" autocomplete="off" required />
         <select class="selectpicker show-menu-arrow" name="estatus">
          <?php
            $opciones = "";

            foreach ($listaEstatus as $key => $value) {
              $opciones .= "<option value=".$value['id_Estatus'].">".$value['nombre']."</option>";   
            }

            echo $opciones;

           ?>
        </select>
     </div>
     <div class="controls controls-row">
         <div id="datetimeinicio" class="input-append">
          <input data-format="yyyy-MM-dd" type="date" class="span3" name="fechainicio" id="fechainicio" placeholder="Fecha de inicio" autocomplete="off" required  ></input>
          <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
          </span>
        </div>
        <div id="datetimefin" class="input-append">
          <input data-format="yyyy-MM-dd" type="date" class="span3" name="fechafin" id="fechafin" placeholder="Fecha de Fin" autocomplete="off" required  ></input>
          <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
          </span>
        </div>
      
    </div>
    <div class="controls">
       <button type="submit" class="span1" value="Login" name="submit-tarea">Agregar</button>
     </div>


    </form>
    </div> 

<section id="no-more-tables">

<?php

$tabla = "<table id='lista_tareas' class='table-bordered table-striped table-condensed cf'>";
$tabla .= "<thead class='cf'><tr><th>DETALLES</th><th>TITULO</th><th>DESCRIPCION</th><th>FECHA INICIO</th><th>FECHA FIN</th><th>ESTATUS</th></tr></thead>";
$tabla .= "<tbody>";

  foreach($ListaTarea as $key => $value)
  {
    $tabla =  $tabla. "<tr>"."<td data-title='CLAVE'><a href='detalles.php?id_Tarea=".$value['id_Tarea']."'>Ver</a></td><td data-title='TITULO'>".$value['titulo']."</td><td data-title='DESCRIPCION'>".$value['objetivo']."</td><td data-title='FECHA INICIO'>".$value['fecha_inicio']."</td><td data-title='FECHA FIN'>".$value['fecha_fin']."</td><td data-title='ESTATUS'>".$value['nombre']."</td></tr>";
  }

  $tabla = $tabla. "</tbody></table>";


  echo $tabla;
          

?>

</section>


</div>
    <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <script src="bootstrap/js/bootstrap-select.js"></script>
     <script src="bootstrap/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
  $(function() {
    $('#datetimeinicio').datetimepicker({
      pickTime: false
    });
  });
   $(function() {
    $('#datetimefin').datetimepicker({
      pickTime: false
    });
  });
</script>
  </body>
</html>