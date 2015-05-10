<?php

class Modules_Biblio_ModelDb_Librosmetadb extends Moon2_DBmanager_PDO{
    
    
    public function __construct() {
        parent::__construct();   //herede todo del padre
        $this->_table = "librosmeta";
        $this->_Pkey["key"] = "codlibrosmeta";
        $this->_Pkey ["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        
         
        
        $where=" ";
        $from = "FROM ".$this->_table." lb ";
        if(isset($Data["busqueda"])){
            $where = $this->get_where($Data["busqueda"]);
        }
        $order = " ";
                        

        $sql_num = " SELECT COUNT(*) ";
        $sql_num.=$from;
        $sql_num.=$where;


        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT lb.".$this->_Pkey["key"].", lb.nombre ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);

        return $arreglo;
    }
    public function load_libro($codlibro){
        
        $from = " select * FROM ".$this->_table." lb ";
        $data=array('codlibro'=>$codlibro);
        $where = $this->get_where($data["busqueda"]);
        $sql=$from.$data.$where;
        return $this->ExecuteSql($sql);
        
    }
    
 
    
    
    
    
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

