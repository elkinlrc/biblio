<?php

class Modules_Empresa_Model_Auditoria {
    private $_codauditoria;
    private $_nombretabla;
    private $_tipooperacion;
    private $_codregistro;
    
    function __construct() {
       
    }
    
    
    function get_codauditoria() {
        return $this->_codauditoria;
    }

    function get_nombretabla() {
        return $this->_nombretabla;
    }

    function get_tipooperacion() {
        return $this->_tipooperacion;
    }

    function get_codregistro() {
        return $this->_codregistro;
    }

    function set_codauditoria($_codauditoria) {
        $this->_codauditoria = $_codauditoria;
    }

    function set_nombretabla($_nombretabla) {
        $this->_nombretabla = $_nombretabla;
    }

    function set_tipooperacion($_tipooperacion) {
        $this->_tipooperacion = $_tipooperacion;
    }

    function set_codregistro($_codregistro) {
        $this->_codregistro = $_codregistro;
    }



 
    
}



?>