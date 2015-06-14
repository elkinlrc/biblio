<?php

class Modules_Biblio_Model_Autores{
    
 
    private $_codprestamo;
    private $_fechaprestamo;
    private $_codusuario;
    private $_coddetalle;
    private $_fechavencimiento;
    private $_fechaentrega;
    
    
    function __construct() {
    }
 
    function get_codprestamo() {
        return $this->_codprestamo;
    }

    function get_fechaprestamo() {
        return $this->_fechaprestamo;
    }

    function get_codusuario() {
        return $this->_codusuario;
    }

    function get_coddetalle() {
        return $this->_coddetalle;
    }

    function get_fechavencimiento() {
        return $this->_fechavencimiento;
    }

    function get_fechaentrega() {
        return $this->_fechaentrega;
    }

    function set_codprestamo($_codprestamo) {
        $this->_codprestamo = $_codprestamo;
    }

    function set_fechaprestamo($_fechaprestamo) {
        $this->_fechaprestamo = $_fechaprestamo;
    }

    function set_codusuario($_codusuario) {
        $this->_codusuario = $_codusuario;
    }

    function set_coddetalle($_coddetalle) {
        $this->_coddetalle = $_coddetalle;
    }

    function set_fechavencimiento($_fechavencimiento) {
        $this->_fechavencimiento = $_fechavencimiento;
    }

    function set_fechaentrega($_fechaentrega) {
        $this->_fechaentrega = $_fechaentrega;
    }





}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

