<?php

class Modules_Empresa_ModelDb_Sedesdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "sedes";
        $this->_Pkey["key"] = "codsede";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {

        $from = "FROM sedes s ";
        $where = $this->get_where($Data["busqueda"]);

        $order = " ";
      

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;



        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT s.codsede, s.sede ,s.direccion ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;




        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);


        return $arreglo;
    }

    public function combo() {
        $sql = "SELECT codsede,sede ";
        $sql.="FROM sedes";
        $Arraybanco = $this->GetAssoc($sql);
        return $Arraybanco;
    }

}

?>
