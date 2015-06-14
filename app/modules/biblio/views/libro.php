<?php
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_AUTOR");
require("viewmanager/security.inc.php");

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Bilioteca");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);



$mensaje = $parametros->get_parameter("msg", 0);
$codigo = $parametros->get_parameter("codigo", 0);

$obj = new Modules_Biblio_Model_Libros();
$obj->set_codlibro($codigo);

$facade = new Modules_Biblio_Model_LibrosFacade();
$obj = $facade->loadOne($obj);


$facadeMetadatos = new Modules_Biblio_Model_MetadatosFacade();
$registrosMetadatos = $facadeMetadatos->loadMetadatosLibros();

$facadeClasificacion = new Modules_Biblio_Model_ClasificacionesFacade();
$comboClasificacion = $facadeClasificacion->combo();

$facadeFormatos= new Modules_Biblio_Model_FormatosFacade();
$comboFormatos = $facadeFormatos->combo();

$facadeSedes= new Modules_Biblio_Model_SedesFacade();
$combosedes = $facadeSedes->combo();

$formulario= new Moon2_Forms_Form();


$Face->add_navigation("Inicio", "#");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>