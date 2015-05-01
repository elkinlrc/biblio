<?php

class Modules_Empresa_Model_Sedes {

    private $_codsede;
    private $_sede;
    private $_direccion;

    public function __construct() {
        
    }
    function get_codsede() {
        return $this->_codsede;
    }

    function get_sede() {
        return $this->_sede;
    }

    function get_direccion() {
        return $this->_direccion;
    }

    function set_codsede($_codsede) {
        $this->_codsede = $_codsede;
    }

    function set_sede($_sede) {
        $this->_sede = $_sede;
    }

    function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }


}

?>
