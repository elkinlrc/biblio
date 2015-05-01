<?php
class Moon2_Pagination_Controllers_PagerController{
    private $_dom;
    private $_url;
    private $_action;
    private $_parameters;
    private $_path_config;

public function __construct($parameters, $dom, $path_config){
    $this->_parameters = $parameters;
    $this->_action = $parameters->get_parameter("action","");
    $action = $this->_action;
    $rc = new ReflectionClass("Moon2_Pagination_Controllers_PagerController");
    if ($rc->hasMethod($this->_action)){
        $this->_dom = $dom; 
        $this->_path_config = $path_config;
        $this->$action();
    }else{
        $this->stop();
    }
}

private function stop(){
    $message = "Moon2 Message:<br/><span style=\"color:red;font-weight: bold\">".$this->_action."</span> ";
    $message.= "Controller not implemented in class <span style=\"color:red;font-weight: bold\">".get_class($this)."</span>";
    echo $message;
    $this->_parameters->show();
    header("Status: 400 Bad request", false, 400);
    exit();
}

// START: Controller private methods
private function goTopage(){
    //$this->_parameters->show();
    $page = $this->_url = $this->_parameters->get_parameter("pg", "");
    $limit_num = $this->_url = $this->_parameters->get_parameter("limnum", "");
    $new_page = ($page * $limit_num) - $limit_num;
    $this->_url = $this->_parameters->get_parameter("page_from", "");
    
    foreach ($this->_parameters->get_parameters() as $key => $value){
        $this->_parameters->add($key, $value);
    }
    
    $this->_parameters->add("npage", $new_page);
    $parametersTOdelete = array ("pg","action", "page_from", "controller", "btngp", "limnum", "msg");
    foreach($parametersTOdelete as $key => $value){
        $this->_parameters->delete_param($value);
    }
    
    $key = $this->_parameters->keyGen();
    header("Location: {$this->_url}?{$key}");
}
// END: Controller private methods


}//End class
?>