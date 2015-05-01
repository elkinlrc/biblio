<?php

class Modules_Empresa_Model_Nacionalidad {

    private $_codnacionalidad;
    private $_nacionalidad;

    public function __construct() {
        
    }
    function get_codnacionalidad() {
        return $this->_codnacionalidad;
    }

    function get_nacionalidad() {
        return $this->_nacionalidad;
    }

    function set_codnacionalidad($_codnacionalidad) {
        $this->_codnacionalidad = $_codnacionalidad;
    }

    function set_nacionalidad($_nacionalidad) {
        $this->_nacionalidad = $_nacionalidad;
    }


}

?>
