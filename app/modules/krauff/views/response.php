<?php
session_start();
session_unset();
session_destroy();
require("../../../config/config.inc.php");
$id_security= array("*");

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Respuesta del sistema");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>