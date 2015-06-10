<?php

class Modules_Biblio_Model_Sedes{
    
    private $_codsede;
    private $_nombre;
    private $_direccion;
    
    function __construct() {
    }
    
    function get_codsede() {
        return $this->_codsede;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function set_codsede($_codsede) {
        $this->_codsede = $_codsede;
    }

    function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }
    
    function get_direccion() {
        return $this->_direccion;
    }

    function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }





}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

