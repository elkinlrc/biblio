<?php
class Moon2_Forms_Form{
	private $_type;
	private $_id;
	private $_fieldName;
	private $_arrValues=array();
	private $_selectedId;
	private $_options;
        private $_style;
	private $_dataType;

public function __construct(){
    $this->_dataType = "normal";
}

public function set_dataType($value){
	$this->_dataType = $value;
}

public function addObject($type, $fieldName, $arrValues, $selectedId, $options, $style=""){
	$this->_type = $type;
	$this->_fieldName = $fieldName;
	$this->_arrValues = $arrValues;
	$this->_selectedId = $selectedId;
	$this->_options = $options;
	$this->_id = $this->checkId($fieldName);
	$this->_style = $style;
	$xhtml = $this->buildHeader();
	$xhtml.= $this->buildBody();
	$xhtml.= $this->buildFooter();
	return $xhtml;
}

private function buildHeader(){
    $xhtml = "";
    switch($this->_type){
        case "MenuList":
            $class_style = "class=\"".$this->_style."\"";
            if (empty($this->_style)){
                $class_style = "";
            }
            $xhtml = "<select name=\"{$this->_fieldName}\" id=\"{$this->_id}\" {$this->_options} {$class_style}>\n";
        break;
    }
    return $xhtml;
}

private function buildFooter(){
	$xhtml = "";
	switch($this->_type){
		case "MenuList":
			$xhtml = "</select>\n";
		break;
	}
	return $xhtml;
}

private function buildBody(){
    $xhtml = "";
    switch($this->_type){
        case "MenuList":
            foreach($this->_arrValues as $key => $value){
                $check = "";
                $selected = $this->checkSelected($key);
                if ($selected) $check = " selected=\"selected\"";
                $xhtml.= "<option value=\"{$key}\"{$check}>{$value}</option>\n";
            }
        break;
        case "CheckBox":
                foreach($this->_arrValues as $key => $value){
                        $check = "";
                        $selected = $this->checkSelected($key);
                        if ($selected) $check = " checked=\"checked\"";
                        $xhtml.="<input type=\"checkbox\" name=\"{$this->_fieldName}\" id=\"{$this->_id}\" value=\"{$key}\"{$check} />&nbsp;{$value}<br />\n";
                }
        break;
        case "CheckBoxHorizontal":
                foreach($this->_arrValues as $key => $value){
                        $check = "";
                        $selected = $this->checkSelected($key);
                        if ($selected) $check = " checked=\"checked\"";
                        $xhtml.="<input type=\"checkbox\" name=\"{$this->_fieldName}\" id=\"{$this->_id}\" value=\"{$key}\"{$check} />&nbsp;{$value}\n";
                }
        break;
        case "Radio":
                foreach($this->_arrValues as $key => $value){
                        $check = "";
                        $selected = $this->checkSelected($key);
                        if ($selected) $check = " checked=\"checked\"";
                        $class_style = $this->_style;
                        $xhtml.="<input type=\"radio\" name=\"{$this->_fieldName}\" id=\"{$this->_id}\" value=\"{$key}\"{$check} {$class_style}/>&nbsp;{$value}<br />\n";
                }
        break;
         case "RadioHorizontal":
                foreach($this->_arrValues as $key => $value){
                        $check = "";
                        $selected = $this->checkSelected($key);
                        if ($selected) $check = " checked=\"checked\"";
                        $xhtml.="<input type=\"radio\" name=\"{$this->_fieldName}\" id=\"{$this->_id}\" value=\"{$key}\"{$check} />&nbsp;{$value}\n";
                }
        break;
    }
    return $xhtml;
}

private function checkSelected($key){
	$selected = false;
	if ($this->_dataType!="POSTGRESQL"){
		if (is_array($this->_selectedId)){
			if (in_array($key, array_keys($this->_selectedId))){
				$selected = true;
			}
		}else{
			if ($this->_selectedId == $key){
				$selected = true;
			}
		}
	}else{
		$newValue= explode(",",substr($this->_selectedId,1,(strlen($this->_selectedId)-2)));
		foreach($newValue as $llave => $valor){
			if ($valor == $key){
				$selected = true;
			}
		}

	}
	return $selected;
}

private function checkId($fieldName){
    $id = $fieldName;
    if(substr($fieldName,-2) == "[]") {
            $id = substr($fieldName, 0, strlen($fieldName)-2);
    }
    return $id;
}

}//End class
?>