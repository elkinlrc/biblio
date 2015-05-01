<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);
$cod_perfil = $parametros->get_parameter("codperfil", 0);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("FLOAT");
$Face->set_name("Crear sedes");




$Perfil = new Modules_Empresa_Model_Perfiles();
$Perfil->set_codperfil($cod_perfil);

$facadePerfiles = new Modules_Empresa_Model_Perfilesfacade();
$Perfil = $facadePerfiles->loadOne($Perfil);


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>