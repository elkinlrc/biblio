<?php

class Modules_Empresa_Controllers_NacionalidadController {

    private $_dom;
    private $_url;
    private $_parameters;
    private $_pathConfig;
    private $_action;

    public function __construct($param, $dom, $path) {
        $this->_parameters = $param;
        $this->_action = $param->get_parameter("action", "");
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Empresa_Controllers_NacionalidadController");
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

    private function crearNacionalidad() {
        $obj = new Modules_Empresa_Model_Nacionalidad();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Nacionalidadfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {//Si el add fue correcto coloca el mensaje
            echo "getcodi" . $obj->get_codnacionalidad();
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Nacionalidad");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codnacionalidad());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);

            $mensaje = 11;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codnacionalidad", $obj->get_codnacionalidad());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/nacionalidadCrear.php?";
//   exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function crearRELUSUARIOS() {
        $codnacionalidad = $this->_parameters->get_parameter("codnacionalidad", 0);
        $codusuario = $this->_parameters->get_parameter("codusuario", 0);

        $facadeNacionalidad = new Modules_Empresa_Model_Nacionalidadfacade();
        $mensaje = 31;
        if ($facadeNacionalidad->agregarRel_UsuNa($codnacionalidad, $codusuario)) {//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/rel_Usu_NacCrear.php?";
        //exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function eliminarNacionalidad() {
        $obj = new Modules_Empresa_Model_Nacionalidad();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Nacionalidadfacade();
        $mensaje = 31;
        if ($facade->delete($obj)) {
            echo "getcodi" . $obj->get_codnacionalidad();
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Nacionalidad");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codnacionalidad());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codnacionalidad", $obj->get_codnacionalidad());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/nacionalidadAdmin.php?";
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function actualizarNacionalidad() {
        $obj = new Modules_Empresa_Model_Nacionalidad();
        $obj = $this->_parameters->set_object($obj);


        $facade = new Modules_Empresa_Model_Nacionalidadfacade();
        $mensaje = 32;
        // $obj2=$facade->find($obj->get_codnacionalidad());
        //echo $obj2->nacionalidad;
        //exit();
        if ($facade->update($obj)) {

                 echo "getcodi" . $obj->get_codnacionalidad();
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Nacionalidad");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codnacionalidad());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);
//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codnacionalidad", $obj->get_codnacionalidad());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/nacionalidadAdmin.php?";
//        exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function nacionalidadBuscar() {

        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So", $opcionBusqueda);
        $this->_parameters->add("Sw", $palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        //  exit();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/nacionalidadListar.php?";
        //echo "hola mundo" ;
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }

    private function RELnaBuscar() {

        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So", $opcionBusqueda);
        $this->_parameters->add("Sw", $palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        //  exit();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/rel_Usu_NacListar.php?";
        //echo "hola mundo" ;
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }

    private function eliminarRELna() {
        $obj = new Modules_Empresa_Model_Nacionalidad();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Nacionalidadfacade();

        $facade = new Modules_Empresa_Model_Nacionalidadfacade();
        $facade->eliminarRel_UsuNa($_GET["codnacionalidad"], $_GET["codusuario"]);
        $mensaje = 11;
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codnacionalidad", $obj->get_codnacionalidad());



        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/rel_Usu_NacAdmin.php?";

        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ----------------------------SÚPER ADMINISTRADOR-------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */

    private function crearNacionalidadSuper() {
        $obj = new Modules_Empresa_Model_Nacionalidad();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Nacionalidadfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {//Si el add fue correcto coloca el mensaje
            echo "getcodi" . $obj->get_codnacionalidad();
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Nacionalidad");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codnacionalidad());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);

            $mensaje = 11;
        }

        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codnacionalidad", $obj->get_codnacionalidad());

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

    private function actualizarNacionalidadSuper() {
        $obj = new Modules_Empresa_Model_Nacionalidad();
        $obj = $this->_parameters->set_object($obj);


        $facade = new Modules_Empresa_Model_Nacionalidadfacade();
        $mensaje = 32;
        // $obj2=$facade->find($obj->get_codnacionalidad());
        //echo $obj2->nacionalidad;
        //exit();
        if ($facade->update($obj)) {//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codnacionalidad", $obj->get_codnacionalidad());

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

    private function eliminarNacionalidadSuper() {
        $obj = new Modules_Empresa_Model_Nacionalidad();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Nacionalidadfacade();
        $mensaje = 31;
        if ($facade->delete($obj)) {
            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Nacionalidad");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codedificio());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codnacionalidad", $obj->get_codnacionalidad());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/nacionalidadAdmin.php?";
//        exit();
        //  header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta

        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

}

?>