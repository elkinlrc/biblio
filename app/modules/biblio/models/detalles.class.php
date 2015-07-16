<?php

class Modules_Biblio_Model_Detalles{
    
    private $_coddetalle;
    private $_codigobarras;
    private $_codlibro;
    private $_fechacreacion;
    private $_edicion;
    private $_codsede;
    private $_codadquisicion;
    private $_precio;
            
    
    function __construct() {
    }
    

    function get_coddetalle() {
        return $this->_coddetalle;
    }

    function get_codigobarras() {
        return $this->_codigobarras;
    }

    function get_codlibro() {
        return $this->_codlibro;
    }

    function get_fechacreacion() {
        //$this->_fechacreacion=;
        return $this->_fechacreacion;
    }

    function get_edicion() {
        return $this->_edicion;
    }

    function get_codsede() {
        return $this->_codsede;
    }

    function set_coddetalle($_coddetalle) {
        $this->_coddetalle = $_coddetalle;
    }

    function set_codigobarras($_codigobarras) {
        $this->_codigobarras = $_codigobarras;
    }

    function set_codlibro($_codlibro) {
        $this->_codlibro = $_codlibro;
    }

    function set_fechacreacion($_fechacreacion) {
        $this->_fechacreacion = $_fechacreacion;
    }

    function set_edicion($_edicion) {
        $this->_edicion = $_edicion;
    }

    function set_codsede($_codsede) {
        $this->_codsede = $_codsede;
    }

    function get_codadquisicion() {
        return $this->_codadquisicion;
    }

    function get_precio() {
        return $this->_precio;
    }

    function set_codadquisicion($_codadquisicion) {
        $this->_codadquisicion = $_codadquisicion;
    }

    function set_precio($_precio) {
        $this->_precio = $_precio;
    }



}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

