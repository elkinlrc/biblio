<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Bilioteca");

$Face->add_navigation("Inicio", "#");

$facadeMetadatos = new Modules_Biblio_Model_MetadatosFacade();
$registrosMetadatos = $facadeMetadatos->loadMetadatosLibros();


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>