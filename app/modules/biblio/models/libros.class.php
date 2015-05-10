<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of libros
 *
 * @author elkinlrc
 */
class  Modules_Biblio_Model_Libros {
    
    private $_codlibro;
    private $_titulo;
    private $_subtitulo;
    private $_codclasificacion;
    private $_formato;
    
    
    
    function __construct() {
        
    }
    
    function get_codlibro() {
        return $this->_codlibro;
    }

    function get_titulo() {
        return $this->_titulo;
    }

    function get_subtitulo() {
        return $this->_subtitulo;
    }

    function get_codclasificacion() {
        return $this->_codclasificacion;
    }

    function get_formato() {
        return $this->_formato;
    }

    function set_codlibro($_codlibro) {
        $this->_codlibro = $_codlibro;
    }

    function set_titulo($_titulo) {
        $this->_titulo = $_titulo;
    }

    function set_subtitulo($_subtitulo) {
        $this->_subtitulo = $_subtitulo;
    }

    function set_codclasificacion($_codclasificacion) {
        $this->_codclasificacion = $_codclasificacion;
    }

    function set_formato($_formato) {
        $this->_formato = $_formato;
    }


    

}
