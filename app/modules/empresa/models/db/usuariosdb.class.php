<?php

class Modules_Empresa_ModelDb_Usuariosdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "usuarios";
        $this->_Pkey["key"] = "codusuario";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function combo() {
        $sql = "SELECT u.codusuario,u.nombres FROM usuarios u ";
        $arreglo = $this->GetAssoc($sql);
        return $arreglo;
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $from = "FROM usuarios u ";
        $from.= "inner join perfiles p on p.codperfil=u.codperfil join oficinas o on o.coddependencia=u.coddependencia";
        
        $where = $this->get_where($Data["busqueda"]);
        $order = " ";

        $order = " ";

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;
        
         $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT u.codusuario,p.perfil,o.oficina,u.codperfil,u.coddependencia,u.nombres,u.primerapellido,u.segundoapellido,u.genero ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;
        
        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);


        return $arreglo;
    }


}

?>
