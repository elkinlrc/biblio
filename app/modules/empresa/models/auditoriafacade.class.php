<?php

class Modules_Empresa_Model_AuditoriaFacade implements Moon2_Interfaces_MandatoryModel {
    
    private $_objdb;
    
    public function __construct() {
        $this->_objdb = new Modules_Empresa_ModelDb_Auditoriadb();
    }

    public function add($obj) {
          return $this->_objdb->add($obj);
    }


    public function add_searchField($key, $field) {
        
    }


    public function delete($obj) {
       
    }


    public function loadOne($Obj) {
        return $this->_objdb->loadOne($Obj);
    }


    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data = array()) {
         return $this->_objdb->load_all($rsNumRows, $limit_numrows, $page, $Data);

    }


    public function update($obj) {
       
    }
    
//    public function combo(){
//        return $this->_objdb->combo();
//    }
    
}

?>
