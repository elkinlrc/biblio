<?php
class Modules_Krauff_Model_Funcionalidades {
    private $_codfunc;              //serial PRIMARY KEY
    private $_codpadre;             //integer
    private $_nombre;               //varchar(100) NOT NULL
    private $_identificador;        //varchar(30) NOT NULL
    private $_orden;                //integer NOT NULL
    private $_urlpagina;            //varchar(100)
    private $_target;               //varchar(50) NOT NULL DEFAULT '_parent'::character varying
    private $_icono;                //varchar(100)
    private $_tipo;                 //varchar(10) NOT NULL DEFAULT 'text'::character varying
    
public function __construct() {}

public function set_codfunc($value){$this->_codfunc = $value;}
public function set_codpadre($value){$this->_codpadre = $value;}
public function set_nombre($value){$this->_nombre = $value;}
public function set_identificador($value){$this->_identificador = $value;}
public function set_orden($value){$this->_orden = $value;}
public function set_urlpagina($value){$this->_urlpagina = $value;}
public function set_target($value){$this->_target = $value;}
public function set_icono($value){$this->_icono = $value;}
public function set_tipo($value){$this->_tipo = $value;}

public function get_codfunc(){return $this->_codfunc;}
public function get_codpadre(){return $this->_codpadre;}
public function get_nombre(){return $this->_nombre;}
public function get_identificador(){return $this->_identificador;}
public function get_orden(){return $this->_orden;}
public function get_urlpagina(){return $this->_urlpagina;}
public function get_target(){return $this->_target;}
public function get_icono(){return $this->_icono;}
public function get_tipo(){return $this->_tipo;}

}//End class
?>