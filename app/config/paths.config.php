<?php
// Base path system = $PATH_CONFIG["APP"]


// Root folder for attachments
$rootFolder = "/web_files";
$PATH_CONFIG["WEBFILES"] = $rootFolder;


// Examples of folders to attach
$PATH_CONFIG["MOON_GEN"] = $PATH_CONFIG["WEBFILES"]."/moongen2";
$PATH_CONFIG["RECURSOS"] = $PATH_CONFIG["WEBFILES"]."/recursos";
//Componente TRabajo de Grado
$PATH_CONFIG["TRAGRA_FORMATOS"] = $PATH_CONFIG["WEBFILES"]."/trabajosgrado/formatos";
$PATH_CONFIG["TRAGRA_CONSIGNA"] = $PATH_CONFIG["WEBFILES"]."/trabajosgrado/consignaciones";


// Basic paths for the framework
$PATH_CONFIG["ROOT"]["images"]      = $PATH_CONFIG["APP"]."images";
$PATH_CONFIG["ROOT"]["moon"]        = $PATH_CONFIG["APP"]."moon2";
$PATH_CONFIG["ROOT"]["search"]      = $PATH_CONFIG["APP"]."moon2/search";
$PATH_CONFIG["ROOT"]["modules"]     = $PATH_CONFIG["APP"]."modules";
$PATH_CONFIG["ROOT"]["javascripts"] = $PATH_CONFIG["APP"]."moon2/javas";
$PATH_CONFIG["MAINPAGE"]            = $PATH_CONFIG["ROOT"]["modules"]."/biblio";
$PATH_CONFIG["QUIT"]                = $PATH_CONFIG["ROOT"]["modules"]."/krauff/views";


//$PATH_CONFIG["ROOT"]["processform"] = $PATH_CONFIG["ROOT"]["moon"]."/viewmanager";
//en revision 1
$PATH_CONFIG["ROOT"]["treeview"] 	= "moon2/treeview";
$PATH_CONFIG["ROOT"]["hidelayer"] 	= "moon2/hidelayer";
$PATH_CONFIG["ROOT"]["messagebox"] 	= "moon2/messagebox";
$PATH_CONFIG["ROOT"]["calendar"] 	= "moon2/calendar/src";
$PATH_CONFIG["ROOT"]["timer"] 		= "moon2/datetime/timepicker";



//en revision 1

?>