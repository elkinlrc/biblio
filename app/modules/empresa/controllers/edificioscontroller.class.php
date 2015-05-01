<?php
class Modules_Empresa_Controllers_EdificiosController {

    private $_dom;
    private $_url;
    private $_parameters;
    private $_pathConfig;
    private $_action;

    public function __construct($param, $dom, $path) {
        $this->_parameters = $param; 
        $this->_action = $param->get_parameter("action", ""); 
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Empresa_Controllers_EdificiosController");
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

    private function crearEdificio() {
        $obj = new Modules_Empresa_Model_Edificios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Edificiosfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Edificio");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codedificio());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);
            
            $mensaje = 11;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codedificio", $obj->get_codedificio());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/edificiosCrear.php?"; 
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    
    private function crearRELOFICINA() {
        $cod_edificio = $this->_parameters->get_parameter("codedificio",0);
        $cod_dependencia= $this->_parameters->get_parameter("coddependencia",0);
        
        $facadeEdificio= new Modules_Empresa_Model_Edificiosfacade();
        $mensaje = 31;
        if ($facadeEdificio->agregarRel_EdifOf($cod_edificio, $cod_dependencia) ) {//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/rel_Edif_OficCrear.php?"; 
     // exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    
    private function eliminarEdificio() {
        $obj = new Modules_Empresa_Model_Edificios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Edificiosfacade();
        $mensaje = 31;
        if ($facade->delete($obj)) {//Si el add fue correcto coloca el mensaje
            
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Edificio");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codedificio());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);
            
            $mensaje = 11;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codedificio", $obj->get_codedificio());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/edificiosAdmin.php?"; 
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    
    private function actualizarEdificio() {
        $obj = new Modules_Empresa_Model_Edificios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Edificiosfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {//Si el add fue correcto coloca el mensaje
            
             $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Edificio");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codedificio());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);
            
            
            $mensaje = 12;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codedificio", $obj->get_codedificio());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/edificiosAdmin.php?"; 
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    
    
    private function edificiosBuscar() {
      
        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all();//cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So",$opcionBusqueda);
        $this->_parameters->add("Sw",$palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
         //echo "hola mundo" ;
    //  exit();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/edificiosListar.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
        
    }
    
    private function RELusuBuscar() {

        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So", $opcionBusqueda);
        $this->_parameters->add("Sw", $palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        //  exit();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/rel_Edif_OficListar.php?";
        //echo "hola mundo" ;
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }
    
     private function eliminarRel_na() {
        $obj = new Modules_Empresa_Model_Edificios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Edificiosfacade();

        
        $facade->eliminarRel_na($_GET["codedificio"], $_GET["coddependencia"]);
        $mensaje = 11;
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codedificio", $obj->get_codedificio());



        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/rel_Edif_OficAdmin.php?";

        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ----------------------------SÚPER ADMINISTRADOR-------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */

    private function crearEdificiosSuper() {
        $obj = new Modules_Empresa_Model_Edificios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Edificiosfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Edificios");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codedificio());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);
            //Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codedificio", $obj->get_codedificio());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/edificiosAdminSuper.php?";
        //   exit();
//        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

    private function eliminarEdificiosSuper() {
        $obj = new Modules_Empresa_Model_Edificios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Edificiosfacade();
        $mensaje = 32;
        if ($facade->delete($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Edificios");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codedificio());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codedificio", $obj->get_codsede());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/edificiosAdminSuper.php?";
//      exit();
//        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

    private function actualizarEdificiosSuper() {
        $obj = new Modules_Empresa_Model_Edificios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Edificiosfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Edificios");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_edificio());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codedificio", $obj->get_codedificio());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/edificiosAdminSuper.php?";
//        exit();
//        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";

        echo $script;
        
        
    }
    
    
    
}
?>