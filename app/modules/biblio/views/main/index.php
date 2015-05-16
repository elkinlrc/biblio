<?php
require("../../../../config/config.inc.php");
$DOM["SECURITY_ID"] = "*";

//Carga el sistema de seguridad
require("viewmanager/security.inc.php");

//Gestor de la página
$Face = new Moon2_ViewManager_Controller();
$Face->set_name("Menu principal");
$Face->set_type("INSIDE");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>