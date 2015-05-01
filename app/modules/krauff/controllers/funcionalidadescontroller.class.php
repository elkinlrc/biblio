<?php
class Modules_Krauff_Controllers_FuncionalidadesController{
    private $_dom;
    private $_url;
    private $_action;
    private $_parameters;
    private $_path_config;

public function __construct($parameters, $dom, $path_config){
    $this->_parameters = $parameters;
    $this->_action = $parameters->get_parameter("action","");
    $action = $this->_action;
    $rc = new ReflectionClass("Modules_Krauff_Controllers_FuncionalidadesController");
    if ($rc->hasMethod($this->_action)){
        $this->_dom = $dom; 
        $this->_path_config = $path_config;
        $this->$action();
    }else{
        $this->stop();
    }
}

private function stop(){
    $message = "Moon2 Message:<br/><span style=\"color:red;font-weight: bold\">".$this->_action."</span> ";
    $message.= "Controller not implemented in class <span style=\"color:red;font-weight: bold\">".get_class($this)."</span>";
    echo $message;
    $this->_parameters->show();
    header("Status: 400 Bad request", false, 400);
    exit();
}

public function getUrl(){
    return $this->_url;
}

// START: Controller private methods
private function json_completo(){
    $nodo = 1; //Este es el primer nodo del arbol de funcionalidades
    $seleccionados = array(); //Este arreglo de usa para seleccionar casillas por defecto
    $FacadeFuncionalidades = new Modules_Krauff_Model_FuncionalidadesFacade();
    $arreglo = $FacadeFuncionalidades->obtener_nodo($nodo, $seleccionados);
    echo json_encode($arreglo);
}

private function mover_nodo(){
    $nodo_origen = $this->_parameters->get_parameter("origen","");
    $nodo_destino = $this->_parameters->get_parameter("destino","");
    $modo = $this->_parameters->get_parameter("modo","");
    
    $Funcionalidades = new Modules_Krauff_Model_Funcionalidades();
    $FacadeFuncionalidades = new Modules_Krauff_Model_FuncionalidadesFacade();
    switch ($modo){
        case "before":
            //Cuando coloca el nodo antes
            $nuevo_orden = array();
            $Funcionalidades->set_codfunc($nodo_destino);
            $Funcionalidades = $FacadeFuncionalidades->loadOne($Funcionalidades);
            $nuevo_nodo_destino = $Funcionalidades->get_codpadre();
            $arr_ordenar = $FacadeFuncionalidades->obtener_nodo_simple($nuevo_nodo_destino);
            foreach($arr_ordenar as $indice => $campo){
                if ($nodo_origen == $campo["codfunc"]){
                    unset($arr_ordenar[$indice]);
                }
            }
            if ($FacadeFuncionalidades->actualizar_padre($nodo_origen, $nuevo_nodo_destino)){
                foreach ($arr_ordenar as $indice => $campo){
                    if ($nodo_destino == $campo["codfunc"]){
                        $nuevo_orden[] = array("codfunc" => $nodo_origen);
                    }
                    $nuevo_orden[] = $arr_ordenar[$indice];
                }
                if ($FacadeFuncionalidades->ordenar_nodo_simple($nuevo_orden)){
                    echo "Before: nodo ordenado correctamente";
                    exit();
                }else{
                    header("Status: 400 Bad request", false, 400);
                    echo "Error ordenando el nodo";
                    $msg = $this->_dom["FMESSAGE"]["error"];
                    exit();
                }
            }
        break;
        case "over":
            //Si lo coloca encima de un folder queda como hijo de ese folder en la última posición
            $arr_ordenar = $FacadeFuncionalidades->obtener_nodo_simple($nodo_destino);
            if ($FacadeFuncionalidades->actualizar_padre($nodo_origen, $nodo_destino)){
                print_r($arr_ordenar);
                $i = count($arr_ordenar);
                $arr_ordenar[$i]["codfunc"] = $nodo_origen;
                $arr_ordenar[$i]["nombre"] = "Ultimo registro";
                if ($FacadeFuncionalidades->ordenar_nodo_simple($arr_ordenar)){
                    echo "Over: nodo ordenado correctamente";
                    exit();
                }else{
                    header("Status: 400 Bad request", false, 400);
                    echo "Error ordenando el nodo";
                    $msg = $this->_dom["FMESSAGE"]["error"];
                    exit();
                }
            }else{
                header("Status: 400 Bad request", false, 400);
                echo "Error actualizando cod_padre";
                $msg = $this->_dom["FMESSAGE"]["error"];
                exit();
            }
        break;
        case "after":
            //Cuando coloca el nodo despues
            $nuevo_orden = array();
            $Funcionalidades->set_codfunc($nodo_destino);
            $Funcionalidades = $FacadeFuncionalidades->loadOne($Funcionalidades);
            $nuevo_nodo_destino = $Funcionalidades->get_codpadre();
            $arr_ordenar = $FacadeFuncionalidades->obtener_nodo_simple($nuevo_nodo_destino);
            foreach($arr_ordenar as $indice => $campo){
                if ($nodo_origen == $campo["codfunc"]){
                    unset($arr_ordenar[$indice]);
                }
            }
            if ($FacadeFuncionalidades->actualizar_padre($nodo_origen, $nuevo_nodo_destino)){
                foreach ($arr_ordenar as $indice => $campo){
                    $nuevo_orden[] = $arr_ordenar[$indice];
                    if ($nodo_destino == $campo["codfunc"]){
                        $nuevo_orden[] = array("codfunc" => $nodo_origen);
                    }
                }
                if ($FacadeFuncionalidades->ordenar_nodo_simple($nuevo_orden)){
                    echo "After: nodo ordenado correctamente";
                    exit();
                }else{
                    header("Status: 400 Bad request", false, 400);
                    echo "Error ordenando el nodo";
                    $msg = $this->_dom["FMESSAGE"]["error"];
                    exit();
                }
            }
        break;
        
    }
}

private function eliminar_funcionalida(){

    $cod_usuario = $this->_parameters->get_parameter("codusuario","0");
    $cod_funcionalida = $this->_parameters->get_parameter("codfunc","0"); 
    $funcionalidades = explode(", ", $cod_funcionalida);
    $FacadeFuncionalidades = new Modules_Krauff_Model_FuncionalidadesFacade();

    if($cod_funcionalida != 0){
    
    foreach ($funcionalidades as $valor){
        
     $FacadeFuncionalidades->eliminar_funcionalida($cod_usuario, $valor); 

    }
    
    }
    else{
        echo "1f";       
    }
}

private function insertar_funcionalida(){

    $cod_usuario = $this->_parameters->get_parameter("codusuario","0");
    $cod_funcionalida = $this->_parameters->get_parameter("codfunc","0"); 
    $funcionalidades = explode(", ", $cod_funcionalida);
    $FacadeFuncionalidades = new Modules_Krauff_Model_FuncionalidadesFacade();
    
    if($cod_funcionalida != 0){
    
    foreach ($funcionalidades as $valor){
        
     $FacadeFuncionalidades->insertar_funcionalida($cod_usuario, $valor); 

    }
    
    }
    else{
        echo "1f";       
    }
}
// END: Controller private methods

}//End class
?>