<?php

class Modules_Empresa_Model_Usuarios{

private $_codusuario;
private $_codperfil;
private $_coddependencia;
private $_nombres;
private $_primerapellido;
private $_segundoapellido;
private $_genero;


public function __construct() {
}
function get_codusuario() {
    return $this->_codusuario;
}

function get_codperfil() {
    return $this->_codperfil;
}

function get_coddependencia() {
    return $this->_coddependencia;
}

function get_nombres() {
    return $this->_nombres;
}

function get_primerapellido() {
    return $this->_primerapellido;
}

function get_segundoapellido() {
    return $this->_segundoapellido;
}

function get_genero() {
    return $this->_genero;
}

function set_codusuario($_codusuario) {
    $this->_codusuario = $_codusuario;
}

function set_codperfil($_codperfil) {
    $this->_codperfil = $_codperfil;
}

function set_coddependencia($_coddependencia) {
    $this->_coddependencia = $_coddependencia;
}

function set_nombres($_nombres) {
    $this->_nombres = $_nombres;
}

function set_primerapellido($_primerapellido) {
    $this->_primerapellido = $_primerapellido;
}

function set_segundoapellido($_segundoapellido) {
    $this->_segundoapellido = $_segundoapellido;
}

function set_genero($_genero) {
    $this->_genero = $_genero;
}






}
?>
