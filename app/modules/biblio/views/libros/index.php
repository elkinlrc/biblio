<?php
require("../../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",15);
$parametros->add("SECURITY_ID","FALSE");

$opcionBusqueda=$parametros->get_parameter("So","");
$palabraBusqueda=$parametros->get_parameter("Sw","");


$formulario=new Moon2_Forms_Form();
$arr_busqueda=array();
$arr_busqueda[1]="Codigo";//el numero es el valor del value
$arr_busqueda[2]="Nombre";



$rsNumRows=0;
$Data=array();
$Data["busqueda"][$opcionBusqueda]=$palabraBusqueda;


$facade = new Modules_Biblio_Model_ClasificacionesFacade();
$facade->add_searchField("1","a.codclasificacion");
$facade->add_searchField("2","a.nombre");
//$facadeEdificios->add_searchField("3","e.edificio");


$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
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