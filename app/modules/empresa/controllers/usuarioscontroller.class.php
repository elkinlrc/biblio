<?php

class Modules_Empresa_Controllers_UsuariosController {

    private $_dom;
    private $_url;
    private $_parameters;
    private $_pathConfig;
    private $_action;

    public function __construct($param, $dom, $path) {
        $this->_parameters = $param;
        $this->_action = $param->get_parameter("action", "");
        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Empresa_Controllers_UsuariosController");
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

    private function crearUsuarios() {
        $obj = new Modules_Empresa_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Usuariosfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Usuarios");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codusuario());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);

//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codusuario", $obj->get_codusuario());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/usuariosCrear.php?";
        // exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function eliminarUsuarios() {
        $obj = new Modules_Empresa_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Usuariosfacade();
        $mensaje = 31;
        if ($facade->delete($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Usuarios");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codusuario());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codusuario", $obj->get_codusuario());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/usuariosAdmin.php?";
        //exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function actualizarUsuarios() {
        $obj = new Modules_Empresa_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Usuariosfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Usuarios");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codusuario());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codusuario", $obj->get_codusuario());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/usuariosAdmin.php?";
//       exit();
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function usuariosBuscar() {

        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So", $opcionBusqueda);
        $this->_parameters->add("Sw", $palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        echo "hola mundo";
        //  exit();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/usuariosListar.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }

    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ----------------------------SÚPER ADMINISTRADOR-------------------------- */
    /* ------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------- */

    private function crearUsuariosSuper() {
        $obj = new Modules_Empresa_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Usuariosfacade();
        $mensaje = 31;
        if ($facade->add($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Usuarios");
            $objaudi->set_tipooperacion(1);
            $objaudi->set_codregistro($obj->get_codusuario());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);

//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codusuario", $obj->get_codusuario());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/usuariosAdminSuper.php?";
        // exit();
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

    private function eliminarUsuariosSuper() {
        $obj = new Modules_Empresa_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Usuariosfacade();
        $mensaje = 31;
        if ($facade->delete($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Usuarios");
            $objaudi->set_tipooperacion(2);
            $objaudi->set_codregistro($obj->get_codusuario());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 11;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codusuario", $obj->get_codusuario());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/usuariosAdminSuper.php?";
        //exit();
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

    private function actualizarUsuariosSuper() {
        $obj = new Modules_Empresa_Model_Usuarios();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Empresa_Model_Usuariosfacade();
        $mensaje = 32;
        if ($facade->update($obj)) {

            $objaudi = new Modules_Empresa_Model_Auditoria();
            $objaudi->set_nombretabla("Usuarios");
            $objaudi->set_tipooperacion(3);
            $objaudi->set_codregistro($obj->get_codusuario());

            $facadeaudi = new Modules_Empresa_Model_AuditoriaFacade();

            $facadeaudi->add($objaudi);


//Si el add fue correcto coloca el mensaje
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codusuario", $obj->get_codusuario());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/empresa/views/usuariosAdminSuper.php?";
//       exit();
        $script = "<script>";
        $script.="window.parent.location.href=\"{$ruta}{$vista}{$cadenaurl}\"";
        $script.="</script>";
        echo $script;
    }

}

?>