<?php
require("../../../config/config.inc.php");
$id_security= array("EVADOC_EVA_REA");

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);

$formulario = new Moon2_Forms_Form();   //dominio
$facadePerfiles= new Modules_Empresa_Model_Perfilesfacade();
$arr_perfil=$facadePerfiles->combo();

$facadeOficinas= new Modules_Empresa_Model_Oficinasfacade();
$arr_oficinas=$facadeOficinas->combo();

//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Crear Usuarios");



//Publicacion de mensajes. Mostrar en domains los mensajes configurados.
$Face->floating_message($mensaje, 11, "Exito", "Todo bien Creado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>