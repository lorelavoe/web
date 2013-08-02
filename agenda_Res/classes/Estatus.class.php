<?php  
//User.class.php  
  
require_once 'DB.class.php';  
  
  
class Estatus {  
  
      
    public $id_Estatus; 
    public $nombre;  
  
    function __construct() {  
         
        
    }  

  
    public function save($data, $isNuevaTarea = false) {  
        //create a new database object.  
        $db = new DB();  
        $this->id_Estatus = (isset($data['id_Estatus'])) ? $data['id_Estatus'] : "";
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : "";  


        //fill de data

          
        //if the user is already registered and we're  
        //just updating their info.  
        if(!$isNuevaTarea) {  
            //set the data array  
            $data = array(  
               "nombre" => "'$this->nombre'"
            );  
              
            //update the row in the database  
            $db->update($data, 'estatus', 'id_Estatus = '.$this->id_Estatus); 
        }else { 
        //if the user is being registered for the first time. 
            $data = array( 
                "id_Estatus" => "'$this->id_Estatus'",
                "nombre" => "'$this->nombre'"
            );  
              
            $this->id_Tarea = $db->insert($data, 'estatus');  
         
        }  
        return true;  
    }

      public function getAll()
      {
         //create a new database object.  
        $db = new DB();  
        $collecion = $db->selectAllTable('estatus');

        return $collecion;

      }    
      
}  
  
?>  