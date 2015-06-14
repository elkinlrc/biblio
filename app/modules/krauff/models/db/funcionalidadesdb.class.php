<?php
class Modules_Krauff_ModelDb_FuncionalidadesDb extends Moon2_DBmanager_PDO{

public function __construct(){
    parent::__construct();
    $this->_Pkey["value"] = 0;
    $this->_table = "funcionalidades";
    $this->_Pkey["key"] = "codfunc";
    $this->_sequence = $this->_table."_".$this->_Pkey["key"]."_seq";
}

public function obtener_nodo($indicednode, &$seleccionados){
    $params = array($indicednode);
    $sql = "SELECT f.codfunc, f.codpadre, f.nombre, f.identificador, f.orden, f.urlpagina, f.target, f.icono, f.tipo, ";
    $sql.= "(SELECT count(codfunc) FROM funcionalidades WHERE codpadre = f.codfunc) as cant ";
    $sql.= "FROM {$this->_table} f WHERE codpadre = ? ";
    $sql.= "ORDER BY f.orden";

    $indice=0;
    $arrData = array();
    $arr = $this->GetAssoc($sql, $params);
    foreach($arr as $cod_func => $campo){
        $hijos = $campo["cant"];
        $arrData[$indice]["title"] = $campo["nombre"];
        $arrData[$indice]["key"] = $cod_func;
        $keys = array_values($seleccionados);
        if (in_array($cod_func, $keys)){
            $arrData[$indice]["select"] = true;
        }
        if ($hijos > 0){
            $arrData[$indice]["isFolder"] = TRUE;
            $arrData[$indice]["children"] = $this->obtener_nodo($cod_func, $seleccionados);
        }
        $indice++;
    }
    return $arrData;
}

public function actualizar_padre($cod_func, $cod_padre){
    $pamametros = array($cod_padre, $cod_func);
    $sql = "UPDATE funcionalidades SET codpadre = ? WHERE codfunc = ?";
    $result = $this->ExecuteSql($sql, $pamametros);
    return $result;
}

public function obtener_nodo_simple($cod_padre){
    $pamametros = array($cod_padre);
    $sql = "SELECT codfunc,nombre FROM funcionalidades WHERE codpadre = ? order BY orden";
    $arr = $this->GetAll($sql, $pamametros);
    return $arr;
}

public function ordenar_nodo_simple($arreglo){
    $this->_conexion->beginTransaction();
    foreach ($arreglo as $indice => $campo){
        $pamametros = array($indice, $campo["codfunc"]);
        $sql = "UPDATE funcionalidades set orden = ? WHERE codfunc = ?";
        $result = $this->ExecuteSql($sql, $pamametros);
        if ($result == false){
            $this->_conexion->rollBack();
            return false;
        }
    }
    $result = $this->_conexion->commit();
    return $result;
    
}

public function eliminar_funcionalida($codusuario,$codfuncionalida){
    $pamametros = array($codusuario,$codfuncionalida);
    $sql = "DELETE FROM rel_funcusuarios WHERE codusuario = ? AND codfunc = ?";
    $arr = $this->ExecuteSql($sql, $pamametros);
    return $arr;
}

public function insertar_funcionalida($codusuario,$codfuncionalida){
    $pamametros = array($codusuario,$codfuncionalida);
    $sql = "INSERT INTO rel_funcusuarios(codusuario, codfunc) ";
    $sql.= "values (?,?)";
    $arr = $this->ExecuteSql($sql, $pamametros);
    return $arr;
}





}//End class
?>