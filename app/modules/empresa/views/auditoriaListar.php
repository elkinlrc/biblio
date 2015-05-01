<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

//NUEVO PAGINACION
$parametros =new Moon2_Params_Parameters();
$parametros->verify("GET",FALSE);  //nuevo
$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",2);
$parametros->add("SECURITY_ID","FALSE");



$rsNumRows=0;
//$limit_numrows=0;
//$page=0;
$Data=array();


$facadeAuditar= new Modules_Empresa_Model_AuditoriaFacade();
$mensaje = $parametros->get_parameter("msg",0);
$registros2=$facadeAuditar->load_all($rsNumRows, $limit_numrows, $page, $Data);
//echo "<pre>";
//print_r($registros2);
//echo "</pre>";
//exit();
 //paginar lista
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("auditorias Listar");
$Face->add_navigation("Inicio","index.php");
$Face->add_navigation("Auditoria","#");

$Face ->floating_message($mensaje,2,"Exito","Guardo Bien");
$Face ->floating_message($mensaje,1,"Error","Algo quedo Mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();









///////////////////////////////////////////////////////////







?>