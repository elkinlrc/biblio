<?php

class Modules_Empresa_ModelDb_Oficinasdb extends Moon2_DBmanager_PDO{
    
    public function __construct() {
        parent::__construct();
        $this->_table = "oficinas";
        $this->_Pkey["key"] = "coddependencia";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }
    
     public function combo() { 
        $sql = "SELECT o.coddependencia, o.oficina FROM oficinas o ";
        $arreglo = $this->GetAssoc($sql); 
        return $arreglo;
     }
    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $from = "FROM oficinas o ";
        $where = $this->get_where($Data["busqueda"]);
        
        $order = " ORDER BY coddependencia DESC";

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;
        $rsNumRows = $this->GetOne($sql_num); 
        $sql_registros = "SELECT o.coddependencia, o.oficina ";
        $sql_registros.= $from;
        $sql_registros.= $where;
        $sql_registros.= $order;
        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);
        
        
        return $arreglo;
    }
}
?>
