<?php
require("../../../../config/config.inc.php");
$DOM["SECURITY_ID"]=array("MNTO_SEDES");
require("viewmanager/security.inc.php");


$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(TRUE);
$Face->set_type("INSIDE");
$Face->set_name("Crear");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Crear ", "#");

//Publicacion de mensajes. Mostrar en domains los mensajes configurados.
$Face->floating_message($mensaje, 11, "Exito", "Todo bien Creado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>

