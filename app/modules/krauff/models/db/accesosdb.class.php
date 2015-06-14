<?php
class Modules_Krauff_ModelDb_AccesosDb extends Moon2_DBmanager_PDO{

public function __construct(){
    parent::__construct();
    $this->_table = "accesos";
    $this->_Pkey["key"] = "codacceso";
    $this->_Pkey["value"] = 0;
    $this->_sequence = $this->_table."_".$this->_Pkey['key']."_seq";
}

}//End class
?>