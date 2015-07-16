<?php
require("../../../config/config.inc.php");
//if (isset($_SESSION['variable_sesion'])){
//echo "La sesión existe ...";
//} 

$DOM["SECURITY_ID"] = array("MNTO_AUTOR");
require("viewmanager/security.inc.php");


//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(TRUE);
$Face->set_type("INSIDE");
$Face->set_name("Bilioteca");
//$Face->buildNavigationbar();
$Face->add_navigation("Inicio", "#");
///
//Gestor de la página

///

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);

$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",10);
$busqueda=$parametros->get_parameter("buscador","");
$Data=array();
$Data["busqueda"]['valor']=$busqueda;

$facadeMetadatos = new Modules_Biblio_Model_MetadatosFacade();
$facadeMetadatos->add_searchField("1","m.valor");
$registrosMetadatos = $facadeMetadatos->loadMetadatosLibros();


$facade = new Modules_Biblio_Model_LibrosFacade();
$registros = $facade->search($rsNumRows, $limit_numrows, $page,$Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);
echo $Face->open();
require($Face->getView());
echo $Face->close();

