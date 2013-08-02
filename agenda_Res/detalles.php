
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Actividades</title>

    <!-- Le styles -->
    <link rel="shortcut icon" href="happy.ico"> 
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
  
    <style>
      body { padding-top: 60px; }
    table { width: 100%; }
    td, th {text-align: left; white-space: display: block; }
    td.numeric, th.numeric { text-align: right; }
    h2, h3 {margin-top: 1em;}
    section {padding-top: 40px;}


  @media screen and (max-width : 800px) and (max-width: 1200px) {
  
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
$fecha = "";    
$descripcion = "";  
$id_Tarea = "";
$error = "";  


//check to see that the form has been submitted  
if(isset($_POST['submit-Actividad'])) {   
  
    //retrieve the $_POST variables 
    $id_Tarea = $_POST["id_Tarea"];
    //$fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];     
    $user = unserialize($_SESSION['usuario']);  

    //prep the data for saving in a new user object  
    $data['id_Tarea'] = $id_Tarea;
    $data['fecha'] = date("Y-m-d H:i:s",time());  
    $data['descripcion'] = $descripcion;
    $data['id_Usuario'] = $user->id_Usuario;

    //create the new user object  
    $newActividad = new Actividad();  
    //save the new user to the database  
    $newActividad->save($data, true);  

    $ListaTarea = $newActividad->getAll('id_Tarea = '.$id_Tarea);
    $_POST = null;


}else
{

  if(!is_null($_GET["id_Tarea"]))
  {
     $id_Tarea = $_GET["id_Tarea"];
    $newActividad = new Actividad();
    $ListaTarea = $newActividad->getAll('id_Tarea = '.$id_Tarea);
  }
  else
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

  <body >

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

  <form class="contact_form" action="detalles.php" method="post">

 <div class="controls">
      <p>Nueva Actividad</p>
        <p><textarea class="span5" placeholder="Describe la actividad" rows="5" cols="33"  name="descripcion" id="descripcion" required></textarea></p>
        <button type="submit" value="Login" name="submit-Actividad">Ingresar</button>  
      </div>

      <input type="hidden" name="id_Tarea" id="id_Tarea" value=<?php echo $id_Tarea ?> />
    </form>
    </div> 


<section id="no-more-tables">

<?php

$tabla = "<table id='lista_tareas' class='table-bordered table-striped table-condensed cf'>";
$tabla .= "<thead class='cf'><th>FECHA</th><th>DESCRIPCION</th></tr></thead>";
$tabla .= "<tbody>";

  foreach($ListaTarea as $key => $value)
  {
    $tabla =  $tabla. "<tr>"."<td data-title='FECHA'>".$value['fecha']."</td><td data-title='DESCRIPCION'>".$value['descripcion']."</td></tr>";
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
  </body>
</html>