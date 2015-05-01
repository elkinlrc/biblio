<?php
class Modules_Krauff_Model_Perfiles {
    private $_codperfil;              //serial PRIMARY KEY
    private $_nombreperfil;          //varchar(200) NOT NULL,
    
public function __construct() {}

public function set_codperfil($value){$this->_codperfil = $value;}
public function set_nombreperfil($value){$this->_nombreperfil = $value;}

public function get_codperfil(){return $this->_codperfil;}
public function get_nombreperfil(){return $this->_nombreperfil;}

}//End class
?>