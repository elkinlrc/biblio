<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);

$mensaje = $parametros->get_parameter("msg", 0);
$page = $parametros->get_parameter("npage", 0);
$limit_numrows = $parametros->get_parameter("nrows", 3);
$parametros->add("SECURITY_ID", "FALSE");


$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("FLOAT");
$Face->set_name("Administrar Perfiles");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Administrar ", "#");


$Face->add_javascript("../javas/flotanteEliminar.js");
$Face->add_javascript("../javas/flotanteSuper.js");

$Face->floating_message($mensaje, 11, "Exito", "Todo bien Elimiado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

$Face->floating_message($mensaje, 12, "Exito", "Todo bien Actualizado");
$Face->floating_message($mensaje, 32, "Error", "Algo mal");

$facadePerfiles= new Modules_Empresa_Model_Perfilesfacade();



$rsNumRows=0;
$Data=array();
$Data["busqueda"][""] ="";//para arreglar lo de los listados




$registros = $facadePerfiles->load_all($rsNumRows, $limit_numrows, $page, $Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>