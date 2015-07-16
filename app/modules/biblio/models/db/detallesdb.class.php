<?php

class Modules_Biblio_ModelDb_Detallesdb extends Moon2_DBmanager_PDO{
    
    
    public function __construct() {
        parent::__construct();   //herede todo del padre
        $this->_table = "detalles";
        $this->_Pkey["key"] = "coddetalle";
        $this->_Pkey ["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        
         
        
        $where=" ";
        $from = "FROM ".$this->_table." d ";
        if(isset($Data["busqueda"])){
            $where = $this->get_where($Data["busqueda"]);
        }
        $order = " ";
                        

        $sql_num = " SELECT COUNT(*) ";
        $sql_num.=$from;
        $sql_num.=$where;


        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT d.".$this->_Pkey["key"].", d.nombre ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);

        return $arreglo;
    }
    
    public function combo() {
        $sql = "SELECT ".$this->_Pkey["key"].",nombre ";
        $sql.="FROM ". $this->_table;
        $Arraybanco = $this->GetAssoc($sql);
        return $Arraybanco;
    }
    public function loadOneDetalles($codlibro){
        $sql="select * from detalles where codlibro=$codlibro ";
        $datos= $this->GetAssoc($sql);
        return $datos;
            
    }
    public function jsonDetalles($buscar){
        
        $sql="select * from  libros l left join  detalles d on d.codlibro=l.codlibro  ";
        $sql.= " where codigobarras like '$buscar%' or l.titulo like '%$buscar%' ";
        
        //echo $sql;
        $json=$this->GetAll($sql);
        return json_encode($json);
    }
    
    
    
    
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

