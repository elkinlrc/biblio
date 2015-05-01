<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);

$page = $parametros->get_parameter("npage", 0);
$limit_numrows = $parametros->get_parameter("nrows", 3);
$parametros->add("SECURITY_ID", "FALSE");

$opcionBusqueda=$parametros->get_parameter("So","");
$palabraBusqueda=$parametros->get_parameter("Sw","");


$formulario=new Moon2_Forms_Form();
$arr_busqueda=array();
$arr_busqueda[1]="codigo";//el numero es el valor del value
$arr_busqueda[2]="Nacionalidad";


$rsNumRows=0;
$Data=array();
$Data["busqueda"][$opcionBusqueda]=$palabraBusqueda;

$facedeNacionalidad = new Modules_Empresa_Model_Nacionalidadfacade();

$facedeNacionalidad->add_searchField("1","n.codnacionalidad");
$facedeNacionalidad->add_searchField("2","n.nacionalidad");




$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Listar Nacionalidad");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Listar Nacionalidad", "#");





$registros = $facedeNacionalidad->load_all($rsNumRows, $limit_numrows, $page, $Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>