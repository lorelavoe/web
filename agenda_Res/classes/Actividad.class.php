<?php  
//User.class.php  
  
require_once 'DB.class.php';  
  
  
class Actividad {  
  
      
    public $id_Actividad; 
    public $fecha;
    public $descripcion;  
    public $id_Tarea;
  
    function __construct() {  
         
        
    }  

  
    public function save($data, $isNuevaTarea = false) {  
        //create a new database object.  
        $db = new DB();  

         
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : "";  
        $this->fecha = (isset($data['fecha'])) ? $data['fecha'] : "";  
        $this->id_Actividad = (isset($data['id_Actividad'])) ? $data['id_Actividad'] : ""; 
        $this->id_Tarea = (isset($data['id_Tarea'])) ? $data['id_Tarea'] : "";


        //fill de data

          
        //if the user is already registered and we're  
        //just updating their info.  
        if(!$isNuevaTarea) {  
            //set the data array  
            $data = array(  
               "fecha" => "'".date("Y-m-d H:i:s",time())."'"
            );  
              
            //update the row in the database  
            $db->update($data, 'Actividad', 'id_Actividad = '.$this->id_Actividad); 
        }else { 
        //if the user is being registered for the first time. 
            $data = array( 
                "id_Actividad" => "'$this->id_Actividad'",
                "fecha" => "'".date("Y-m-d H:i:s",strtotime($this->fecha))."'",
                "descripcion" => "'$this->descripcion'",
                "id_Tarea" => "$this->id_Tarea" 
            );  
              
            $this->id_Tarea = $db->insert($data, 'actividad');  
         
        }  
        return true;  
    }

      public function getAll($id_Usuario)
      {
         //create a new database object.  
        $db = new DB();  
        $collecion = $db->selectAll('actividad', $id_Usuario);

        return $collecion;

      }    
      
}  
  
?>  