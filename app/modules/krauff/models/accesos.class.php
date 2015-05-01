<?php
class Modules_Krauff_Model_Accesos{
    private $_codacceso;                //serial NOT NULL, Primary Key
    private $_codusuario;               //integer, Foreign Key (usuarios:codusuario)
    private $_fechaingreso;             //date NOT NULL
    private $_horaingreso;              //time without time zone NOT NULL
    private $_ipoculta;                 //varchar(50)
    private $_ipvisible;                //varchar(50)

public function __construct(){}

public function set_codacceso($value){$this->_codacceso = $value;}
public function set_codusuario($value){$this->_codusuario = $value;}
public function set_fechaingreso($value){$this->_fechaingreso = $value;}
public function set_horaingreso($value){$this->_horaingreso = $value;}
public function set_ipoculta($value){$this->_ipoculta = $value;}
public function set_ipvisible($value){$this->_ipvisible = $value;}

public function get_codacceso(){return $this->_codacceso;}
public function get_codusuario(){return $this->_codusuario;}
public function get_fechaingreso(){return $this->_fechaingreso;}
public function get_horaingreso(){return $this->_horaingreso;}
public function get_ipoculta(){return $this->_ipoculta;}
public function get_ipvisible(){return $this->_ipvisible;}

}//End class
?>