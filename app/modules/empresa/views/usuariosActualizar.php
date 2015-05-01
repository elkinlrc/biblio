<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);
$cod_usuario = $parametros->get_parameter("codusuario", 0);

$formulario = new Moon2_Forms_Form();   //dominio

$facadePerfiles= new Modules_Empresa_Model_Perfilesfacade();
$arr_perfil=$facadePerfiles->combo();

$facadeOficinas= new Modules_Empresa_Model_Oficinasfacade();
$arr_oficinas=$facadeOficinas->combo();

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Actualizar Usuarios");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Administrar", "usuariosAdmin.php");
$Face->add_navigation("Actualizar Usuarios", "#");


$Usuarios= new Modules_Empresa_Model_Usuarios();
$Usuarios->set_codusuario($cod_usuario);



$facadeUsuarios = new Modules_Empresa_Model_Usuariosfacade();
$Usuarios = $facadeUsuarios->loadOne($Usuarios);




echo $Face->open();
require($Face->getView());
echo $Face->close();
?>