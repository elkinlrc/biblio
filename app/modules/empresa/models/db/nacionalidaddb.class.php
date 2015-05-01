<?php

class Modules_Empresa_ModelDb_Nacionalidaddb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "nacionalidades ";
        $this->_Pkey["key"] = "codnacionalidad";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    public function combo() {
        $sql = "SELECT n.codnacionalidad ,n.nacionalidad FROM nacionalidades n ";
        $arreglo = $this->GetAssoc($sql);
        return $arreglo;
    }
    public function find($id){
        $sql="select * from nacionalidades where codnacionalidad=?";
        $arreglo=$this->SelectLimit($sql);
        return $arreglo;
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        $from = "FROM nacionalidades n ";
        $join = " ";
        $where = $this->get_where($Data["busqueda"]);
        $order = " ";
        $order = " ";

        $order = " ";

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;

        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT n.codnacionalidad,n.nacionalidad ";
        $sql_registros.=$from;
        $sql_registros.=$join;
        $sql_registros.=$where;
        $sql_registros.=$order;

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);


        return $arreglo;
    }

    public function load_all_Join(&$rsNumRows, $limit_numrows, $page, $Data) {
        $from = "FROM rel_usunacionalidad ns ";
        $join = " inner join usuarios u on ns.codusuario=u.codusuario ";
        $join = $join . " inner join nacionalidades n on n.codnacionalidad=ns.codnacionalidad ";
        $where ="";// $this->get_where($Data["busqueda"]);
        
        if (isset($Data["busqueda"][1])){
            if($Data["busqueda"][2]!==""){
                $dato=strtolower($Data["busqueda"][1]);
                $where=" where  lower(n.nacionalidad) like '%$dato%' ";
            }
        }
        if (isset($Data["busqueda"][2])){
            if($Data["busqueda"][2]!==""){
                $dato=strtolower($Data["busqueda"][2]);
            
                $where=" where lower(u.nombres) like '%$dato%'  ";
            }
        }
        
        
        
        $order = " ";
        $order = " ";

        $order = " ";

        $sql_num = "SELECT COUNT(*) ";
        $sql_num.= $from;
        $sql_num.= $where;

        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT n.nacionalidad,u.nombres,n.codnacionalidad,u.codusuario ";
        $sql_registros.=$from;
        $sql_registros.=$join;
        $sql_registros.=$where;
        $sql_registros.=$order;

        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);
      //  exit();
        return $arreglo;
    }

    public function agregarRel_UsuNa($codnacionalidad, $codusuario) {
        $sql = "INSERT INTO rel_usunacionalidad(codnacionalidad,codusuario) values (?,?)";
        $parametros = array($codnacionalidad, $codusuario);
        return $this->ExecuteSql($sql, $parametros);
    }

//    public function ListarRel_UsuNa($codnacionalidad, $codusuario) {
//      
//        $sql = "SELECT * FROM nacionalidades ,[codnacionalidad,codusuario]";
//        $parametros = array($codnacionalidad, $codusuario);
//        return $this->ExecuteSql($sql, $parametros);
//        
//    }
    
    public function eliminarRel_UsuNa($codnacionalidad, $codusuario) {
        $sql = "delete from rel_usunacionalidad where codnacionalidad=? and codusuario=? ";
        $parametros = array($codnacionalidad, $codusuario);
        return $this->ExecuteSql($sql, $parametros);
    }
    
    
}

?>
