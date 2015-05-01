<?php
class Moon2_Autoloader{
    private $_resourceTypes = array();
	
public function __construct(){
    $this->_resourceTypes = $this->initResourceTypes();
}

public function initResourceTypes(){
    $resourceTypes = array();
    $resourceTypes["ModelDb"] = "models/db";
    $resourceTypes["Model"] = "models";
    return $resourceTypes;
}

public function pathResource($nameSpace){
    $path = "../";
    $extension = ".class.php";
    $arrPath = explode("_", $nameSpace);
    $firts = strtolower($arrPath[0]);
    $path = "";
    array_shift($arrPath);
    $last = strtolower(array_pop($arrPath));
    foreach($arrPath as $key => $value){
        if (in_array($value, array_keys($this->_resourceTypes))){
            $path.=strtolower($this->_resourceTypes[$value])."/";
        }else{
            $path.=strtolower($value)."/";
        }
    }
    return $path.$last.$extension;
}

}//End class
?>