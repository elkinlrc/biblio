<?php
session_start();
//Verifica las condiciones mínimas para iniciar sesion
if(isset($_SESSION[$DOM["SESION1"]])) {
    $user_information = explode("@", $_SESSION[$DOM["SESION1"]]);
    $DOM["USER_ID"] = $user_information[0];
    $DOM["USER_NAME"] = $user_information[1];
    $DOM["FULLUSER_NAME"] = $user_information[2];
    $DOM["PROFILE_NAME"] = $user_information[3];
    $DOM["PROFILE_ID"] = $user_information[4];

    $validate = md5($_SESSION[$DOM["SESION1"]]);
    if ($validate != $_SESSION[$DOM["SESION2"]]){
        $msg = urlencode("Failed Access");
        header("Location: ".$PATH_CONFIG["QUIT"]."/response.php?msg={$msg}");
        exit();
    }
    unset($user_information);
}else{
    $msg = urlencode("Intrusion System Security");
    header("Location: ".$PATH_CONFIG["QUIT"]."/response.php?msg={$msg}");
    exit();
}

//Carga las funciuonalidades y verifica los permisos
$Func = Moon2_ViewManager_Functionalities::get_Instance($DOM["SESION3"]);
$Func->validate($DOM["SECURITY_ID"], $PATH_CONFIG["QUIT"]);
$DOM["MENUSYSTEM"] = $Func->get_funcArray();
?>