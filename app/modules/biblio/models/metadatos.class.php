<?php

class Modules_Biblio_Model_Metadatos{
   
    private $_codmetadato;
    private $_etiqueta;
    private $_minimo;
    private $_maximo;
    private $_requerido;
    
    
    function __construct() {
        
    }
    function get_codmetadato() {
        return $this->_codmetadato;
    }

    function get_etiqueta() {
        return $this->_etiqueta;
    }

    function set_codmetadato($_codmetadato) {
        $this->_codmetadato = $_codmetadato;
    }

    function set_etiqueta($_etiqueta) {
        $this->_etiqueta = $_etiqueta;
    }

    function get_minimo() {
        return $this->_minimo;
    }

    function get_maximo() {
        return $this->_maximo;
    }

    function set_minimo($_minimo) {
        $this->_minimo = $_minimo;
    }

    function set_maximo($_maximo) {
        $this->_maximo = $_maximo;
    }

    function get_requerido() {
        return $this->_requerido;
    }

    function set_requerido($_requerido) {
        $this->_requerido = $_requerido;
    }





}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

