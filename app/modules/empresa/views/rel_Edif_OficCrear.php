<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);


$formulario = new Moon2_Forms_Form();   //dominio
$facadeEquipos= new Modules_Empresa_Model_Edificiosfacade();
$arr_equipos=$facadeEquipos->combo();


$formulario = new Moon2_Forms_Form();   //dominio
$facadeOficina= new Modules_Empresa_Model_Oficinasfacade();
$arr_oficinas=$facadeOficina->combo();


//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Crear ");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Crear ", "#");

//Publicacion de mensajes. Mostrar en domains los mensajes configurados.
$Face->floating_message($mensaje, 11, "Exito", "Todo bien Creado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>