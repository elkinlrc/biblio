<?php

class Modules_Biblio_Model_Colecciones{
    
    private $_codcoleccion;
    private $_coleccion;
    private $_diasmaxprestamo;
    private $_valormultadia;
    private $_maximarenovaciones;
    
    function __construct() {
    }
    
    function get_codcoleccion() {
        return $this->_codcoleccion;
    }

    function get_coleccion() {
        return $this->_coleccion;
    }

    function get_diasmaxprestamo() {
        return $this->_diasmaxprestamo;
    }

    function get_valormultadia() {
        return $this->_valormultadia;
    }

    function set_codcoleccion($_codcoleccion) {
        $this->_codcoleccion = $_codcoleccion;
    }

    function set_coleccion($_coleccion) {
        $this->_coleccion = $_coleccion;
    }

    function set_diasmaxprestamo($_diasmaxprestamo) {
        $this->_diasmaxprestamo = $_diasmaxprestamo;
    }

    function set_valormultadia($_valormultadia) {
        $this->_valormultadia = $_valormultadia;
    }


    function get_maximarenovaciones() {
        return $this->_maximarenovaciones;
    }

    function set_maximarenovaciones($_maximarenovaciones) {
        $this->_maximarenovaciones = $_maximarenovaciones;
    }




}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

