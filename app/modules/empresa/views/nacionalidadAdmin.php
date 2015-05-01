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
$Face->set_type("OUTSIDE");
$Face->set_name("Administrar Nacionalidades");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Administrar Nacionalidades", "#");
$Face->add_javascript("../javas/flotanteEliminar.js");

$Face->floating_message($mensaje, 11, "Exito", "Todo bien Elimiado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");
$Face->floating_message($mensaje, 12, "Exito", "Todo bien Actualizado");
$Face->floating_message($mensaje, 32, "Error", "Algo mal");

$facadeNacionalidad= new Modules_Empresa_Model_Nacionalidadfacade();

$rsNumRows=0;

$Data=array();
$Data["busqueda"][""] ="";//para arreglar lo de los listados

$registros = $facadeNacionalidad->load_all($rsNumRows, $limit_numrows, $page, $Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>