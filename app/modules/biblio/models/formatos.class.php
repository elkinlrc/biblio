<?php

class Modules_Biblio_Model_Formatos{
    
    private $_codformato;
    private $_nombre;
    private $_descripcion;
    
    function __construct() {
    }
    
    function get_codformato() {
        return $this->_codformato;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function get_descripcion() {
        return $this->_descripcion;
    }

    function set_codformato($_codformato) {
        $this->_codformato = $_codformato;
    }

    function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }





}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

