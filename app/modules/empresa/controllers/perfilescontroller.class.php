<?php
class Modules_Empresa_Controllers_PerfilesController {

    private $_dom;
    private $_url;
    private $_parameters;
    private $_pathConfig;
    private $_action;

    public function __construct($param, $dom, $path) {
        $this->_parameters = $param; 
        $this->_action = $param->get_parameter("action", ""); 
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Empresa_Controllers_PerfilesController");
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

    private function crearPerfil() {
        $obj = new Modules_Empresa_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Perfilesfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {//Si el add fue correcto coloca el mensaje
            
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Perfiles");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codperfil());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);
            
            $mensaje = 11;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/perfilesCrear.php?"; 
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    
   
    
    private function eliminarPerfil() {
        $obj = new Modules_Empresa_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Perfilesfacade();
        $mensaje = 31;
        if ($facade->delete($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Perfiles");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codperfil());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);



//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/perfilesAdmin.php?"; 
//      exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
    
    private function actualizarPerfil() {
        $obj = new Modules_Empresa_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Perfilesfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {
             $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Perfiles");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codperfil());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);
            $mensaje = 12;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/perfilesAdmin.php?"; 
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }
     private function perfilesBuscar() {
      
        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all();//cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So",$opcionBusqueda);
        $this->_parameters->add("Sw",$palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        // echo "hola mundo" ;
    //  exit();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/perfilesListar.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
        
    }
    
    
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ----------------------------SÚPER ADMINISTRADOR-------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    
     private function crearPerfilSuper() {
        $obj = new Modules_Empresa_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Perfilesfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {//Si el add fue correcto coloca el mensaje
            
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Perfiles");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codperfil());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);
            
            $mensaje = 11;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/perfilesAdminSuper.php?"; 
//    //        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }
    
   
    
    private function eliminarPerfilSuper() {
        $obj = new Modules_Empresa_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Perfilesfacade();
        $mensaje = 31;
        if ($facade->delete($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Perfiles");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codperfil());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);



//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/perfilesAdminSuper.php?"; 
//     //        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }
    
    private function actualizarPerfilSuper() {
        $obj = new Modules_Empresa_Model_Perfiles();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Perfilesfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {
             $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Perfiles");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codperfil());
            
            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();
            
            $facadeaudi->add($objaudi);
            $mensaje = 12;
        }
        $this->_parameters->delete_all(); 
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codperfil", $obj->get_codperfil());
        
        $cadenaurl = $this->_parameters->KeyGen(); 
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/perfilesAdminSuper.php?"; 
//        exit();
       //        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }
    
    
    
}
?>