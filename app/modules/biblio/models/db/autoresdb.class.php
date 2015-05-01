<?php

class Modules_Biblio_ModelDb_Autoresdb extends Moon2_DBmanager_PDO{
    
    
    public function __construct() {
        parent::__construct();   //herede todo del padre
        $this->_table = "autores";
        $this->_Pkey["key"] = "codautor";
        $this->_Pkey ["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {

         var_dump($data);
        $from = "FROM ".$this->_table." a ";
        $where = $this->get_where($Data["busqueda"]);
        $order = " ";

                echo $where;    

        $sql_num = " SELECT COUNT(*) ";
        $sql_num.=$from;
        $sql_num.=$where;


        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT a.".$this->_Pkey["key"].", a.nombre ";
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
    
    
    
    
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

