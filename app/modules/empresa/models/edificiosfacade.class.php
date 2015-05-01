<?php

class Modules_Empresa_Model_Edificiosfacade implements Moon2_Interfaces_MandatoryModel {

    private $_objdb;

    public function __construct() {
        $this->_objdb = new Modules_Empresa_ModelDb_Edificiosdb();
    }

    public function add($obj) {
        return $this->_objdb->add($obj);
    }

    public function add_searchField($key, $field) {
        return $this->_objdb->add_searchField($key, $field);
    }

    public function delete($obj) {
        return $this->_objdb->delete($obj);
    }

    public function loadOne($Obj) {
        return $this->_objdb->loadOne($Obj);
    }

    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_objdb->load_all($rsNumRows, $limit_numrows, $page, $Data);
    }
    
    public function load_all_Join(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
        return $this->_objdb->load_all_Join($rsNumRows, $limit_numrows, $page, $Data);
    }

    public function update($obj) {
        return $this->_objdb->update($obj);
    }

    public function combo() {
        return $this->_objdb->combo();
    }

    public function agregarRel_EdifOf($codedificio, $coddependencia) {
        return $this->_objdb->agregarRel_EdifOf($codedificio, $coddependencia);
    }
public function eliminarRel_na($codedificio, $coddependencia) {
        return $this->_objdb->eliminarRel_na($codedificio, $coddependencia);
    }
}

?>
