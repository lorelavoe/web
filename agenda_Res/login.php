<?php  
//login.php  
  
require_once 'includes/global.inc.php';  
  
$error = "";  
$username = "";  
$password = "";  
  
//check to see if they've submitted the login form  
if(isset($_POST['submit-login'])) {  
 
    $username = $_POST['usuario']; 
    $password = $_POST['password'];  
  
    $userTools = new UserTools();  
    if($userTools->login($username, $password)){  
        //successful login, redirect them to a page  
        header("Location: tareas.php");  
    }else{  
        $error = "Incorrect username or password. Please try again.";  
    }  
}  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
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
    <br/>
    <form class="form-horizontal" action="login.php" method="post">
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
    <div class="controls">
      <label class="checkbox">
        <input type="checkbox"> Recordar
      </label>
      <button type="submit" class="btn" value="Login" name="submit-login">Ingresar</button>
    </div>
  </div>
</form>

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
