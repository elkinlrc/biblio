<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);
$cod_nacionalidad = $parametros->get_parameter("codnacionalidad", 0);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("FLOAT");
$Face->set_name("Crear nacionalidad");




$Nacionalidades = new Modules_Empresa_Model_Nacionalidad();
$Nacionalidades->set_codnacionalidad($cod_nacionalidad);

$facadeNacionalidad = new Modules_Empresa_Model_Nacionalidadfacade();
$Nacionalidades = $facadeNacionalidad->loadOne($Nacionalidades);


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>