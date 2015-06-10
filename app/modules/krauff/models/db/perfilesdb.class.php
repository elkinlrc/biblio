<?php

class Modules_Krauff_ModelDb_PerfilesDb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_Pkey["value"] = 0;
        $this->_table = "perfiles";
        $this->_Pkey["key"] = "codperfil";
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} p";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM perfiles ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($combo_campos) && empty($caja_busqueda)) {
            $sql = "SELECT p.codperfil, p.nombreperfil ";
            $sql.= "FROM perfiles p ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codperfil") {
                $sql = "SELECT p.codperfil, p.nombreperfil ";
                $sql.= "FROM perfiles p ";
                $sql.= "WHERE {$combo_campos} = '{$caja_busqueda}' ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT p.codperfil, p.nombreperfil ";
                $sql.= "FROM perfiles p ";
                $sql.= "WHERE {$combo_campos} ilike '%{$caja_busqueda}%' ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }

            return $arr;
        }
    }

    public function comboperfiles() {
        $sql = "SELECT codperfil, nombreperfil ";
        $sql.= "FROM perfiles ";
        $sql.= "WHERE codperfil IN(1,2)";
        $funcArray = $this->GetAssoc($sql);
        return $funcArray;
    }

}

//End class
?>