<?php
class Moon2_Params_Parameters{
    private $_param;
    private $_method;
    private $_keyPublic;
    private $_arrInitial;
    private $_urlNew;
    private $_stringValue;
    private $_inputKey;
    private $_outputKey;

function __construct($selected_method="md5"){
    $this->_request_method = "";
    $this->_method = $selected_method;
    $this->_keyPublic = URL_KEY;
    $this->delete_all();
}

public function get_parameters(){
    return $this->_param;
}

public function verify($request_method, $param_mandatory = true, $treeview = false){
    $RMS = $_SERVER["REQUEST_METHOD"];
    if ($request_method != "AJAX_GET" && $request_method != "AJAX_POST"){
        if ($request_method != $RMS ){
            $this->stoped();
        }
    }
    switch($request_method){
        case "GET":
            $result = $this->verify_params($_SERVER["QUERY_STRING"]);
            if ($param_mandatory && empty($_SERVER["QUERY_STRING"])){
                $this->stoped();
            }
            if(!$result && !$treeview){
                $this->stoped();
            }
        break;
        case "POST":
            $this->_param = $_POST;
            if (!empty($_FILES)){
                $this->_param = array_merge($_POST, $_FILES);
            }
        break;
        case "AJAX_GET":
            $this->_param = $_GET;
        break;
        case "AJAX_POST":
            $this->_param = $_POST;
        break;
    }
    return $this->_param;
}

public function get_parameter($name, $default) {
    $value = $default;
    if(isset($this->_param[$name])) {
        if (is_array($this->_param[$name])){
            $value = $this->_param[$name];
        }else{
            $value = urldecode($this->_param[$name]);
        }
        if (empty($value)){
        $value = $default;
        }
    }
    return $value;
}

public function delete_all() {
    $this->_urlNew = "";
    $this->_param = array();
    $this->_arrInitial = array();
}

public function add($nombre,$valor) {
    $this->_param[$nombre]=$valor;
}

public function add_array($parametros) {
    if(is_array($parametros) && count($parametros)>0) {
        $this->_param = array_merge($this->_param,$parametros);
    }
}

public function delete_param($name) {
    unset($this->_param[$name]);
}

public function keyGen($delete_all=true, $ampersand=true) {
	if(!is_bool($delete_all)) {
		throw new Exception("Debe pasar un booleano que indica si se borran o no los parametros despues de generar la cadena de URL.");
	}
	$this->url_procces();
	if ($ampersand){
		$Url = implode("&",$this->_arrInitial)."&url_k=".$this->_urlNew;
	}else{
		$Url = implode("&amp;",$this->_arrInitial)."&amp;url_k=".$this->_urlNew;
	}
	if($delete_all) {
		$this->delete_all();
	}
	return $Url;
}

private function set_keys(){
    if(!in_array($this->_method,array("sh1","md5"))){
        exit("El método ".$this->_method." NO es soportado");
    }
    $selected_method = $this->_method;
    $llave = $this->_keyPublic;
    if (strlen($llave)>64){
        $llave=pack("H32",$selected_method($llave));
    }elseif(strlen($llave)<64){
        $llave=str_pad($llave,64,chr(0));
    }

    $this->_inputKey  =substr($llave,0,64) ^ str_repeat(chr(0x36),64);
    $this->_outputKey = substr($llave,0,64) ^ str_repeat(chr(0x5c),64);
}

private function url_procces(){
    $arrParams=array();
    foreach($this->_param as $key => $value) {
        $this->_param[$key]=urlencode($value);
    }
    ksort($this->_param);
    $dataValue = "";
    foreach($this->_param as $key => $valor){
        $dataValue.=$key . $valor;
        $arrParams[]=$key."=".$valor;
    }
    $selected_method=$this->_method;
    $this->_arrInitial = $arrParams;
    $this->_stringValue = $dataValue;
    $this->set_keys();
    $this->_inputKey;
    $this->_outputKey;
    $Pack = pack("H32",$selected_method($this->_inputKey . $this->_stringValue));
    $this->_urlNew= $selected_method($this->_outputKey . $Pack);
}

private function verify_params($querystring){
    if(empty($querystring)) return true;
    $temp = explode("&",$querystring);
    for($i=0; $i<count($temp);$i++) {
        $art = explode("=",$temp[$i],2);
        $this->_param[$art[0]]=urldecode($art[1]);
    }
    $cadena_llave=$this->_param["url_k"];
    $this->delete_param("url_k");
    $this->url_procces();
    if ($cadena_llave!= $this->_urlNew) {
        return false;
    }else{
        return true;
    }
}

private function stoped(){
    echo "Acceso no Permitido";
    exit();
}

public function show(){
    echo "<pre>";
    print_r($this->_param);
    echo "</pre>";
}

private function is_parameter($name){
    $lowerName = strtolower($name);
    foreach ($this->_param as $index => $value){
        $lowerValue = strtolower($index);
        if ($lowerName == $lowerValue) return true;
    }
    return false;
}

private function get_iparameter($name){
    $lowerName = strtolower($name);
    foreach ($this->_param as $index => $value){
        $lowerValue = strtolower($index);
        if ($lowerName == $lowerValue) return $value;
    }
    return false;
}

public function set_object($objName){
    $set_method = "set";
    $Obj = new $objName;
    $Ro = new ReflectionObject($Obj);
    $properties = $Ro->getProperties();
    foreach($properties as $property){ 
        $name = $property->getName();
        $name = substr($name, 1);
        if ($this->is_parameter($name)){
            $method = $set_method."_".$name;
            if (isset($this->_param[$name])){
                $value = $this->_param[$name];
            }else{
                $value = $this->get_iparameter($name); 
            }
            $Obj->$method($value);
        }
    }
    return $Obj;
}

}// FIN DE LA CLASE

?>