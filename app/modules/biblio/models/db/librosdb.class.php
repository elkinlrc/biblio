<?php

class Modules_Biblio_ModelDb_Librosdb extends Moon2_DBmanager_PDO{
    
    
    public function __construct() {
        parent::__construct();   //herede todo del padre
        $this->_table = "libros";
        $this->_Pkey["key"] = "codlibro";
        $this->_Pkey ["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        
         
        
        $where=" ";

        $from = "FROM ".$this->_table." l ";
        if(isset($Data["busqueda"])){
            $where = $this->get_where($Data["busqueda"]);
        }
        $order = " ";
        $join =" left join metadatoslibros ml on l.codlibro=ml.codlibro  ";
        $join.=" left join metadatos m on m.codmetadato=ml.codmetadato "; 
        
                        

        $sql_num = " SELECT COUNT(*) ";
        $sql_num.=$from;
        $sql_num.=$where;
        $sql_num.=$join;

        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT l.".$this->_Pkey["key"].", l.titulo,l.subtitulo ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;
        $sql_registros.=$join;
        
       // echo $sql_registros;
      //  exit();

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);

        return $arreglo;
    }
    
    public function search(){
        
        
    }
    
    
    
    
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

