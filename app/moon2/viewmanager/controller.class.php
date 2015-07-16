<?php
class Moon2_ViewManager_Controller {
    private $_name;
    private $_theme;
    private $_type;
    private $_sysmenu;
    private $_dataPath;
    private $_javafiles;
    private $_stylefiles;
    private $_dataDomain;
    private $_initialValue;
    private $_floatmess;
    private $_navigationBar;
    private $_defaultComponent;
    
public function __construct() {
    global $DOM;
    global $PATH_CONFIG;

    $this->_sysmenu = true;
    $this->_type = "SYSTEM";
    $this->_floatmess = array();
    $this->_javafiles = array();
    $this->_stylefiles = array();
    $this->_navigationBar = array();
    $this->_name = "MOON2 Page";
    $this->_theme = "bootstrap01";
    $this->_dataPath = &$PATH_CONFIG;
    $this->_dataDomain = &$DOM;
    $this->_defaultComponent = "Inicio";
    $this->_initialValue = $this->_dataDomain["KRAUFF"]["INITIALVALUE"];
}
    
public function open(){
    $menuHtml = "";
    if ($this->_sysmenu){
      //  $menuHtml.= xhtml_menu("header", $this->_dataPath["MAINPAGE"], $this->_defaultComponent);
        $menuHtml.= $this->buildMenu($this->_initialValue);
       // $menuHtml.= xhtml_menu("footer", $this->_dataPath["MAINPAGE"], "");
    }
    
    $html = xhtml_header($this->_name, $this->_dataPath, $this->_theme, $this->_javafiles, $this->_stylefiles);
    $html.= xhtml_body_open($this->_type, $this->_dataPath, $this->_dataDomain,$menuHtml);
    //$html.= $menuHtml;
    
    
    $html.= $this->buildNavigationbar();
    
    return $html;
}

public function close(){
    $floatmess = "";
    if(count($this->_floatmess)>0){
        $floatmess = "\n<script>\n";
        foreach($this->_floatmess as $key => $value){
            $floatmess.= "    $.msgGrowl ({type: '".$value["type"]."', title: '".$value["title"]."', text: '".$value["text"]."'});\n";
        }
        $floatmess.= "</script>";
    }
    $html = xhtml_body_close($this->_type, $floatmess);
    return $html;
}

public function set_name($name) {
    $this->_name = $name;
}

public function set_type($type) {
    $this->_type = $type;
}

public function set_sysmenu($value){
    $this->_sysmenu = $value;  
}

public function set_component($value){
    $this->_defaultComponent = $value;
}

public function getView(){
    $fileName = substr(strrchr($_SERVER["SCRIPT_NAME"], "/"), 1);
    $view = "xhtmls/view_".$fileName;
    return $view;
}

public function add_style($path){
    $html = "<link rel=\"stylesheet\" href=\"{$path}\" type=\"text/css\" />";
    $this->_stylefiles[] = $html;
}

public function add_javascript($path){
    $html = "<script language=\"javascript\" src=\"{$path}\" type=\"text/javascript\"></script>";
    $this->_javafiles[] = $html;
}

public function floating_message($idMsg, $idDom, $title, $text){
    if (!empty($idMsg) && $idMsg==$idDom){
        $type = "";
        $id = substr($idDom, 0, 1); 
        foreach ($this->_dataDomain["FMESSAGE"] as $key => $value){
            if ($id == $value){$type = $key;}
        }
        $this->_floatmess[$idMsg]["type"] = $type;
        $this->_floatmess[$idMsg]["title"] = $title;
        $this->_floatmess[$idMsg]["text"] = $text;
    }
}

public function headerTable($dataArray, $order, $Parameters){
    $tmp_params = clone $Parameters;
    $xhtml = "<thead>\n";
    $xhtml.= "<tr>\n";
    foreach ($dataArray as $key => $value){
        if (!empty($value["name"])){
            $icon = " ";
            $tmp_params->add("order",$key);
            $url_params = $tmp_params->keyGen(false, true);
            $xhtml.= "<th".$value["size"].">";
            if (!empty($value["order"]) && $order == $key){
                $icon = "<i class=\"icon-arrow-down\"></i> ";
            }
            $xhtml.= "<a href=\"".$_SERVER['PHP_SELF']."?".$url_params."\">{$icon}".$value["name"]."</a>";
            $xhtml.= "</th>\n";
        }else{
            $xhtml.= "<th>&nbsp;</th>\n";
        }
    }
    $xhtml.= "<tr>\n";
    $xhtml.= "</thead>\n";
    return $xhtml;
}


//Methods to load the system menu - start
//**************************************************************************************
private function getArray($codfunc){
    $newArrayData = array();
    $arrayData = $this->_dataDomain["MENUSYSTEM"];
    foreach ($arrayData as $key => $field){
        if ($field["codpadre"] == $codfunc){
            $newArrayData[$key] = $arrayData[$key];
        }
    }
    return $newArrayData;
}

public function buildMenu($parent){
    $html= "";
    $arrayData = $this->_dataDomain["MENUSYSTEM"];
    
    //var_dump($arrayData);
    
    foreach ($arrayData as $key => $field){
        if ($field["codpadre"] == $parent){
            $active = "";
            if ($this->_defaultComponent == $field["nombre"]){
                $active = " active";
            }
            $html.= "<li class=\"dropdown{$active}\">\n";
            $html.= "     <a href=\"javascript:(0);\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\n";
            $html.= "         <i class=\"".$field["icono"]."\"></i>\n";
            $html.= "         <span>".$field["nombre"]."</span>\n";
            $html.= "         <b class=\"caret\"></b>\n";
            $html.= "     </a>\n";
            $newArrayData = $this->getArray($field["codfunc"]);
            $html.= $this->menu($newArrayData);
            $html.= "</li>\n"; 
        }
    }
    
    return $html;
}

private function menu($arrayData){
    $html = "";
    $html.= "<ul class=\"dropdown-menu\">\n";
    foreach ($arrayData as $key => $field){
        $numChildrenCurrent = $field["hijos"];
        if($numChildrenCurrent > 0){
            $newArrayData = $this->getArray($field["codfunc"]);
            $html.= "  <li class=\"dropdown-submenu\">\n";
            // $html.= "  <li class=\"dropdown-menu\">\n";
            $html.= "    <a tabindex=\"-".$field["codpadre"]."\" href=\"".$field["urlpagina"]."\">".$field["nombre"]."</a>\n";
            $html.= $this->levelOne($newArrayData);
            $html.= "  </li>\n";
        }else{
            $html.= "<li><a tabindex=\"-".$field["codpadre"]."\" href=\"".$this->_dataPath["ROOT"]["modules"]."/".$field["urlpagina"]."\">".$field["nombre"]."</a></li>\n";
        }
    }
    $html.= "</ul>\n";
    return $html;  
}

private function levelOne($arrayData){
    $html = "";
    $html.= "<ul class=\"dropdown-menu\">\n";
    foreach ($arrayData as $key => $field){
        $numChildrenCurrent = $field["hijos"];
        if ($numChildrenCurrent>0){
            $newArrayData = $this->getArray($field["codfunc"]);
            $html.= "<li class=\"dropdown-submenu\">\n";
            $html.= "  <a tabindex=\"-".$field["codpadre"]."\" href=\"".$field["urlpagina"]."\">".$field["nombre"]."</a>\n";
            $html.= $this->levelTwo($newArrayData);
        }else{
            $html.= "<li><a tabindex=\"-".$field["codpadre"]."\" href=\"".$this->_dataPath["ROOT"]["modules"]."/".$field["urlpagina"]."\">".$field["nombre"]."</a></li>\n";
            //$html.= "<li class=\"divider\"></li>";
        }
    }
    $html.= "</ul>\n";
    return $html;
}

private function levelTwo($arrayData){
    $html = "";
    $html.= "<ul class=\"dropdown-menu\">\n";
    foreach ($arrayData as $key => $field){
        $numChildrenCurrent = $field["hijos"];
        if($numChildrenCurrent > 0){
            //Si desea otro nivel hay que colocarlo acá
            $html.= "<li><a tabindex=\"-".$field["codpadre"]."\" href=\"".$this->_dataPath["ROOT"]["modules"]."/".$field["urlpagina"]."\">".$field["nombre"]."</a></li>\n";
        }else{
            $html.= "<li><a tabindex=\"-".$field["codpadre"]."\" href=\"".$this->_dataPath["ROOT"]["modules"]."/".$field["urlpagina"]."\">".$field["nombre"]."</a></li>\n";
        }
    }
    $html.= "</ul>\n";
    return $html;  
}
//Methods to load the system menu - end
//**************************************************************************************


//Navigation Bar start
//**************************************************************************************
public function add_navigation($text, $url) {
    $i = count ($this->_navigationBar);
    $this->_navigationBar[$i]["text"] = trim($text);
    $this->_navigationBar[$i]["url"] = $url;
}

public function buildNavigationbar(){
    $xhtml = "";
    
    
    $total = count ($this->_navigationBar);
    
    if ($total>0){
        $last = $total - 1;
        $xhtml.= "<div class=\"main\">\n";
        $xhtml.= "  <div class=\"container\">\n";
        $xhtml.= "      <div class=\"row\">\n";
        $xhtml.= "          <div class=\"col-md-12\">\n";
        $xhtml.= "              <ul class=\"breadcrumb\">\n";
        for ($i=0; $i<$total; $i++){
            if ($i==$last){
                $xhtml.= "<li class=\"active\">".$this->_navigationBar[$i]["text"]."</li>\n";
            }else{
                $xhtml.= "<li><a href=\"".$this->_navigationBar[$i]["url"]."\">".$this->_navigationBar[$i]["text"]."</a></li>\n";
            }
        }
        $xhtml.= "              </ul>\n";
        $xhtml.= "          </div>\n";
        $xhtml.= "      </div>\n";
        $xhtml.= "  </div>\n";
        $xhtml.= "</div>\n";
    }
    
    return $xhtml;
}
//**************************************************************************************
//Navigation Bar end

}// End class
?>