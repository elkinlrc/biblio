<?php
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PER");


//Carga el sistema de seguridad
require("viewmanager/security.inc.php");


//Gestor de parámetros
$Params = new Moon2_Params_Parameters();
$Params->verify("GET",false);
$msg = $Params->get_parameter("msg", "");
$cod_perfil = $Params->get_parameter("codperfil", "0");


//Cargar datos del perfil de acuerdo al código
$Perfil = new Modules_Krauff_Model_Perfiles();
$Perfil->set_codperfil($cod_perfil);

$FacadePefiles = new Modules_Krauff_Model_PerfilesFacade();
$Perfil = $FacadePefiles->loadOne($Perfil);


//Gestor de la página
$Face = new Moon2_ViewManager_Controller();
$Face->set_name("Editar");
$Face->set_component("Mantenimiento Tablas");
$Face->add_javascript("../js/perfiles_flotantes.js");
$Face->set_type("FLOAT");
$Face->set_sysmenu(false);

//Despliegue de la página en xhtml
echo $Face->open();
require($Face->getView());
echo $Face->close();
?>