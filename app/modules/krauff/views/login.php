<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Acceso al Sistema");
$Face->add_javascript("../js/login.js");
$Face->add_javascript("../js/md5-min.js");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>