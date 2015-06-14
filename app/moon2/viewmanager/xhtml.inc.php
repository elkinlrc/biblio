<?php
function xhtml_header($title, $paths, $theme, $javafiles, $stylesOut){
    $html = "<!doctype html>\n";
    $html.= "<html>\n";
    $html.= "<head>\n";
    $html.= "<meta charset=\"utf-8\">\n";
    $html.= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\">\n";
    $html.= "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">\n";
    $html.= "<title>{$title}</title>\n";
    $html.= xhtml_header_styles($paths, $theme, $stylesOut);
    $html.= xhtml_header_javascripts($paths, $theme, $javafiles);
    $html.= "</head>\n";
    return $html;
}

function xhtml_header_styles($paths, $theme, $stylesOut){
    $html = "<!-- Style load -->\n";
    $path = $paths["ROOT"]["moon"]."/themes/{$theme}/css/";
    $styles = array();
    $styles[] = "bootstrap.min.css";
    //$styles[] = "bootstrap.min.css";
    $styles[] = "roboto.min.css";
    $styles[] =    "material-fullpalette.min.css";
    $styles[] =    "ripples.min.css";
    $styles[] =    "snackbar.min.css";
    $styles[] =    "jquery.dropdown.css";
   // $styles[] = "bootstrap-responsive.min.css";
    $styles[] = "font-awesome.min.css";
 //   $styles[] = "base-admin-3.css";
    //$styles[] = "ui-lightness/jquery-ui-1.10.0.custom.min.css";
    $styles[] = "ui-lightness/jquery-ui-1.10.3.custom.css";
    $styles[] = "tree/skin/ui.dynatree.css";
    
    $styles[] = "../js/plugins/msgGrowl/css/msgGrowl.css";
    //$styles[] = "../js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css";
    $styles[] = "../js/plugins/msgbox/jquery.msgbox.css";
    $styles[] = "../js/plugins/tooltip/docs.css";
    
   // $styles[] = "base-admin-3-responsive.css";
   // $styles[] = "pages/plans.css";
   // $styles[] = "pages/pricing.css";
    //$styles[] = "pages/signin.css";
   // $styles[] = "pages/dashboard.css";
    $styles[] = "validationEngine.jquery.css";
    //$styles[] = "custom.css";
    foreach($styles as $key => $value){
        $html.="<link rel=\"stylesheet\" href=\"{$path}{$value}\" type=\"text/css\" />\n";
    }
    //Calendar begin
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"".$paths["ROOT"]["moon"]."/calendar/css/jscal2.css\" type=\"text/css\" />";
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"".$paths["ROOT"]["moon"]."/calendar/css/border-radius.css\" type=\"text/css\" />";
    $stylesOut[] = "<link rel=\"stylesheet\" href=\"".$paths["ROOT"]["moon"]."/calendar/css/steel.css\" type=\"text/css\" />";
    //Calendar end
    foreach($stylesOut as $key => $value){
        $html.= $value."\n";
    }
    return $html;
}

function xhtml_header_javascripts($paths, $theme, $javafiles){
    $html = "<!-- Script load -->\n";
    $javas = array();
    //theme
    $path = $paths["ROOT"]["moon"]."/themes/{$theme}/js/";
    $javas[] = $path."libs/jquery-1.10.1.min.js";
    $javas[] = $path."libs/jquery-ui-1.10.3.custom.js";
    $javas[] = $path."libs/jquery.cookie.js";
    $javas[] = $path."libs/bootstrap.min.js";
    $javas[] = $path."libs/jquery.dynatree.js";
    
    $javas[] = $path."plugins/validate/languages/jquery.validationEngine-es.js";
    $javas[] = $path."plugins/validate/jquery.validationEngine.js";
    $javas[] = $path."plugins/msgGrowl/js/msgGrowl.js";
    //$javas[] = $path."plugins/lightbox/jquery.lightbox.min.js";
    $javas[] = $path."plugins/msgbox/jquery.msgbox.js";
    $javas[] = $path."jquery.dropdown.js";
    $javas[] = $path."material.min.js";
    $javas[] = $path."ripples";
    $javas[] = $path."plugins/tooltip/bootstrap-tooltip.js";
    $javas[] = $path."plugins/tooltip/bootstrap-popover.js";
    //Calendar begin
    $javas[] = $paths["ROOT"]["moon"]."/calendar/js/jscal2.js";
    $javas[] = $paths["ROOT"]["moon"]."/calendar/js/es.js";
    //Calendar end
    $javas[] = $path."Application.js";

    //moon2
    $javas[] = $paths["ROOT"]["moon"]."/js/moon2.js";
    foreach($javas as $key => $value){
        $html.="<script src=\"{$value}\"></script>\n";
    }
    
    foreach($javafiles as $key => $value){
        $html.= $value."\n";
    }

    $html.= xhtml_global_java($paths["ROOT"]["moon"]);
    return $html;
}

function xhtml_global_java($path){
    $html = "<script language=\"javascript\" type=\"text/javascript\">\n";
    $html.= "  var javaPath = \"{$path}\"\n";
    $html.= "</script>\n";
    return $html;
}

function xhtml_body_open($type, $dataPath, $dataDomain,$menuHtml=''){
    $html ="";
    $pathModules = $dataPath["ROOT"]["modules"];
    switch ($type){
        case "OUTSIDE":
            $login = $dataPath["QUIT"]."/login.php";
            $html = "<body>\n";
            $html.= "<nav role=\"navigation\" class=\"navbar navbar-default navbar-fixed-top \">\n";
            $html.= "   <div class=\"container\">\n";
            $html.= "       <div class=\"navbar-header\">\n";
            $html.= "           <button data-target=\".navbar-ex1-collapse\" data-toggle=\"collapse\" class=\"navbar-toggle\" type=\"button\">\n";
            $html.= "               <span class=\"sr-only\">Toggle navigation</span>\n";
            $html.= "               <span class=\"icon-bar\"></span>\n";
            $html.= "               <span class=\"icon-bar\"></span>\n";
            $html.= "               <span class=\"icon-bar\"></span>\n";
            $html.= "           </button>\n";
            $html.= "           <a href=\"{$pathModules}/biblio/views/index.php\" class=\"navbar-brand\">".$dataDomain["SYSTEMNAME"]."</a>\n";
            $html.= "       </div>";
            $html.= "       ";
            $html.= "       <div class=\"collapse navbar-collapse navbar-ex1-collapse\">\n";
            $html.= "           <ul class=\"nav navbar-nav navbar-right\">\n";
            $html.= "               <li class=\"\">\n";
            $html.= "                   <a href=\"{$login}\">Acceso al Sistema</a>\n";
            $html.= "               </li>\n";
            $html.= "               <li class=\"\">\n";
            $html.= "                   <a href=\"javascript:history.back();\"><i class=\"icon-chevron-left\"></i>&nbsp;&nbsp;Regresar página</a>\n";
            $html.= "               </li>\n";
            $html.= "           </ul>\n";
            $html.= "       </div><!-- /.navbar-collapse -->\n";
            $html.= "   </div> <!-- /.container -->\n";
            $html.= "</nav>\n";
            $html.= "<br />\n";
        break;
        case "INSIDE":
            $quit = $dataPath["QUIT"]."/response.php?msg=".urlencode("Sesion finalizada correctamente");
            $html="<div class=\"navbar navbar-default\">
                                <div class=\"navbar-header\">
                                    <button data-target=\".navbar-responsive-collapse\" data-toggle=\"collapse\" class=\"navbar-toggle\" type=\"button\">
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                    </button>
                                    <a href=\"{$pathModules}/biblio/views/index.php\" class=\"navbar-brand\">".$dataDomain["SYSTEMNAME"]."<div class=\"ripple-wrapper\"></div></a>
                                </div>
                                <div class=\"navbar-collapse collapse navbar-responsive-collapse\">
                                    <ul class=\"nav navbar-nav\">
                                      ".$menuHtml."
                                    </ul>
                                    <ul class=\"nav navbar-nav navbar-right\">
                                        
                                        <li class=\"dropdown\">
                                            <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" data-target=\"#\" href=\"bootstrap-elements.html\">".$dataDomain["FULLUSER_NAME"]." <b class=\"caret\"></b></a>
                                            <ul class=\"dropdown-menu\">
                                                <li><a href=\"javascript:void(0)\">Mi Perfil</a></li>
                                                <li><a href=\"javascript:void(0)\">Cambiar Contraseña</a></li>
                                                
                                                <li class=\"divider\"></li>
                                                <li><a href=\"{$quit}\">Cerrar Sesión</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>";
        break;
        default:
            $html = "<body>\n";
            $html.= "<nav role=\"navigation\" class=\"navbar navbar-default\">\n";
            $html.= "   <div class=\"container\">\n";
            $html.= "       <div class=\"navbar-floatm\">\n";
            $html.= "           ".$dataDomain["SYSTEMNAME"]."\n";
            $html.= "       </div>";
            $html.= "   </div> <!-- /.container -->\n";
            $html.= "</nav>\n";
        break;
    }
    return $html;
}

function xhtml_menu($section, $mainPath, $defaultComponent){
    $html = "";
    $active = "";
    if ($defaultComponent == "Inicio"){
        $active = " class=\"active\"";
    }
    switch ($section){
        case "header":
            $html.= "<div class=\"subnavbar \">\n";
            $html.= "  <div class=\"subnavbar-inner\">\n";
            $html.= "    <div class=\"container\">\n";	
            $html.= "        <a class=\"btn-subnavbar collapsed\" data-toggle=\"collapse\" data-target=\".subnav-collapse\">\n";
            $html.= "            <i class=\"icon-reorder\"></i>\n";
            $html.= "        </a>\n";
            $html.= "        <div class=\"subnav-collapse collapse\">\n";
            $html.= "            <ul class=\"mainnav\">\n";
            $html.= "                <li{$active}>\n";
            $html.= "                    <a href=\"".$mainPath."/views/\">\n";
            $html.= "                        <i class=\"icon-home\"></i>\n";
            $html.= "                        <span>Inicio</span>\n";
            $html.= "                    </a>\n"; 				
            $html.= "                </li>\n";
        break;
        
      
        case "footer":
            $html.= "            </ul>\n";
            $html.= "        </div> <!-- /.subnav-collapse -->\n";
            $html.= "    </div> <!-- /container -->\n";
            $html.= "  </div> <!-- /subnavbar-inner -->\n";
            $html.= "</div><!-- /subnavbar -->\n";
        break;
    }
    return $html;
}

function xhtml_body_close($type, $floatmess){
    $html ="";
    switch ($type){
        default:
            $html = $floatmess;
            $html.= "\n</body>\n";
            $html.= "</html>\n";
        break;
    }
    return $html;
}
?>