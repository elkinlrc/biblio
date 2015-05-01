<?php
class Modules_Krauff_Model_AccesosFacade implements Moon2_Interfaces_MandatoryModel {
    private $_accessDB;

public function __construct() {
    $this->_accessDB = new Modules_Krauff_ModelDb_AccesosDb();
}

// START: Mandatory methods
public function add($obj){
    return $this->_accessDB->add($obj);
}

public function update($obj){
    return $this->_accessDB->update($obj);
}
public function delete($obj){
    return $this->_accessDB->delete($obj);
}
public function loadOne($obj){
    return $this->_accessDB->loadOne($obj);
}

public function add_searchField($key, $field){
    return $this->_accessDB->add_searchField($key, $field);
}
public function load_all(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_accessDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
}
// END: Mandatory methods


// START: User-defined methods
//*
//* Here you should place your class methods
//*
// END: User-defined methods
}//End class
?>