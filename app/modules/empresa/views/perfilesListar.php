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
$arr_busqueda[1]="Codigo";//el numero es el valor del value
$arr_busqueda[2]="Perfil";


$rsNumRows=0;
$Data=array();
$Data["busqueda"][$opcionBusqueda]=$palabraBusqueda;

$facadePerfiles = new Modules_Empresa_Model_Perfilesfacade();
$facadePerfiles->add_searchField("1","p.codperfil");
$facadePerfiles->add_searchField("2","p.perfil");



$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Listar Perfiles");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Listar Perfiles", "#");


$registros = $facadePerfiles->load_all($rsNumRows, $limit_numrows, $page, $Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>