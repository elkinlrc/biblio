<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", TRUE);

$mensaje = $parametros->get_parameter("msg", 0);
$cod_edificio = $parametros->get_parameter("codedificio", 0);


$formulario = new Moon2_Forms_Form();   //dominio

$facadeSedes= new Modules_Empresa_Model_Sedesfacade;
$arr_sedes=$facadeSedes->combo();


//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Actualizar Edificio");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Administrar Edificios", "edificiosAdmin.php");
$Face->add_navigation("Actualizar Edificio", "#");


$Edificio = new Modules_Empresa_Model_Edificios();
$Edificio->set_codedificio($cod_edificio);

$facadeEdificios = new Modules_Empresa_Model_Edificiosfacade();
$Edificio = $facadeEdificios->loadOne($Edificio);


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>