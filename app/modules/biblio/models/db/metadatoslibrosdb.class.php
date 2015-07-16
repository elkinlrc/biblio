<?php

class Modules_Biblio_ModelDb_Metadatoslibrosdb extends Moon2_DBmanager_PDO{
    
    
    public function __construct() {
        parent::__construct();   //herede todo del padre
        $this->_table = "metadatoslibros";
        $this->_Pkey["key"] = "codmetadatolibro";
        $this->_Pkey ["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        
         
        
        $where=" ";
        $from = "FROM ".$this->_table." m ";
        if(isset($Data["busqueda"])){
            $where = $this->get_where($Data["busqueda"]);
        }
        $order = " ";
                        

        $sql_num = " SELECT COUNT(*) ";
        $sql_num.=$from;
        $sql_num.=$where;


        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT m.".$this->_Pkey["key"].", m.etiqueta,m.minimo,m.maximo,m.requerido ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);

        return $arreglo;
    }
    
    public function combo() {
        $sql = "SELECT ".$this->_Pkey["key"].",etiqueta ";
        $sql.="FROM ". $this->_table;
        $Arraybanco = $this->GetAssoc($sql);
        return $Arraybanco;
    }
    public function loadMetadatosLibros(){
        $sql="select * from ". $this->_table;
        
        return $this->GetAll($sql);
        
        
    }
    public function loadOneMetadatos($codlibro) {
        $sql="select ml.valor,m.etiqueta from ". $this->_table ." ml inner join metadatos m on ml.codmetadato=m.codmetadato  where  codlibro=$codlibro  ";
        
        $datos= $this->GetAssoc($sql);
        
        //var_dump($datos);
        
        //exit();
        return $datos;
    }
    
    
    
    
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

