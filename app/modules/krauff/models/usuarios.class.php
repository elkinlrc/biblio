<?php
class Modules_Krauff_Model_Usuarios{
private $_codusuario;               //serial, NOT NULL, Primary key
private $_codperfil;                //integer, NOT NULL, Foreign Key perfiles(codperfil)
private $_tipodoc;                  //varchar(2)
private $_documento;                //varchar(30)
private $_nombres;                  //varchar(150), NOT NULL
private $_correo;                   //varchar(200), NOT NULL
private $_direccion;                //varchar(100), NULL
private $_telefono;                 //int8, NULL
private $_celular;                  //int8, NULL
private $_contacto;                 //varchar(150),NULL
private $_fechanacimiento;          //date, NULL
private $_genero;                   /* smallint, NOT NULL, DEFAULT 1, Domains CHECK ckc_genero_usuarios:
                                        1 Masculino
                                        2 Femenino */
private $_nombreusuario;            //varchar(100), NOT NULL
private $_clave;                    //varchar(50), NOT NULL
private $_codcolegio;
private $_ciudad;
private $_pais;
private $_clavesincifrar;                    //varchar(50), NOT NULL




public function __construct(){}

//Setters
public function set_codusuario($value){$this->_codusuario = $value;}
public function set_codperfil($value){$this->_codperfil = $value;}
public function set_tipodoc($value){$this->_tipodoc = $value;}
public function set_documento($value){$this->_documento = $value;}
public function set_nombres($value){$this->_nombres = $value;}
public function set_correo($value){$this->_correo = $value;}
public function set_direccion($value){$this->_direccion = $value;}
public function set_telefono($value){$this->_telefono = $value;}
public function set_celular($value){$this->_celular = $value;}
public function set_contacto($value){$this->_contacto = $value;}
public function set_fechanacimiento($value){$this->_fechanacimiento = $value;}
public function set_genero($value){$this->_genero = $value;}
public function set_nombreusuario($value){$this->_nombreusuario = $value;}
public function set_clave($value){$this->_clave = $value;}
public function set_codcolegio($value){$this->_codcolegio = $value;}
public function set_ciudad($value){$this->_ciudad = $value;}
public function set_pais($value){$this->_pais = $value;}
public function set_clavesincifrar($value){$this->_clavesincifrar = $value;}



//Getters
public function get_codusuario(){return $this->_codusuario;}
public function get_codperfil(){return $this->_codperfil;}
public function get_tipodoc(){return $this->_tipodoc;}
public function get_documento(){return $this->_documento;}
public function get_nombres(){return $this->_nombres;}
public function get_correo(){return $this->_correo;}
public function get_direccion(){return $this->_direccion;}        
public function get_telefono(){return $this->_telefono;}
public function get_celular(){return $this->_celular;}
public function get_contacto(){return $this->_contacto;}
public function get_fechanacimiento(){return $this->_fechanacimiento;}
public function get_genero(){return $this->_genero;}
public function get_nombreusuario(){return $this->_nombreusuario;}
public function get_clave(){return $this->_clave;}
public function get_codcolegio(){return $this->_codcolegio;}
public function get_ciudad(){return $this->_ciudad;}
public function get_pais(){return $this->_pais;}
public function get_clavesincifrar(){return $this->_clavesincifrar;}



}//End class
?>