<?php
require("../../../../config/config.inc.php");
$DOM["SECURITY_ID"]=array("MNTO_LIBRO");
require("viewmanager/security.inc.php");


$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);
$mensaje = $parametros->get_parameter("msg", 0);
$codigo = $parametros->get_parameter("codigo", 0);



//echo $codigo;
//exit();
//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(TRUE);
$Face->set_type("INSIDE");
$Face->set_name("Crear");


$obj = new Modules_Biblio_Model_Libros();
$obj->set_codlibro($codigo);

$facade = new Modules_Biblio_Model_LibrosFacade();
$obj = $facade->loadOne($obj);


$facadeMetadatos = new Modules_Biblio_Model_MetadatosFacade();
$registrosMetadatos = $facadeMetadatos->loadMetadatosLibros();

$facadeClasificacion = new Modules_Biblio_Model_ClasificacionesFacade();
$comboClasificacion = $facadeClasificacion->combo();

$facadeFormatos= new Modules_Biblio_Model_FormatosFacade();
$comboFormatos = $facadeFormatos->combo();

$facadeAdquisiciones= new Modules_Biblio_Model_AdquisicionesFacade();
$comboAdquisiciones = $facadeAdquisiciones->combo();


$formulario= new Moon2_Forms_Form();

$Face->add_navigation("Inicio", "index.php");
$Face->add_navigation("Editar ", "#");

//Publicacion de mensajes. Mostrar en domains los mensajes configurados.
$Face->floating_message($mensaje, 11, "Exito", "Todo bien Creado");
$Face->floating_message($mensaje, 31, "Error", "Algo mal");

echo $Face->open();
require($Face->getView());
echo $Face->close();
?>

