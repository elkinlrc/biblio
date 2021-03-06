<?php
require("../../../../config/config.inc.php");
$DOM["SECURITY_ID"]=array("MNTO_LIBRO");
require("viewmanager/security.inc.php");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);

$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",10);


$opcionBusqueda=$parametros->get_parameter("So","");
$palabraBusqueda=$parametros->get_parameter("Sw","");


$formulario=new Moon2_Forms_Form();
$arr_busqueda=array();
$arr_busqueda[1]="Codigo";//el numero es el valor del value

$arr_busqueda[2]="Nombre";
$arr_busqueda[3]="Subtitulo";



$rsNumRows=0;
$Data=array();
$Data["busqueda"][$opcionBusqueda]=$palabraBusqueda;


$facade = new Modules_Biblio_Model_LibrosFacade();
$facade->add_searchField("1","l.codlibro");
$facade->add_searchField("2","l.titulo");
$facade->add_searchField("2","l.subtitulo");
//$facadeEdificios->add_searchField("3","e.edificio");


$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(TRUE);
//$Face->set_type("OUTSIDE");
$Face->set_type("INSIDE");
$Face->set_name("Listado de Clasificación ");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Listado de Clasficacion Biblioteca", "#");


//$registros = $facadeEdificios->load_all($rsNumRows, $limit_numrows, $page, $Data);
$registros = $facade->load_all($rsNumRows, $limit_numrows, $page,$Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>