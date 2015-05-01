<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);
$cod_oficina = $parametros->get_parameter("coddependencia", 0);

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Actualizar Oficina");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Administrar", "oficinasAdmin.php");
$Face->add_navigation("Actualizar Oficina", "#");

$Oficinas = new Modules_Empresa_Model_Oficinas();
$Oficinas->set_coddependencia($cod_oficina);

$facadeOficina = new Modules_Empresa_Model_Oficinasfacade();
$Oficinas = $facadeOficina->loadOne($Oficinas);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>