<?php

class Modules_Empresa_Controllers_SedesController {

    private $_dom;
    private $_url;
    private $_parameters;
    private $_pathConfig;
    private $_action;

    public function __construct($param, $dom, $path) {
        $this->_parameters = $param;
        $this->_action = $param->get_parameter("action", "");
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Empresa_Controllers_SedesController");
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

    private function crearSedes() {
        $obj = new Modules_Empresa_Model_Sedes();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Sedesfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Sedes");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codsede());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);



//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codsede());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/sedesCrear.php?";
//   exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function eliminarSedes() {
        $obj = new Modules_Empresa_Model_Sedes();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Sedesfacade();
        $mensaje = 32;
        if ($facade->delete($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Sedes");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codsede());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codsede());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/sedesAdmin.php?";
//      exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function actualizarSedes() {
        $obj = new Modules_Empresa_Model_Sedes();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Sedesfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Sedes");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codsede());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codsede());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/sedesAdmin.php?";
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function sedesBuscar() {

        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So", $opcionBusqueda);
        $this->_parameters->add("Sw", $palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        echo "hola mundo";
        //  exit();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/sedesListar.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }

    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ----------------------------SÚPER ADMINISTRADOR-------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */

    private function crearSedesSuper() {
        $obj = new Modules_Empresa_Model_Sedes();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Sedesfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Sedes");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codsede());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);
            //Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codsede());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/sedesAdminSuper.php?";
        //   exit();
//        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

    private function eliminarSedesSuper() {
        $obj = new Modules_Empresa_Model_Sedes();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Sedesfacade();
        $mensaje = 32;
        if ($facade->delete($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Sedes");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codsede());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codsede());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/sedesAdminSuper.php?";
//      exit();
//        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

    private function actualizarSedesSuper() {
        $obj = new Modules_Empresa_Model_Sedes();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Sedesfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Sedes");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codsede());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codsede", $obj->get_codsede());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/sedesAdminSuper.php?";
//        exit();
//        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";

        echo $script;
        
        
    }

}

?>