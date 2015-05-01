<?php

class Modules_Empresa_Model_Edificios {
    private $_codedificio;
    private $_codsede;
    private $_edificio;
    
    public function __construct() {
        
    }
    
    public function get_codedificio() {
        return $this->_codedificio;
    }

    public function get_codsede() {
        return $this->_codsede;
    }

    public function get_edificio() {
        return $this->_edificio;
    }

    public function set_codedificio($_codedificio) {
        $this->_codedificio = $_codedificio;
    }

    public function set_codsede($_codsede) {
        $this->_codsede = $_codsede;
    }

    public function set_edificio($_edificio) {
        $this->_edificio = $_edificio;
    }
}

?>
