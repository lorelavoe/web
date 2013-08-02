<?php  
//User.class.php  
  
require_once 'DB.class.php';  
  
  
class Tarea {  
  
      
    public $id_Tarea;
    public $titulo;  
    public $objetivo;  
    public $fecha_inicio;
    public $fecha_fin;
    public $id_estatus;  
    public $id_Usuario;
  
    function __construct() {  
         
        
    }  

  
    public function save($data, $isNuevaTarea = false) {  
        //create a new database object.  
        $db = new DB();  

        $this->id_Tarea = (isset($data['id_Tarea'])) ? $data['id_Tarea'] : "";  
        $this->titulo = (isset($data['titulo'])) ? $data['titulo'] : "";  
        $this->objetivo = (isset($data['objetivo'])) ? $data['objetivo'] : "";  
        $this->fecha_inicio = (isset($data['fecha_inicio'])) ? $data['fecha_inicio'] : "";  
        $this->fecha_fin = (isset($data['fecha_fin'])) ? $data['fecha_fin'] : "";  
        $this->id_estatus = (isset($data['id_estatus'])) ? $data['id_estatus'] : "";  
        $this->id_Usuario = (isset($data['id_Usuario'])) ? $data['id_Usuario'] : ""; 


        //fill de data

          
        //if the user is already registered and we're  
        //just updating their info.  
        if(!$isNuevaTarea) {  
            //set the data array  
            $data = array(  
               "fecha_fin" => "'".date("Y-m-d H:i:s",time())."'"
            );  
              
            //update the row in the database  
            $db->update($data, 'Tarea', 'id_Usuario = '.$this->id_Tarea); 
        }else { 
        //if the user is being registered for the first time. 
            $data = array( 
               "titulo" => "'$this->titulo'",  
                "objetivo" => "'$this->objetivo'",
                "fecha_inicio" => "'".date("Y-m-d H:i:s",strtotime($this->fecha_inicio))."'",
                "fecha_fin" =>  "'".date("Y-m-d H:i:s",strtotime($this->fecha_fin))."'", 
                "id_estatus" => "$this->id_estatus",
                "id_Usuario" => "$this->id_Usuario" 
            );  
              
            $this->id_Tarea = $db->insert($data, 'tarea');  
         
        }  
        return true;  
    }

      public function getAll($id_Usuario)
      {
         //create a new database object.  
        $db = new DB();  
        $collecion = $db->selectAll('tarea', $id_Usuario);

        return $collecion;

      }   

      public function getAllTarea($id_Usuario)
      {
         //create a new database object.  
        $db = new DB();

       

        $sql = "SELECT id_Tarea, titulo, objetivo, fecha_inicio, fecha_fin, nombre, id_Usuario\n"
    . "FROM tarea JOIN estatus ON ( tarea.id_estatus = estatus.id_estatus ) WHERE tarea.id_Usuario = ".$id_Usuario;

        $collecion = $db->selectOpen($sql);

      

        return $collecion;

      } 
      
}  
  
?>  