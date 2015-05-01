<?php
class Modules_Krauff_Model_PerfilesFacade implements Moon2_Interfaces_MandatoryModel {
    private $_perfilesDB;

public function __construct() {
    $this->_perfilesDB = new Modules_Krauff_ModelDb_PerfilesDb();
}

// START: Mandatory methods
public function add($obj){
    return $this->_perfilesDB->add($obj);
}

public function update($obj){
    return $this->_perfilesDB->update($obj);
}
public function delete($obj){
    return $this->_perfilesDB->delete($obj);
}
public function loadOne($obj){
    return $this->_perfilesDB->loadOne($obj);
}

public function add_searchField($key, $field){
    return $this->_perfilesDB->add_searchField($key, $field);
}

public function load_all(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_perfilesDB->load_all($rsNumRows, $limit_numrows, $page, $Data);
}

public function load_all2(&$rsNumRows, $limit_numrows, $page, $Data=array()){
    return $this->_perfilesDB->load_all2($rsNumRows, $limit_numrows, $page, $Data);
}
// END: Mandatory methods


// START: User-defined methods
public function comboperfiles(){
    return $this->_perfilesDB->comboperfiles();
}

public function combotablas(){
    return $this->_perfilesDB->combotablas();
}
// END: User-defined methods

}//End class
?>