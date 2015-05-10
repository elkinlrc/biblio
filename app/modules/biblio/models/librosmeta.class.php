<?php

class Modules_Biblio_Model_Librosmeta{
    
    private $_codlibrosmeta;
    private $_etiqueta;
    private $_valor;
    private $_codlibro;
    
    
    function __construct() {
    }
    function get_codlibrosmeta() {
        return $this->_codlibrosmeta;
    }

    function get_etiqueta() {
        return $this->_etiqueta;
    }

    function get_valor() {
        return $this->_valor;
    }

    function get_codlibro() {
        return $this->_codlibro;
    }

    function set_codlibrosmeta($_codlibrosmeta) {
        $this->_codlibrosmeta = $_codlibrosmeta;
    }

    function set_etiqueta($_etiqueta) {
        $this->_etiqueta = $_etiqueta;
    }

    function set_valor($_valor) {
        $this->_valor = $_valor;
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

