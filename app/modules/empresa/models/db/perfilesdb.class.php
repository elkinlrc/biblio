<?php

class Modules_Empresa_ModelDb_Perfilesdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "perfiles";
        $this->_Pkey["key"] = "codperfil";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function combo() {
        $sql = "SELECT p.codperfil, p.perfil FROM perfiles p ";
        $arreglo = $this->GetAssoc($sql);
        return $arreglo;
    }

   public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {

        $from = "FROM perfiles p ";
//        $where = " ";
        $where = $this->get_where($Data["busqueda"]);
        
      
       // exit();
        $order = " ";
        $order = " ";

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;



        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT p.codperfil, p.perfil ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;




        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);


        return $arreglo;
    }

    
    

}

?>
