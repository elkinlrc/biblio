<?php

class Modules_Biblio_Model_Autoreslibros{
    
    private $_codautoreslibros;
    private $_codautor;
    private $_codlibro;
    
    function __construct() {
    }
  
    function get_codautoreslibros() {
        return $this->_codautoreslibros;
    }

    function get_codautor() {
        return $this->_codautor;
    }

    function get_codlibro() {
        return $this->_codlibro;
    }

    function set_codautoreslibros($_codautoreslibros) {
        $this->_codautoreslibros = $_codautoreslibros;
    }

    function set_codautor($_codautor) {
        $this->_codautor = $_codautor;
    }

    function set_codlibro($_codlibro) {
        $this->_codlibro = $_codlibro;
    }



}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

