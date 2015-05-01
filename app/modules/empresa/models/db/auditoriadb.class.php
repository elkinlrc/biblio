<?php

class Modules_Empresa_ModelDb_Auditoriadb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();   //herede todo del padre
        $this->_table = "auditoria ";
        $this->_Pkey["key"] = "codauditoria";
        $this->_Pkey ["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {

        $from = "FROM auditoria a ";
//        $from.=" inner join equipos e on m.codequipo=e.codequipo";
        $where = " ";
        $order = " ";



        $sql_num = " SELECT COUNT(*) ";
        $sql_num.=$from;
        $sql_num.=$where;


        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT a.codauditoria,a.nombretabla,a.tipooperacion,a.codregistro ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);

        return $arreglo;
    }
    
    
    
}

?>