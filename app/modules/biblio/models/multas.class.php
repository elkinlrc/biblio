<?php

class Modules_Biblio_Model_Autores{
    
    private $_codmulta;
    private $_codprestamo;
    private $_valor;
    
    function __construct() {
    }
    
    function get_codmulta() {
        return $this->_codmulta;
    }

    function get_codprestamo() {
        return $this->_codprestamo;
    }

    function get_valor() {
        return $this->_valor;
    }

    function set_codmulta($_codmulta) {
        $this->_codmulta = $_codmulta;
    }

    function set_codprestamo($_codprestamo) {
        $this->_codprestamo = $_codprestamo;
    }

    function set_valor($_valor) {
        $this->_valor = $_valor;
    }




}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

