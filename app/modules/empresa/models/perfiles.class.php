<?php

class Modules_Empresa_Model_Perfiles {

    private $_codperfil;
    private $_perfil;

    public function __construct() {
        
    }

    function get_codperfil() {
        return $this->_codperfil;
    }

    function get_perfil() {
        return $this->_perfil;
    }

    function set_codperfil($_codperfil) {
        $this->_codperfil = $_codperfil;
    }

    function set_perfil($_perfil) {
        $this->_perfil = $_perfil;
    }

}

?>
