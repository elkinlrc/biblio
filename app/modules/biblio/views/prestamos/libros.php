<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require("../../../../config/config.inc.php");
$DOM["SECURITY_ID"] = array("MNTO_PREST");
require("viewmanager/security.inc.php");
$parametros = new Moon2_Params_Parameters();
$parametros->verify("AJAX_GET", FALSE);
$buscar=$parametros->get_parameter("buscar","");
$facade = new Modules_Biblio_Model_DetallesFacade();
$facade->jsonDetalles($buscar);