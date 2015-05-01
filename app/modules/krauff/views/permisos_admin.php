<?php
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_USU");


//Carga el sistema de seguridad
require("viewmanager/security.inc.php");


//Gestor de parámetros
$Params = new Moon2_Params_Parameters();
$Params->verify("GET",false);
$msg = $Params->get_parameter("msg", "");
$cod_usuario = $Params->get_parameter("codusuario", "");

//Gestor de la página
$Face = new Moon2_ViewManager_Controller();
$Face->set_name("Funcionalidades - Administrar");
$Face->set_component("Mantenimiento Tablas");
$Face->add_javascript("../js/permisos_flotantes.js");
$Face->set_type("FLOAT");
$Face->set_sysmenu(false);

//Despliegue de la página en xhtml
echo $Face->open();
require($Face->getView());
echo $Face->close();
?>