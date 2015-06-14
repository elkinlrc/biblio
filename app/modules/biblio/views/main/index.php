<?php
require("../../../../config/config.inc.php");
require("viewmanager/security.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_AUTOR");

//Carga el sistema de seguridad


//Gestor de la página
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(true);
$Face->set_type("INSIDE");
$Face->set_name("Listar Libros ");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Listar Autores", "#");



echo $Face->open();
require($Face->getView());
echo $Face->close();
?>