<?php

class Modules_Biblio_Controllers_LibrosController {

    private $_dom;
    private $_url;
    private $_parameters;
    private $_pathConfig;
    private $_action;
    public $_module = "libros";

    public function __construct($param, $dom, $path) {

        $this->_parameters = $param;
        $this->_action = $param->get_parameter("action", "");

        $action = $this->_action;
        $rc = new ReflectionClass("Modules_Biblio_Controllers_" . $this->_module . "Controller");
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
        $obj = new Modules_Biblio_Model_Libros();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Biblio_Model_LibrosFacade();
        $metadatosArray = $this->_parameters->get_parameter("valor", "");
        $detallesArray = $this->_parameters->get_parameter("detalles", "");
        $mensaje = 31;
        if ($facade->add($obj)) {
            $mensaje = 11;

            /*
             * creamos los datos que van a ir en la tabla hija detalles
             */
            $codlibro = $obj->get_codlibro();


            //  $objDetalles = $this->_parameters->set_object($objDetalles);



            echo '<pre>';
            print_r($metadatosArray);
            print_r($detallesArray);
            echo '</pre>';



            foreach ($metadatosArray as $key => $value) {

                /**
                 * si el metadot tiene algun valor procedemos a guardarlo
                 * con el fin de no guardar campos vacios
                 */
                if (!empty($value)) {
                    $metadatos = new Modules_Biblio_Model_MetadatosLibros();
                    $metadatos->set_codlibro($codlibro);
                    $metadatos->set_codmetadato($key);
                    $metadatos->set_valor($value);
                    $metadatosfacade = new Modules_Biblio_Model_MetadatoslibrosFacade();
                    $metadatosfacade->add($metadatos);
                }
            }
            foreach ($detallesArray as $registro) {
                foreach ($registro as $key => $value) {
                    switch ($key) {
                        case 'codigobarras':
                            $_codigobarras = $value;
                            break;
                        case 'edicion':
                            $_edicion = $value;
                            break;
                        case 'codsede':
                            $_codsede = $value;
                            break;
                    }
                }

                $detalles = new Modules_Biblio_Model_Detalles();
                $detalles->set_codlibro($codlibro);
                $detalles->set_fechacreacion(date('Y-m-d'));
                $detalles->set_codsede($_codsede);
                $detalles->set_codigobarras($_codigobarras);
                $detalles->set_edicion($_edicion);
                $detallesfacade = new Modules_Biblio_Model_DetallesFacade();
                $detallesfacade->add($detalles);
            }
        }


        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codlibro", $obj->get_codlibro());
        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/" . $this->_module . "/crear.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    public function buscar() {

        $busqueda = $this->_parameters->get_parameter("buscador", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        
      

        $this->_parameters->add("Sw", $palabraBusqueda);
        $this->_parameters->add("buscador", $busqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/index.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }

    public function buscarIntranet() {
        $opcionBusqueda = $this->_parameters->get_parameter("So", "");
        $palabraBusqueda = $this->_parameters->get_parameter("Sw", "");
        $this->_parameters->delete_all(); //cuando termine de ahcer el proceso limpied get parametrer
        $this->_parameters->add("So", $opcionBusqueda);
        $this->_parameters->add("Sw", $palabraBusqueda);
        $cadenaurl = $this->_parameters->KeyGen();      //mensaje si se modifica la url
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/" . $this->_module . "/index.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl} ");
    }

    private function eliminar() {
        $obj = new Modules_Biblio_Model_Libros();
        $objo = $this->_parameters->set_object($objo);
        $facade = new Modules_Biblio_Model_LibrosFacade();
        $mensaje = 32;
        if ($facade->delete($objo)) {
            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codigo", $obj->get_codlibro());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/" . $this->_module . "/index.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    private function editar() {
        $obj = new Modules_Biblio_Model_Libros();
        $obj = $this->_parameters->set_object($obj);
        $facade = new Modules_Biblio_Model_LibrosFacade();
        $mensaje = 32;
        if ($facade->update($obj)) {


            $mensaje = 12;
        }
        $this->_parameters->delete_all();
        $this->_parameters->add("msg", $mensaje);
        $this->_parameters->add("codigo", $obj->get_codlibro());

        $cadenaurl = $this->_parameters->KeyGen();
        $ruta = $this->_pathConfig["ROOT"]["modules"];
        $vista = "/biblio/views/" . $this->_module . "/editar.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
    }

    
    public function verLibro(){
        $obj = 
        
        
        $vista = "/biblio/views/" . $this->_module . "/libro.php?";
        header("Location: {$ruta}{$vista}{$cadenaurl}"); //Arma la ruta
        
    }

}
