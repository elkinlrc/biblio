<?php
require("../../config/config.inc.php");

$Parameters = new Moon2_Params_Parameters();
$Parameters->verify("POST",true);
$Controller = explode("/", $Parameters->get_parameter("controller",""));

//START
//access session variables for authenticated users
$SECURITY_ID = $Parameters->get_parameter("SECURITY_ID","");
if (empty($SECURITY_ID)){
    $DOM["SECURITY_ID"] = "*";
    require("viewmanager/security.inc.php");    
}
//
//END

if (count($Controller)>2){
    $String_Controller = $Controller[0]."_".$Controller[1]."_Controllers_".$Controller[2];
    
}else{
    $String_Controller = "Modules_".$Controller[0]."_Controllers_".$Controller[1];
}

if (class_exists("$String_Controller", true)) {
   $objController = new $String_Controller($Parameters, $DOM, $PATH_CONFIG);
}else{
    echo "<h1>MOON2 Message:<br />Controller not found</h1>";
    $Parameters->show();
}
?>