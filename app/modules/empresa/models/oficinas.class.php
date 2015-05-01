<?php

class Modules_Empresa_Model_Oficinas {
    private $_coddependencia;
    private $_oficina;
    
    public function __construct() {
        
    }
    public function get_coddependencia() {
        return $this->_coddependencia;
    }

    public function get_oficina() {
        return $this->_oficina;
    }

    public function set_coddependencia($_coddependencia) {
        $this->_coddependencia = $_coddependencia;
    }

    public function set_oficina($_oficina) {
        $this->_oficina = $_oficina;
    }


}

?>
