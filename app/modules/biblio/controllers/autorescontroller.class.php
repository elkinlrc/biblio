<?php

class Modules_Biblio_Controllers_AutoresController {
      

    private $_dom;
    private $_url;
    private $_parameters;
    private $_pathConfig;
    private $_action;
    public $_module="autores";

    public function __construct($param, $dom, $path) {
      
        $this->_parameters = $param;
        $this->_action = $param->get_parameter("action", "");
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Biblio_Controllers_".$this->_module."Controller");
        if ($rc->hasMethod($action)) {
         
            $this->_dom = $dom;
            $this->_pathConfig = $path;
            $this->$action();
          
               
        } else {
            echo "Método no encontrado";
            $this->_parameters->show();
            header("Status: 400 Bad request", FALSE, 400);
            exit();
        }
    }

    private function crear() {
        $obj = new Modules_Biblio_Model_Autores();
        $objo = $this->_parameters->set_object($obj);
        $facade = new Modules_Biblio_Model_AutoresFacade();
        
        $mensaje = 31;
        if ($facade->add($objo)) {


            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codautor", $objo->get_codautor());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/".$this->_module."/crear.php?";
//   exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    public function  buscar(){
      
        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So", $opcionBusqueda);
        $this->_parameters->add("Sw", $palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/".$this->_module."/index.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }

    private function eliminar() {
        $obj = new Modules_Biblio_Model_Autores();
        $objo = $this->_parameters->set_object($objo);
        $facade = new Modules_Empresa_Model_Sedesfacade();
        $mensaje = 32;
        if ($facade->delete($objo)) {
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codautor());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/".$this->_module."/index.php?";
//      exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function editar() {
        $obj = new Modules_Biblio_Model_Autores();
        $objo = $this->_parameters->set_object($obj);
        $facade = new Modules_Biblio_Model_AutoresFacade();
        $mensaje = 32;
        if ($facade->update($objo)) {

        
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codautor());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/editar.php?";
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

   

}

