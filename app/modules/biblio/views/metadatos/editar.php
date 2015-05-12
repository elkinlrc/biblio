<?php
require("../../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);
$codigo = $parametros->get_parameter("codigo", 0);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(TRUE);
$Face->set_type("OUTSIDE");
$Face->set_name("Crear");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Editar ", "#");


$obj = new Modules_Biblio_Model_Metadatos();
$obj->set_codmetadato($codigo);

$facade = new Modules_Biblio_Model_MetadatosFacade();
$obj = $facade->loadOne($obj);

//Publicacion de mensajes. Mostrar en domains los mensajes configurados.
$Face->floating_message($mensaje, 11, "Exito", "Todo bien Creado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>
