<?php
require("../../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(TRUE);
$Face->set_type("OUTSIDE");
$Face->set_name("Crear");


$facadeMetadatos = new Modules_Biblio_Model_MetadatosFacade();
$registrosMetadatos = $facadeMetadatos->loadMetadatosLibros();

$facadeClasificacion = new Modules_Biblio_Model_ClasificacionesFacade();
$comboClasificacion = $facadeClasificacion->combo();

$facadeFormatos= new Modules_Biblio_Model_FormatosFacade();
$comboFormatos = $facadeFormatos->combo();


$formulario= new Moon2_Forms_Form();

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Crear ", "#");

//Publicacion de mensajes. Mostrar en domains los mensajes configurados.
$Face->floating_message($mensaje, 11, "Exito", "Todo bien Creado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>

