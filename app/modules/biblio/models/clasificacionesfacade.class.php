<?php

class Modules_Biblio_Model_ClasificacionesFacade implements Moon2_Interfaces_MandatoryModel{
    
    private $_objdb;
    
    public function __construct() {
        $this->_objdb= new Modules_Biblio_ModelDb_Clasificacionesdb();
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

    public function update($obj) {
        return $this->_objdb->update($obj);
    }

}


