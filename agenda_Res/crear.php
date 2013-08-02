<?php  
//register.php  
  
require_once 'includes/global.inc.php';  
  
//initialize php variables used in the form  
$nombre = "";
$username = "";  
$password = "";  
$password_confirm = "";  
$email = "";  
$error = "";  
  
//check to see that the form has been submitted  
if(isset($_POST['submit-form'])) {   
  
    //retrieve the $_POST variables 
    $nombre = $_POST['nombre'];
    $username = $_POST['usuario'];  
    $password = $_POST['password'];  
    $password_confirm = $_POST['confirmar'];  
    $email = $_POST['email'];  
  
    //initialize variables for form validation  
    $success = true;  
    $userTools = new UserTools();  
  
    //validate that the form was filled out correctly  
    //check to see if user name already exists  
    if($userTools->checkusuarioExists($username))  
    {  
        $error .= "That username is already taken.<br/> \n\r";  
        $success = false;  
    }  
  
    //check to see if passwords match  
    if($password != $password_confirm) {  
        $error .= "Passwords do not match.<br/> \n\r";  
        $success = false;  
    }  
  
    if($success)  
    {  
        //prep the data for saving in a new user object  
        $data['nombre'] = $nombre;
        $data['usuario'] = $username;  
        $data['password'] = md5($password); //encrypt the password for storage  
        $data['correo'] = $email;  
  
        //create the new user object  
        $newUser = new User($data);  
  
        //save the new user to the database  
        $newUser->save(true);  
  
        //log them in  
        $userTools->login($username, $password);  
  
        //redirect them to a welcome page  
        header("Location: tareas.php");  
  
    }  
  
}  
  
//If the form wasn't submitted, or didn't validate  
//then we show the registration form again  
?>  

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nueva Cuenta</title>
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
      <link rel="stylesheet" media="screen" href="bootstrap/css/style.css" >
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk
/html5.js"></script>
        <![endif]-->
  
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


         <form class="form-horizontal" action="crear.php" method="post">
            <p>Crear nueva cuenta</p>
          <div class="control-group">
            <label class="control-label" for="inputEmail">Nombre</label>
            <div class="controls">
              <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo del Usuario" required>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="inputEmail">Correo</label>
            <div class="controls">
              <input type="email" name="email" id="email" placeholder="tucorreo@tudominio.com" required />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputEmail">Usuario</label>
            <div class="controls">
              <input type="text" name="usuario" id="usuario" placeholder="Usuario" required>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
            <div class="controls">
              <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="inputPassword">Confirmar</label>
            <div class="controls">
             <input type="password" name="confirmar" id="confirmar" placeholder="confirmar password" autocomplete="off" required />
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
               <button class="submit" value="Mostrar" type="submit" name="submit-form" >Enviar</button>
            </div>
          </div>
        </form>
    </div> <!-- /container -->
</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
