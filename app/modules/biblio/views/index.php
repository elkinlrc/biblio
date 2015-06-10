<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Bilioteca");

$Face->add_navigation("Inicio", "#");


$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);

$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",15);
$busqueda=$parametros->get_parameter("buscador","");


$facadeMetadatos = new Modules_Biblio_Model_MetadatosFacade();
$registrosMetadatos = $facadeMetadatos->loadMetadatosLibros();


$facade = new Modules_Biblio_Model_LibrosFacade();
$registros = $facade->load_all($rsNumRows, $limit_numrows, $page,$Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);


echo $Face->open();
require($Face->getView());
echo $Face->close();
?>