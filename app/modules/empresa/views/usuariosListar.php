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



//tipo formulario

$formulario=new Moon2_Forms_Form();
$arr_busqueda=array();
$arr_busqueda[1]="Codigo";//el numero es el valor del value
$arr_busqueda[2]="Perfil";
$arr_busqueda[3]="oficina";
$arr_busqueda[4]="nombres";
$arr_busqueda[5]="primerapellido";
$arr_busqueda[6]="segundoapellido";
$arr_busqueda[7]="genero";


$rsNumRows=0;
$Data=array();
$Data["busqueda"][$opcionBusqueda]=$palabraBusqueda;



$facadeUsuarios = new Modules_Empresa_Model_Usuariosfacade();

$facadeUsuarios->add_searchField("1","u.codusuario");
$facadeUsuarios->add_searchField("2","p.perfil");
$facadeUsuarios->add_searchField("3","o.oficina");
$facadeUsuarios->add_searchField("4","u.nombres");
$facadeUsuarios->add_searchField("5","u.primerapellido");
$facadeUsuarios->add_searchField("6","u.segundoapellido");
$facadeUsuarios->add_searchField("7","u.genero");


$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(false);
$Face->set_type("OUTSIDE");
$Face->set_name("Listar Usuarios");

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Listar Usuarios", "#");

$registros = $facadeUsuarios->load_all($rsNumRows, $limit_numrows, $page, $Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>