<?php

class Modules_Biblio_Model_Autores{
    
    private $_codautor;
    private $_nombre;
    
    function __construct() {
    }
    
    function get_codautor() {
        return $this->_codautor;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function set_codautor($_codautor) {
        $this->_codautor = $_codautor;
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

