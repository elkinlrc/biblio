<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);
$cod_sede = $parametros->get_parameter("codsede", 0);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Actualizar sedes");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Administrar", "sedesAdminSuper.php");
$Face->add_navigation("Actualizar Sedes", "#");


$Sede = new Modules_Empresa_Model_Sedes();
$Sede->set_codsede($cod_sede);



$facadeSedes = new Modules_Empresa_Model_Sedesfacade();
$Sede = $facadeSedes->loadOne($Sede);


//Publicacion de mensajes. Mostrar en domains los mensajes configurados.
$Face->floating_message($mensaje, 11, "Exito", "Todo bien Creado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>