<?php  
//User.class.php  
  
require_once 'DB.class.php';  
  
  
class User {  
  
    public $id_Usuario;  
    public $nombre;
    public $hashedPassword;  
    public $correo;  
    public $usuario;  
  
    //Constructor is called whenever a new object is created.  
    //Takes an associative array with the DB row as an argument.  
    function __construct($data) {  
        $this->id_Usuario = (isset($data['id_Usuario'])) ? $data['id_Usuario'] : "";  
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : "";  
        $this->hashedPassword = (isset($data['password'])) ? $data['password'] : "";  
        $this->correo = (isset($data['correo'])) ? $data['correo'] : "";  
        $this->usuario = (isset($data['usuario'])) ? $data['usuario'] : "";  
    }  
  
    public function save($isNewUser = false) {  
        //create a new database object.  
        $db = new DB();  
          
        //if the user is already registered and we're  
        //just updating their info.  
        if(!$isNewUser) {  
            //set the data array  
            $data = array(  
                "nombre" => "'$this->nombre'",  
                "usuario" => "'$this->usuario'",
                "correo" => "'$this->correo'",
                "password" => "'$this->hashedPassword'"  
            );  
              
            //update the row in the database  
            $db->update($data, 'usuario', 'id_Usuario = '.$this->id_Usuario); 
        }else { 
        //if the user is being registered for the first time. 
            $data = array( 
                "nombre" => "'$this->nombre'",
                "usuario" => "'$this->usuario'", 
                "correo" => "'$this->correo'", 
                "password" => "'$this->hashedPassword'"  
            );  
              
            $this->id_Usuario = $db->insert($data, 'usuario');  
         
        }  
        return true;  
    }  
      
}  
  
?>  