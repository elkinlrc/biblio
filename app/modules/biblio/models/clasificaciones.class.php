<?php

class Modules_Biblio_Model_Clasificaciones {

    private $_codclasificacion;
    private $_nombre;

    function __construct() {
        
    }

    function get_codclasificacion() {
        return $this->_codclasificacion;
    }

    function set_codclasificacion($_codclasificacion) {
        $this->_codclasificacion = $_codclasificacion;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

