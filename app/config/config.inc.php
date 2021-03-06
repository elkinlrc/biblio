<?php
//[0] Time zone settings
date_default_timezone_set("America/Lima");


//[1] Session variables
$DOM = array();
$DOM["SESION1"] = "USERDATA";
$DOM["SESION2"] = "SYSTEM_KEY";
$DOM["SESION3"] = "FUNCIONALITIES";


//[2] Paths used to include or require
$path_conf = "config";
$path_include = array();
$path_include[] = "moon2";
$path_include[] = "modules";


//[3] Application paths
//START compatibility with Apache 2.4.4 and lower
//$_SERVER["DOCUMENT_ROOT"] is diferent in apache 2.4.4
    $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
    if (substr($_SERVER["DOCUMENT_ROOT"], -1) !== "/"){
      $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"]."/";
    }
//END compatibility with Apache 2.4 and 2.2


$path_file = str_replace("\\","/", dirname(__FILE__));
$path_root = str_replace($DOCUMENT_ROOT, "", $path_file);
$path_root = str_replace($path_conf, "", $path_root);


//[4] Settings path includes - Linux or Windows
$Includes = "";
$PATH_CONFIG = array();

if (preg_match("/Win/i",$_SERVER["SERVER_SOFTWARE"])){
    $PATH_CONFIG["APP"] = "/".$path_root;
    $separador = ";";
    $path_file = str_replace("/","\\", $DOCUMENT_ROOT);
    $path_file = $path_file.str_replace("/","\\", $path_root);
    foreach ($path_include as $indice => $ruta){
        $Includes.=$path_file.$ruta.$separador;
    }
}else{
    $PATH_CONFIG["APP"] ="/". $path_root;
    $path_file = $DOCUMENT_ROOT;
    $path_file = $path_file.$path_root;
    $separador = ":";
    foreach ($path_include as $indice => $ruta){
        $Includes.=$path_file.$ruta.$separador;
    }
}

//[5] Initializing include path
ini_set("include_path", $Includes);
//echo "<pre>";
//print_r($Includes);
//echo "</pre>";
//[6] Configuration of headers
header("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");


//[7] information databases
require("database.config.php");


//[8] Key to the url
define ("URL_KEY","version2oftheframeworkmoon");
if(!defined('URL_KEY')) {
    throw new Exception("You must define the URL_KEY, system security requires this key");
}


//[9] Loading the framework
require("loader.inc.php");
require("loader/autoloader.class.php");
function __autoload($className) {
    if(class_exists($className)){
        return true;
    }
    $objLoader = new Moon2_Autoloader();
    $path = $objLoader->pathResource($className);
    
    require_once $path;
}
//End
?>
