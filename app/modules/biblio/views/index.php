<?php
require("../../../config/config.inc.php");
//if (isset($_SESSION['variable_sesion'])){
//echo "La sesión existe ...";
//} 

$DOM["SECURITY_ID"] = array("MNTO_AUTOR");
require("viewmanager/security.inc.php");


//***********************************************
$Face = new Moon2_ViewManager_Controller();
$Face->set_sysmenu(TRUE);
$Face->set_type("INSIDE");
$Face->set_name("Bilioteca");
//$Face->buildNavigationbar();
$Face->add_navigation("Inicio", "#");
///
//Gestor de la página

///
$Data=array();

$parametros = new Moon2_Params_Parameters();
$parametros->verify("GET", FALSE);

$page =$parametros->get_parameter("npage",0);
$limit_numrows =$parametros->get_parameter("nrows",10);
$busqueda=$parametros->get_parameter("buscador","");


$facadeMetadatos = new Modules_Biblio_Model_MetadatosFacade();
$registrosMetadatos = $facadeMetadatos->loadMetadatosLibros();


$facade = new Modules_Biblio_Model_LibrosFacade();
$registros = $facade->load_all($rsNumRows, $limit_numrows, $page,$Data);
$paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $page, $parametros);
echo $Face->open();
require($Face->getView());
echo $Face->close();
?>
<!--
<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)">Brand</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="javascript:void(0)">Active</a></li>
            <li><a href="javascript:void(0)">Link</a></li>
            <li class="dropdown"> 
<a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)">Action</a></li>
                    <li><a href="javascript:void(0)">Another action</a></li>
                    <li><a href="javascript:void(0)">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Dropdown header</li>
                    <li><a href="javascript:void(0)">Separated link</a></li>
                    <li><a href="javascript:void(0)">One more separated link</a></li>
                </ul>
            </li>
        </ul>
        <form class="navbar-form navbar-left">
            <input class="form-control col-lg-8" placeholder="Search" type="text">
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="javascript:void(0)">Link</a></li>
            <li class="dropdown">
                <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)">Action</a></li>
                    <li><a href="javascript:void(0)">Another action</a></li>
                    <li><a href="javascript:void(0)">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">Separated link</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
-->
<?php



?>