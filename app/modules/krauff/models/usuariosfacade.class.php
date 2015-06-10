<?php
class Modules_Krauff_Model_UsuariosFacade implements Moon2_Interfaces_MandatoryModel {
    private $_userDB;

public function __construct() {
    $this->_userDB = new Modules_Krauff_ModelDb_usuariosdb();
}

// START: Mandatory methods
public function add($obj){
    return $this->_userDB->add($obj);
}

public function update($obj){
    return $this->_userDB->update($obj);
}
public function delete($obj){
    return $this->_userDB->delete($obj);
}
public function loadOne($obj){
    return $this->_userDB->loadOne($obj);
}

public function add_searchField($key, $field){
    return $this->_userDB->add_searchField($key, $field);
}
public function load_all(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_userDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
}

public function load_all_admin(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_userDB->load_all_admin($rsNumRows, $limit_numrows, $page, $Data);
}

public function load_all_meseros(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_userDB->load_all_meseros($rsNumRows, $limit_numrows, $page, $Data);
}

public function load_all_clientes(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_userDB->load_all_clientes($rsNumRows, $limit_numrows, $page, $Data);
}
public function load_all_clientes2(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_userDB->load_all_clientes2($rsNumRows, $limit_numrows, $page, $Data);
}
// END: Mandatory methods


// START: User-defined methods
public function validate($user, $pass){
    return $this->_userDB->validate($user, $pass);
}

public function get_functionalities($id, $parentId){
    return $this->_userDB->get_functionalities($id, $parentId);
}

public function combousuarios(){
    return $this->_userDB->combousuarios();
}

public function asignarfuncionalidades($codusuario){
    return $this->_userDB->asignarfuncionalidades($codusuario);
}

public function combomeseros(){
    return $this->_userDB->combomeseros();
}

public function combomeseros2(){
    return $this->_userDB->combomeseros2();
}


// END: User-defined methods

}//End class
?>