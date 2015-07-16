<?php

class Modules_Biblio_Model_Adquisiciones{
    
    private $_codadquisicion;
    private $_nombre;
    
    function __construct() {
    }
    
    function get_codadquisicion() {
        return $this->_codadquisicion;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function set_codadquisicion($_codadquisicion) {
        $this->_codadquisicion = $_codadquisicion;
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

