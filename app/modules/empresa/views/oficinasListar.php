<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",2);
$parametros->add("SECURITY_ID","FALSE");


$opcionBusqueda=$parametros->get_parameter("So","");
$palabraBusqueda=$parametros->get_parameter("Sw","");


$formulario=new Moon2_Forms_Form();
$arr_busqueda=array();
$arr_busqueda[1]="Código";//el numero es el valor del value
$arr_busqueda[2]="Oficina";



$rsNumRows=0;
$Data=array();
$Data["busqueda"][$opcionBusqueda]=$palabraBusqueda;

$facadeOficinas = new Modules_Empresa_Model_Oficinasfacade();
$facadeOficinas->add_searchField("1","o.coddependencia");
$facadeOficinas->add_searchField("2","o.oficina");




$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Listar Oficinas");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Listar Oficinas", "#");



$registros = $facadeOficinas->load_all($rsNumRows, $limit_numrows, $page, $Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>