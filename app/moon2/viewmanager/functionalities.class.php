<?php
class Moon2_ViewManager_Functionalities {
    private $_funcArray;
    private static $instance = NULL;
    
private function __construct(){}

public function set_funcArray($value){
    $this->_funcArray = $value;
}

public function get_funcArray(){
    return $this->_funcArray;
}

public static function get_Instance($id = NULL) {
    if (self::$instance == NULL) {
        if ($id == NULL){
            self::$instance = new Moon2_ViewManager_Functionalities();
        }else{
            self::$instance = unserialize($_SESSION[$id]);
        }
    }
    return self::$instance;
} 

public function validate($id, $path){
    $stop = true;
    if (!is_array($id) && $id == "*") {
        $stop = false;
    }else{
        foreach ($this->_funcArray as $arr){
            if (in_array($arr["identificador"], $id)){
                $stop = false;
                break;
            }
        }
    }
    if ($stop){
        $msg = "No tiene permisos sobre la funcionalidad indicada";
        $url = $path."/response.php?msg=".urlencode($msg);
        header("location: ".$url);
        exit();
    }
}
    
}//End class
?>