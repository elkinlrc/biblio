<?php

class Modules_Empresa_ModelDb_Edificiosdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "edificios";
        $this->_Pkey["key"] = "codedificio";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function combo() {
        $sql = "SELECT e.codedificio, e.edificio FROM edificios e ";
        $arreglo = $this->GetAssoc($sql);
        return $arreglo;
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $from = "FROM edificios e ";
        $from.=" inner join sedes s on s.codsede=e.codsede";
        
        $where = $this->get_where($Data["busqueda"]);
        $order = " ";

        $order = "";

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;
        
         $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT e.codedificio,s.codsede,s.sede,e.edificio,s.direccion ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;
        
        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);


        return $arreglo;
    }
    
    
      public function load_all_Join(&$rsNumRows, $limit_numrows, $page, $Data) {
        $from = "FROM rel_ofiedif ro ";
        $join = " inner join edificios e on ro.codedificio=e.codedificio ";
        $join = $join . " inner join oficinas o on o.coddependencia=ro.coddependencia ";
        $where ="";// $this->get_where($Data["busqueda"]);
        
 if (isset($Data["busqueda"][1])){
            if($Data["busqueda"][2]!==""){
                $dato=strtolower($Data["busqueda"][1]);
                $where=" where  lower(e.edificio) like '%$dato%' ";
            }
        }
        if (isset($Data["busqueda"][2])){
            if($Data["busqueda"][2]!==""){
                $dato=strtolower($Data["busqueda"][2]);
            
                $where=" where lower(o.oficina) like '%$dato%'  ";
            }
        }
        
        
        $order = " ";
        $order = " ";

        $order = " ";

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;

        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT o.coddependencia,e.codedificio,e.edificio,o.oficina ";
        $sql_registros.=$from;
        $sql_registros.=$join;
        $sql_registros.=$where;
        $sql_registros.=$order;

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);
      //  exit();
        return $arreglo;
    }
    

    public function agregarRel_EdifOf($codedificio, $coddependencia)  {
        $sql = "INSERT INTO rel_ofiedif(codedificio,coddependencia) values (?,?)";
        $parametros = array($codedificio, $coddependencia);
        return $this->ExecuteSql($sql, $parametros);
    }
    
    public function eliminarRel_na($codedificio, $coddependencia) {
        $sql = "delete from rel_ofiedif where codedificio=? and coddependencia=? ";
        $parametros = array($codedificio, $coddependencia);
        return $this->ExecuteSql($sql, $parametros);
    }

}

?>
