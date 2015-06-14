<?php

class Modules_Krauff_ModelDb_usuariosdb extends Moon2_DBmanager_PDO {

    public function __construct() {
        parent::__construct();
        $this->_table = "usuarios";
        $this->_Pkey["key"] = "codusuario";
        $this->_Pkey["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey['key'] . "_seq";
    }

    public function validate($user, $pass) {
        $parameters = array($user, $pass);
        $sql = "SELECT u.codusuario, u.codperfil, u.nombreusuario, (u.nombres) as nombrecompleto, p.nombreperfil ";
        $sql.="FROM {$this->_table} u INNER JOIN perfiles p ON u.codperfil = p.codperfil ";
        $sql.="WHERE u.nombreusuario=? AND u.clave=? ";
        $row = $this->GetRow($sql, $parameters);

        if (!empty($row)) {
            $key_user = $row["codusuario"] . "@" . $user . "@" . $row["nombrecompleto"] . "@" . $row["nombreperfil"] . "@" . $row["codperfil"] . "@" . $row["codcolegio"] . "@" . $row["regimen"];
            return $key_user;
        }
        return false;
    }

    public function get_functionalities($id, $parentId) {
        $sql = "WITH RECURSIVE arbolFunc AS ";
        $sql.= "(";
        $sql.= "  (SELECT f1.*,(select count(*) FROM funcionalidades WHERE codpadre=f1.codfunc) as hijos FROM funcionalidades f1 ";
        $sql.= "  WHERE f1.codfunc in (SELECT codfunc FROM rel_funcusuarios WHERE codusuario = ?) AND f1.codpadre = ?) ";
        $sql.= "  UNION ALL ";
        $sql.= "    SELECT f.*,(select count(*) FROM funcionalidades WHERE codpadre=f.codfunc) as hijos FROM funcionalidades AS f, arbolFunc AS aF ";
        $sql.= "    WHERE aF.codfunc = f.codpadre ";
        $sql.= ")";
        $sql.= "SELECT * FROM arbolFunc order BY orden;";
        $allFunc = $this->GetAll($sql, array($id, $parentId));

        $UserfuncArray = $this->user_Functionalities($id);

        $finalArray = array();
        foreach ($allFunc as $key => $vector) {
            if (array_key_exists($vector["codfunc"], $UserfuncArray)) {
                $finalArray[] = $vector;
            }
        }
        return $finalArray;
    }

    private function user_Functionalities($id) {
        $sql = "SELECT codfunc, codusuario FROm rel_funcusuarios WHERE codusuario = ?";
        $funcArray = $this->GetAssoc($sql, array($id));
        return $funcArray;
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} u";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM usuarios ";
        //$sql.="WHERE codcolegio = {$this->_DOM["COLEGIO_ID"]} ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($caja_campos) && empty($caja_busqueda)) {
            $sql = "SELECT p.nombreperfil, u.codusuario, u.genero, (u.nombres) AS nombres, u.tipodoc, u.documento, u.nombreusuario ";
            $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN  ";
            $sql.=" ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codusuario") {
                $sql = "SELECT p.nombreperfil, u.codusuario, u.genero, (u.nombres) AS nombres, u.tipodoc, u.documento, u.nombreusuario ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN colegios c ON u.codcolegio = c.codcolegio ";
                $sql.="WHERE   {$combo_campos} = '{$caja_busqueda}' and u.codperfil  ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT p.nombreperfil, u.codusuario, u.genero, (u.nombres) AS nombres, u.tipodoc, u.documento, u.nombreusuario ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil  ";
                $sql.="WHERE   {$combo_campos} ilike '%{$caja_busqueda}%'  ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }
            return $arr;
        }
    }
    
    
    public function load_all_tecnicos(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} u";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM usuarios ";
        $sql.="WHERE codempresa = {$this->_DOM["EMPRESA_ID"]} AND codperfil = 2 ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($caja_campos) && empty($caja_busqueda)) {
            $sql = "SELECT u.codusuario, (u.nombres) AS nombretecnico, u.tipodoc, u.documento, u.celular, u.direccion, u.telefono ";
            $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
            $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 2 ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codusuario") {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombretecnico, u.tipodoc, u.documento, u.celular, u.direccion, u.telefono ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} = '{$caja_busqueda}' and u.codperfil = 2 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombretecnico, u.tipodoc, u.documento, u.celular, u.direccion, u.telefono ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} ilike '%{$caja_busqueda}%' and u.codperfil = 2 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }
            return $arr;
        }
    }
    
    
    
      public function load_all_funcionarios(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} u";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM usuarios ";
        $sql.="WHERE codempresa = {$this->_DOM["EMPRESA_ID"]} and codperfil = 3 ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($caja_campos) && empty($caja_busqueda)) {
            $sql = "SELECT u.codusuario, (u.nombres) AS nombrefuncionario, u.documento, (d.nombre) As nombredependencia , (e.nombre) As nombreempresa ";
            $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa INNER JOIN dependencias d ON d.coddependencia = u.coddependencia ";
            $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 3 ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codusuario") {
                $sql ="SELECT u.codusuario, (u.nombres) AS nombrefuncionario, u.documento, (d.nombre) As nombredependencia , (e.nombre) As nombreempresa ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa INNER JOIN dependencias d ON d.coddependencia = u.coddependencia ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} = '{$caja_busqueda}' and u.codperfil = 3 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombrefuncionario, u.documento, (d.nombre) As nombredependencia , (e.nombre) As nombreempresa ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa INNER JOIN dependencias d ON d.coddependencia = u.coddependencia ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} ilike '%{$caja_busqueda}%' and u.codperfil = 3 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }
            return $arr;
        }
    }
    
    
    public function load_all_admin(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} u";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM usuarios ";
        $sql.="WHERE codcolegio = {$this->_DOM["COLEGIO_ID"]} ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($caja_campos) && empty($caja_busqueda)) {
            $sql = "SELECT p.nombreperfil, u.codusuario, u.genero, (u.nombres) AS nombres, u.tipodoc, u.documento, u.nombreusuario ";
            $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN colegios c ON u.codcolegio = c.codcolegio ";
            $sql.="WHERE c.codcolegio = {$this->_DOM["COLEGIO_ID"]} and u.codperfil not in (3, 4) ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codusuario") {
                $sql = "SELECT p.nombreperfil, u.codusuario, u.genero, (u.nombres) AS nombres, u.tipodoc, u.documento, u.nombreusuario ";
                 $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN colegios c ON u.codcolegio = c.codcolegio ";
                $sql.="WHERE c.codcolegio = {$this->_DOM["COLEGIO_ID"]} and {$combo_campos} = '{$caja_busqueda}' and u.codperfil not in (3, 4) ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT p.nombreperfil, u.codusuario, u.genero, (u.nombres) AS nombres, u.tipodoc, u.documento, u.nombreusuario ";
                 $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN colegios c ON u.codcolegio = c.codcolegio ";
                $sql.="WHERE c.codcolegio = {$this->_DOM["COLEGIO_ID"]} and {$combo_campos} ilike '%{$caja_busqueda}%' and u.codperfil not in (3, 4) ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }
            return $arr;
        }
    }
    
    public function load_all_meseros(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} u";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM usuarios ";
        $sql.="WHERE codempresa = {$this->_DOM["EMPRESA_ID"]} and codperfil = 1 ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($caja_campos) && empty($caja_busqueda)) {
            $sql = "SELECT u.codusuario, (u.nombres) AS nombremesero, u.documento, u.celular, u.direccion ";
            $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
            $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 3 ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codusuario") {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombremesero, u.documento, u.celular, u.direccion ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} = '{$caja_busqueda}' and u.codperfil = 3 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombremesero, u.documento, u.celular, u.direccion ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} ilike '%{$caja_busqueda}%' and u.codperfil = 3 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }
            return $arr;
        }
    }
    
    public function load_all_clientes(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} u";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM usuarios ";
        $sql.="WHERE codempresa = {$this->_DOM["EMPRESA_ID"]} and codperfil = 4 ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($caja_campos) && empty($caja_busqueda)) {
            $sql = "SELECT u.codusuario, (u.nombres) AS nombrecliente, u.documento, u.celular, u.direccion, u.tipodoc ";
            $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
            $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 4 and u.codusuario <> -2 ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codusuario") {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombrecliente, u.documento, u.celular, u.direccion, u.tipodoc ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} = '{$caja_busqueda}' and u.codperfil = 4 and u.codusuario <> -2 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombrecliente, u.documento, u.celular, u.direccion, u.tipodoc ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} ilike '%{$caja_busqueda}%' and u.codperfil = 4 and u.codusuario <> -2 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }
            return $arr;
        }
    }
    
    
    
      
    public function load_all_proveedores(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        $combo_campos = $Data["nomcampos"];
        $caja_busqueda = $Data["buscar"];
        $From = "FROM {$this->_table} u";
        $where = $this->get_where($Data["search"]);
        $order = " ORDER BY " . $Data["order"] . " ASC";

        $sql ="SELECT count(*) ";
        $sql.="FROM usuarios ";
        $sql.="WHERE codempresa = {$this->_DOM["EMPRESA_ID"]} and codperfil = 5 ";
        $rsNumRows = $this->GetOne($sql);

        if (empty($caja_campos) && empty($caja_busqueda)) {
            $sql = "SELECT u.codusuario, (u.nombres) AS nombreproveedor, u.documento, u.celular, u.direccion, u.documento, u.correo ,u.telefono ";
            $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
            $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 5  ";
            $sql.= $order;
            $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            return $arr;
        } else {
            if ($combo_campos == "codusuario") {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombreproveedor, u.documento, u.celular, u.direccion, u.documento, u.correo , u.telefono ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} = '{$caja_busqueda}' and u.codperfil = 5 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            } else {
                $sql = "SELECT u.codusuario, (u.nombres) AS nombreproveedor, u.documento, u.celular, u.direccion, u.documento ,u.correo, u.telefono ";
                $sql.="FROM usuarios u INNER JOIN perfiles p ON u.codperfil = p.codperfil INNER JOIN empresas e ON u.codempresa = e.codempresa ";
                $sql.="WHERE e.codempresa = {$this->_DOM["EMPRESA_ID"]} and {$combo_campos} ilike '%{$caja_busqueda}%' and u.codperfil = 5 ";
                $sql.= $order;
                $arr = $this->SelectLimit($sql, $limit_numrows, $page);
            }
            return $arr;
        }
    }
    
    
    
    
    public function combousuarios() {
        $sql = "SELECT u.codusuario, (u.nombres||' '||u.primerapellido||' '||u.segundoapellido) AS nombrecliente ";
        $sql.= "FROM usuarios u INNER JOIN empresas e ON u.codempresa = e.codempresa ";
        $sql.= "WHERE e.codempresa = -1 ";
        $funcArray = $this->GetAssoc($sql);
        return $funcArray;
    }
    
    public function combotablas() {
        $sql = "SELECT column_name as llave, column_name as valor ";
        $sql.="FROM information_schema.columns ";
        $sql.="WHERE table_name = 'usuarios' and column_name IN ( 'documento', 'nombres') ";
        $funcArray = $this->GetAssoc($sql);
        return $funcArray;
    }
    
    
     public function asignarfuncionalidades($codusuario) {
        $sql = "INSERT into rel_funcusuarios (codusuario, codfunc) select {$codusuario},codfunc FROM funcionalidades ";
        $funcArray = $this->ExecuteSql($sql);
        return $funcArray;
    }
    
    public function combomeseros() {
        $sql = "SELECT u.codusuario, (u.nombres) AS nombremeseros ";
        $sql.= "FROM usuarios u ";
        $sql.= "WHERE u.codempresa = {$this->_DOM["EMPRESA_ID"]} AND u.codperfil = '3' ";
        $funcArray = $this->GetAssoc($sql);
        return $funcArray;
    }
    
    public function combomeseros2() {
        $sql = "SELECT u.codusuario ";
        $sql.= "FROM usuarios u ";
        $sql.= "WHERE u.codempresa = {$this->_DOM["EMPRESA_ID"]} AND u.codperfil = '3' LIMIT 1 ";
        $funcArray = $this->GetOne($sql);
        return $funcArray;
    }
    
    
     public function combofuncionarios() {
        $sql = "SELECT u.codusuario, u.nombres AS nombrefuncionario ";
        $sql.= "FROM usuarios u ";
        $sql.= "WHERE u.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 3 ";
        $arrayfuncionarios = $this->GetAssoc($sql);
        return $arrayfuncionarios;
    } 
    
    
    public function combotecnicos() {
        $sql = "SELECT u.codusuario, u.nombres AS nombrefuncionario ";
        $sql.= "FROM usuarios u ";
        $sql.= "WHERE u.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 2 ";
        $arrayfuncionarios = $this->GetAssoc($sql);
        return $arrayfuncionarios;
    }
    
    
    public function comboproveedor() {
        $sql = "SELECT u.codusuario, u.nombres AS nombrefuncionario ";
        $sql.= "FROM usuarios u ";
        $sql.= "WHERE u.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 5 ";
        $arrayfuncionarios = $this->GetAssoc($sql);
        return $arrayfuncionarios;
    }
    
     public function validarpin($funcionario, $pin) {
        $parameters = array($funcionario, $pin);
        $sql = "SELECT u.codusuario, u.pinencriptado ";
        $sql.="FROM usuarios u ";
        $sql.="WHERE u.codusuario=? AND u.pinencriptado=? AND u.codempresa = {$this->_DOM["EMPRESA_ID"]} and u.codperfil = 3 ";
        $row = $this->GetRow($sql, $parameters);

        if (!empty($row)) {
            return true;
        }
        return false;
    }
}


//End class
?>
