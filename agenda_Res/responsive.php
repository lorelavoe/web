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


//check to see that the form has been submitted  
if(isset($_POST['submit-tarea'])) {   
  
    //retrieve the $_POST variables 
    $titulo = $_POST['titulo'];
    $objetivo = $_POST['objetivo'];  
    $fechainicio = $_POST['fechainicio'];  
    $fechafin = $_POST['fechafin'];  
    $estatus = $_POST['id_estatus'];  
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

}else
{
  
    $newTarea = new Tarea();
    $ListaTarea = $newTarea->getAll('id_Usuario = '.$user->id_Usuario);

if(is_null($ListaTarea))
{
  echo "es nullo";
}else
{
  echo $user->id_Usuario;
}

  
  
}  
  
//If the form wasn't submitted, or didn't validate  
//then we show the registration form again  
?>  
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="bootstrap/css/style.css">
	<title>Responsive Table</title>

</head>

<body>


<table class='tabla'><thead><tr><th>Clave</th><th>Titulo</th><th>Descripcion</th><th>Inicio</th><th>Fin</th></tr></thead><tbody><tr><td>22</td><td>Tarea</td><td>primer tarea</td><td>2013-07-31 22:07:06</td><td>2013-07-26 22:07:06</td></tr><tr><td>24</td><td>TAREA CREAR POR ABI</td><td>otra tarea mas</td><td>2013-07-25 01:07:00</td><td>2013-08-16 01:07:00</td></tr><tr><td>25</td><td>TAREA CREAR POR ABI</td><td>otra tarea mas</td><td>2013-07-25 01:07:56</td><td>2013-08-16 01:07:56</td></tr></tbody></table>   


	<?php
/*
$tabla = "<table class='tabla'>";
$tabla .= "<thead><tr><th>Clave</th><th>Titulo</th><th>Descripcion</th><th>Inicio</th><th>Fin</th></tr></thead>";
$tabla .= "<tbody>";

  foreach($ListaTarea as $key => $value)
  {
    $tabla =  $tabla. "<tr>"."<td>".$value['id_Tarea']."</td><td>".$value['titulo']."</td><td>".$value['objetivo']."</td><td>".$value['fecha_inicio']."</td><td>".$value['fecha_fin']."</td></tr>";
  }

  $tabla = $tabla. "</tbody></table>";


  echo $tabla;
       */   

?>
	

</body>

</html>