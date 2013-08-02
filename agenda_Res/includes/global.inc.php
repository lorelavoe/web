<?php  
require_once 'classes/Usuario.class.php';  
require_once 'classes/UsuarioTools.class.php';  
require_once 'classes/DB.class.php';
require_once 'classes/Tarea.class.php'; 
require_once 'classes/Actividad.class.php';
require_once 'classes/Estatus.class.php'; 

date_default_timezone_set('America/Mexico_City'); 
define('WP_MEMORY_LIMIT', '64M');
  
//connect to the database  
$db = new DB();  
$db->connect();  
  
//initialize UserTools object  
$userTools = new UserTools();  
  
//start the session  
session_start();  
  
//refresh session variables if logged in  
if(isset($_SESSION['logged_in'])) {  
    $user = unserialize($_SESSION['usuario']);  
    $_SESSION['usuario'] = serialize($userTools->get($user->id_Usuario));  
}  
?> 