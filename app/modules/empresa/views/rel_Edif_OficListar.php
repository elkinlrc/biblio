<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",2);
$parametros->add("SECURITY_ID","FALSE");

////
$opcionBusqueda=$parametros->get_parameter("So","");
$palabraBusqueda=$parametros->get_parameter("Sw","");


//tipo formulario

$formulario=new Moon2_Forms_Form();
$arr_busqueda=array();
$arr_busqueda[1]="Edificio";//el numero es el valor del value
$arr_busqueda[2]="Oficina";




$rsNumRows=0;
$Data=array();
//$Data["busqueda"][""] ="";//para arreglar lo de los listados
$Data["busqueda"][$opcionBusqueda]=$palabraBusqueda;



$facadeEdificio = new Modules_Empresa_Model_Edificiosfacade();
$facadeEdificio->add_searchField("1","e.edificio");

$facade= new Modules_Empresa_Model_Oficinasfacade();
$facade->add_searchField("2","o.coddependencia");




$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Listar Sedes");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Listar ", "#");

//$facadeEdificios = new Modules_Empresa_Model_Edificiosfacade();

//$facadeSedes = new Modules_Empresa_Model_Sedesfacade();




$registros = $facadeEdificio->load_all_Join($rsNumRows, $limit_numrows, $page, $Data);

$registros1 = $facade->load_all($rsNumRows, $limit_numrows, $page, $Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>