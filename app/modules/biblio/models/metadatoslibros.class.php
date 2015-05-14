<?php

class Modules_Biblio_Model_MetadatosLibros{
   
    private $_codmetadatolibro;
    private $_codlibro;
    private $_codmetadato;
    private $_valor;   
    
    
    function __construct() {
        
    }
    function get_codlibro() {
        return $this->_codlibro;
    }

    function get_codmetadato() {
        return $this->_codmetadato;
    }

    function get_valor() {
        return $this->_valor;
    }

    function set_codlibro($_codlibro) {
        $this->_codlibro = $_codlibro;
    }

    function set_codmetadato($_codmetadato) {
        $this->_codmetadato = $_codmetadato;
    }

    function set_valor($_valor) {
        $this->_valor = $_valor;
    }


    function get_codmetadatolibro() {
        return $this->_codmetadatolibro;
    }

    function set_codmetadatolibro($_codmetadatolibro) {
        $this->_codmetadatolibro = $_codmetadatolibro;
    }






}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

