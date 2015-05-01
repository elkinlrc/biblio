<?php
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("CONF_FUN");


//Carga el sistema de seguridad
require("viewmanager/security.inc.php");


//Gestor de parámetros
$Params = new Moon2_Params_Parameters();
$Params->verify("GET",false);
$msg = $Params->get_parameter("msg", "");

//Gestor de la página
$Face = new Moon2_ViewManager_Controller();
$Face->set_name("Funcionalidades - Administrar");
$Face->set_component("Mantenimiento Tablas");
$Face->add_javascript("../js/funcionalidades.js");
$Face->set_type("INSIDE");
$Face->add_navigation("Funcionalidades", "#");
$Face->add_navigation("Arbol", "#");


//Lógica del negocio






//Despliegue de la página en xhtml
echo $Face->open();
require($Face->getView());
echo $Face->close();
?>