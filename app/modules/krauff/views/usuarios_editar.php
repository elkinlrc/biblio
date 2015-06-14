<?php
//Inclusiones obligatorias, primero el FrameWork y segundo el identificador de seguridad
require("../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_USU");


//Carga el sistema de seguridad
require("viewmanager/security.inc.php");


//Gestor de parámetros
$Params = new Moon2_Params_Parameters();
$Params->verify("GET",false);
$msg = $Params->get_parameter("msg", "");
$paso = $Params->get_parameter("p", "paso1");
$Formulario = new Moon2_Forms_Form();

//Obtencion de llave primaria
$cod_usuario = $Params->get_parameter("codusuario", "0");
$Usuario = new Modules_Krauff_Model_Usuarios();
$Usuario->set_codusuario($cod_usuario);
$FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
$FacadeUsuarios->loadOne($Usuario);

//Combo de perfiles
$FacadePerfil = new Modules_Krauff_Model_PerfilesFacade();
$arr_perfiles = $FacadePerfil->comboperfiles();

//Combo de Empresas
$FacadeColegios = new Modules_Pensiones_Model_ColegiosFacade();
$arrayEmpresa = $FacadeColegios->combo();

//Gestor de la página
$Face = new Moon2_ViewManager_Controller();
$Face->set_name("Editar Perfil");
$Face->set_component("Mantenimiento Tablas");
$Face->add_javascript("../js/perfiles_flotantes.js");
$Face->set_type("INSIDE");
$Face->set_sysmenu(true);
$Face->add_navigation("Usuarios", "#");
$Face->add_navigation("Listado", "usuarios_admin.php");
$Face->add_navigation("Editar", "#");

//Despliegue de la página en xhtml
echo $Face->open();
require($Face->getView());
echo $Face->close();
?>