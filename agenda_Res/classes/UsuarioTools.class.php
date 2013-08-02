<?php  
//UserTools.class.php  
  
require_once 'Usuario.class.php';  
require_once 'DB.class.php';  
  
class UserTools {  
  
    //Log the user in. First checks to see if the   
    //usuario and password match a row in the database.  
    //If it is successful, set the session variables  
    //and store the user object within.  
    public function login($usuario, $password)  
    {  
  
        $hashedPassword = md5($password);  
        $result = mysql_query("SELECT * FROM usuario WHERE usuario = '$usuario' AND password = '$hashedPassword'");  
  
        if(mysql_num_rows($result) == 1)  
        {  
            $_SESSION["usuario"] = serialize(new User(mysql_fetch_assoc($result)));  
            $_SESSION["login_time"] = time();  
            $_SESSION["logged_in"] = 1;  
            return true;  
        }else{  
            return false;  
        }  
    }  
      
    //Log the user out. Destroy the session variables.  
    public function logout() {  
        unset($_SESSION['usuario']);  
        unset($_SESSION['login_time']);  
        unset($_SESSION['logged_in']);  
        session_destroy();  
    }  
  
    //Check to see if a usuario exists.  
    //This is called during registration to make sure all user names are unique.  
    public function checkusuarioExists($usuario) {  
        $result = mysql_query("select id_Usuario from usuario where usuario='$usuario'");  
        if(mysql_num_rows($result) == 0)  
        {  
            return false;  
        }else{  
            return true;  
        }  
    }  
      
    //get a user  
    //returns a User object. Takes the usuario id as an input  
    public function get($id_Usuario)  
    {  
        $db = new DB();  
        $result = $db->select('usuario', "id_Usuario = $id_Usuario");  
        $sql = "";  
        return new User($result);  
    }    
}  
  
?>  