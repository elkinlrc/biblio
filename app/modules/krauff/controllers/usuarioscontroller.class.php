<?php
class Modules_Krauff_Controllers_UsuariosController{
    private $_url;
    private $_parameters;
    private $_dom;
    private $_path_config;

public function __construct($parameters, $dom, $path_config){
    $action = $parameters->get_parameter("action","");
    $rc = new ReflectionClass("Modules_Krauff_Controllers_UsuariosController");
    if ($rc->hasMethod($action)){
        $this->_dom = $dom; 
        $this->_parameters = $parameters;
        $this->_path_config = $path_config;
        $this->$action();
    }else{
        $this->stop();
    }
}

private function stop(){
    echo "Moon2 Message:<br/>Controller not implemented";
    header("Status: 400 Bad request", false, 400);
    exit();
}

public function getUrl(){
    return $this->_url;
}

// START: Controller private methods
private function login(){
    $Test = new Moon2_DBmanager_PDO(true);
    $error = $Test->get_msgError();
    if (empty($error)){
        $nombreusuario = $this->_parameters->get_parameter("usu", "");
        $clave = $this->_parameters->get_parameter("cla", "");
        $Usuario = new Modules_Krauff_Model_UsuariosFacade();
        $informacion_usuario = $Usuario->validate($nombreusuario, $clave);
        //var_dump($informacion_usuario);
        if ($informacion_usuario === false){
            $message = urlencode("Error el Usuario o el Password no Existen");
            $this->_url = $this->_path_config["QUIT"]."/response.php?msg=".$message;
            header("Location: {$this->_url}");
        }else{
            $information = explode("@", $informacion_usuario);
            $cod_usuario = $information[0];
            
            $Accesos = new Modules_Krauff_Model_Accesos();
            $Accesos->set_codusuario($cod_usuario);
            $Accesos->set_fechaingreso(date("Y/m/d"));
            $Accesos->set_horaingreso(date("H:i:s"));
            $Accesos->set_ipoculta($_SERVER["REMOTE_ADDR"]);
            $Accesos->set_ipvisible($_SERVER["REMOTE_ADDR"]);
            
            $AccesosFacade = new Modules_Krauff_Model_AccesosFacade();
            $AccesosFacade->add($Accesos);
            
            $vector_funcionalidades = $Usuario->get_functionalities($cod_usuario, $this->_dom["KRAUFF"]["INITIALVALUE"]);
            $cantidad = count($vector_funcionalidades);

            if ($cantidad==0){
                $message = urlencode("You do not have components assigned");
                $this->_url = $this->_path_config["QUIT"]."/response.php?msg=".$message;
                header("Location: {$this->_url}");
            }else{
                session_start();
                $page = "views/index.php";
                $obj_funcionalidades = Moon2_ViewManager_Functionalities::get_Instance();
                $obj_funcionalidades->set_funcArray($vector_funcionalidades);
                $_SESSION[$this->_dom["SESION1"]] = $informacion_usuario;
                $_SESSION[$this->_dom["SESION2"]] = md5($informacion_usuario);
                $_SESSION[$this->_dom["SESION3"]] = serialize($obj_funcionalidades);
                $this->_url = $this->_path_config["MAINPAGE"]."/".$page;
                header("Location: {$this->_url}");
            }
        }
    }else{
        $message = utf8_encode(urlencode($error));
        $this->_url = $this->_path_config["QUIT"]."/response.php?msg=".$message;
        header("Location: {$this->_url}");
    }
}

private function crear(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);
    //$clave = $this->_parameters->get_parameter("nomcampos","0");
    
    if($this->_dom["USER_ID"] != -1){
    $obj->set_codempresa($this->_dom["EMPRESA_ID"]);
    }
    
    $clave_sincifrar = $obj->get_clavesincifrar();
    $obj->set_clave(md5($clave_sincifrar));
   
    
    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    $msg = $this->_dom["FMESSAGE"]["error"];

    if ($FacadeUsuarios->add($obj)){
        $msg = $this->_dom["FMESSAGE"]["success"];
    }
    $cod_usuario = $obj->get_codusuario();
    $FacadeUsuarios->asignarfuncionalidades($cod_usuario);

    $this->_parameters->delete_all();
    $this->_parameters->add("msg", $msg);
    $this->_parameters->add("codusuario", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();
   // exit();
    $this->_url = $this->_path_config["ROOT"]["modules"]."/krauff/views/usuarios_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit(); 
}

private function crearmesero(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);
    
    $obj->set_codempresa($this->_dom["EMPRESA_ID"]);
    $obj->set_codperfil(3);//codigo del mesero
    
    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
   
    if ($FacadeUsuarios->add($obj)){
        $msg2 = $this->_dom["FMESSAGE"]["success"];
    }
    else{
        $msg2 = $this->_dom["FMESSAGE"]["error"];
        
    }
    $this->_parameters->delete_all();
    $this->_parameters->add("msg2", $msg2);
    $this->_parameters->add("codusuario", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();
    //exit();

    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/meseros_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit(); 
}

private function crearcliente(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);
    $combo_tipodoc = $this->_parameters->get_parameter("tipodoc","0");
    $celular1 = $this->_parameters->get_parameter("celular","0");
    $telefono1 = $this->_parameters->get_parameter("telefono","0");
    $celular2 = $this->_parameters->get_parameter("celular2","0");
    $telefono2 = $this->_parameters->get_parameter("telefono2","0");

    if($combo_tipodoc != "NT"){   
        $obj->set_celular($celular1);
        $obj->set_telefono($telefono1);
    }
    else{
        
        $obj->set_celular($celular2);
        $obj->set_telefono($telefono2); 
    }
    
    $obj->set_codempresa($this->_dom["EMPRESA_ID"]);
    $obj->set_codperfil(4);//codigo del cliente
    
    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    

    if ($FacadeUsuarios->add($obj)){
        $msg = $this->_dom["FMESSAGE"]["success"];
    } 
    else{
        $msg = $this->_dom["FMESSAGE"]["error"];
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg", $msg);
    $this->_parameters->add("codcliente", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();
   // exit();

    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/clientes_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit(); 
}

private function crearclientelite(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);
    $cod_venta = $this->_parameters->get_parameter("codventa","0");

    $obj->set_codempresa($this->_dom["EMPRESA_ID"]);
    $obj->set_codperfil(4);//codigo del cliente
    
    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    

    if ($FacadeUsuarios->add($obj)){
        $msg = $this->_dom["FMESSAGE"]["success"];
    } 
    else{
        $msg = $this->_dom["FMESSAGE"]["error"];
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg", $msg);
    $this->_parameters->add("codventa", $cod_venta);
    $cadenaUrl = $this->_parameters->KeyGen();
   // exit();

    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/ventas_crear.php?".$cadenaUrl;
    $script = "<script>\n";
    $script.= "window.parent.location.href = '{$this->_url}';\n";
    $script.= "</script>\n";
    echo $script;
    exit();
}

private function editar(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);
    
    $clave_sincifrar = $obj->get_clavesincifrar();
    $obj->set_clave(md5($clave_sincifrar));
    
    //insercion automatica codigo de la empresa
    $obj->set_codempresa($this->_dom["EMPRESA_ID"]);
    
    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    $msg = 1;
    if ($FacadeUsuarios->update($obj) == false){
        header("Status: 400 Bad request", false, 400);
        $msg = 3;
        exit();
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg", $msg);
    $this->_parameters->add("cod", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();
    //exit();
    $this->_url = $this->_path_config["ROOT"]["modules"]."/krauff/views/usuarios_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit();  
}

private function editarmeseros(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);
    
    $obj->set_codempresa($this->_dom["EMPRESA_ID"]);
    $obj->set_codperfil(3);//codigo del mesero
    
    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    $msg = 1;
    if ($FacadeUsuarios->update($obj) == false){
        header("Status: 400 Bad request", false, 400);
        $msg = 3;
        exit();
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg", $msg);
    $this->_parameters->add("cod", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();
    //exit();
    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/meseros_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit();  
}

private function editarclientes(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);
    $combo_tipodoc = $this->_parameters->get_parameter("tipodoc","0");
    
    $obj->set_codempresa($this->_dom["EMPRESA_ID"]);
    $obj->set_codperfil(4);//codigo del cliente
    
      if($combo_tipodoc == "NT"){   
        $obj->set_fechanacimiento(NULL);
        $obj->set_genero(NULL);
     }elseif ($combo_tipodoc == "CC") 
         {
           $obj->set_contacto(NULL);   
        }else
        {
            $obj->set_contacto(NULL);  
        }
    
    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    $msg3 = 1;
    if ($FacadeUsuarios->update($obj) == false){
        header("Status: 400 Bad request", false, 400);
        $msg3 = 3;
        exit();
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg3", $msg3);
    $this->_parameters->add("codcliente", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();
    //exit();
    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/clientes_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit();  
}

private function eliminar(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);

    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    $msg = 33;
    if ($FacadeUsuarios->delete($obj)){
        $msg = 11;
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg", $msg);
    $this->_parameters->add("cod", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();

    $this->_url = $this->_path_config["ROOT"]["modules"]."/krauff/views/usuarios_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit();
}

private function eliminarmesero(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);

    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    $msg = 33;
    if ($FacadeUsuarios->delete($obj)){
        $msg = 11;
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg", $msg);
    $this->_parameters->add("cod", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();

    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/meseros_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit();
}

private function eliminarcliente(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $obj = $this->_parameters->set_object($obj);

    $FacadeUsuarios = new Modules_Krauff_Model_UsuariosFacade();
    $msg2 = 33;
    if ($FacadeUsuarios->delete($obj)){
        $msg2 = 11;
    }

    $this->_parameters->delete_all();
    $this->_parameters->add("msg2", $msg2);
    $this->_parameters->add("codusuario", $obj->get_codusuario());
    $cadenaUrl = $this->_parameters->KeyGen();

    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/clientes_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit();
}

private function buscar(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $combo_campos = $this->_parameters->get_parameter("nomcampos","0");
    $caja_busqueda = $this->_parameters->get_parameter("buscar","0");

    $this->_parameters->delete_all();
    $this->_parameters->add("cod", $obj->get_codusuario());
    $this->_parameters->add("nomcampos",$combo_campos);
    $this->_parameters->add("buscar",$caja_busqueda);
    $cadenaUrl = $this->_parameters->KeyGen();
    
    $this->_url = $this->_path_config["ROOT"]["modules"]."/krauff/views/usuarios_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit(); 
}

private function buscarmeseros(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $combo_campos = $this->_parameters->get_parameter("nomcampos","0");
    $caja_busqueda = $this->_parameters->get_parameter("buscar","0");

    $this->_parameters->delete_all();
    $this->_parameters->add("cod", $obj->get_codusuario());
    $this->_parameters->add("nomcampos",$combo_campos);
    $this->_parameters->add("buscar",$caja_busqueda);
    $cadenaUrl = $this->_parameters->KeyGen();
    
    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/meseros_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit(); 
}

private function buscarclientes(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $combo_campos = $this->_parameters->get_parameter("nomcampos","0");
    $caja_busqueda = $this->_parameters->get_parameter("buscar","0");

    $this->_parameters->delete_all();
    $this->_parameters->add("cod", $obj->get_codusuario());
    $this->_parameters->add("nomcampos",$combo_campos);
    $this->_parameters->add("buscar",$caja_busqueda);
    $cadenaUrl = $this->_parameters->KeyGen();
    
    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/clientes_admin.php?".$cadenaUrl;
    header("Location: {$this->_url}");
    exit(); 
}

private function buscarclientes2(){
    $obj = new Modules_Krauff_Model_Usuarios();
    $combo_campos = $this->_parameters->get_parameter("nomcampos","0");
    $caja_busqueda = $this->_parameters->get_parameter("buscar","0");

    $this->_parameters->delete_all();
    $this->_parameters->add("cod", $obj->get_codusuario());
    $this->_parameters->add("nomcampos",$combo_campos);
    $this->_parameters->add("buscar",$caja_busqueda);
    $cadenaUrl = $this->_parameters->KeyGen();
    
    $this->_url = $this->_path_config["ROOT"]["modules"]."/pos/views/clientesbuscar_admin.php?".$cadenaUrl;
    header("location: {$this->_url}");
    exit();
}

// END: Controller private methods


}//End class
?>