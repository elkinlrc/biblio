<?php
class Moon2_Tabulator_Tab {
    private $_items;
    private $_id;
    private $_selectedIndex;
    private $_externalData;
    
public function __construct(){
    $this->_externalData = FALSE;
    $this->_items = array();
    $this->_id = uniqid();
}

private function set_parent(){
    $last = 0;
    foreach($this->_items as $index => $item){
        if ($item["level"]==1){
            $last = $index;
        }
    }
    return $last;
}

private function get_active($value){
    $class = "";
    foreach($this->_items as $index => $item){
        if ($item["parent"]== $value){
            if ($this->_selectedIndex == $index){
                $class = " active";
            }
        }
    }
    return $class;
}

private function get_children($value){
    $xhtml = "";
    foreach($this->_items as $index => $item){
        if ($item["parent"]== $value){
            $step = "step_".$index;
            $class = "";
            if ($this->_selectedIndex == $index){
                $class = "active";
            }
            $xhtml.= "<li class=\"".$class."\"><a data-toggle=\"tab\" tabindex=\"-1\" href=\"#".$step."\">".$item["text"]."</a></li>\n";
        }
    }
    return $xhtml;
}

public function set_selectedIndex($value){
    $this->_selectedIndex = $value;
}

public function set_externalData($value){
    $this->_externalData = $value;
}

public function add_item($text, $disable= FALSE, $body = "", $level = 1){
    $index = count($this->_items) + 1;
    $this->_items[$index]["text"] = $text;
    $this->_items[$index]["body"] = $body;
    $this->_items[$index]["level"] = $level;
    $this->_items[$index]["disable"] = $disable;
    if ($level === 1){
        $this->_items[$index]["isparent"] = false;
        $this->_items[$index]["parent"] = "";
    }else{
        $parent_index = $this->set_parent();
        $this->_items[$parent_index]["isparent"] = true;
        $this->_items[$index]["isparent"] = false;
        $this->_items[$index]["parent"] = $parent_index;
    }
}

public function step_header($value){
    $xhtml = "";
    foreach($this->_items as $index => $item){
        if ($item["text"] == $value){
            $class = "";
            if ($this->_selectedIndex == $index){
                $class = " active in";
            }
            $step = "step_".$index;
            $xhtml.= "<div id=\"{$step}\" class=\"tab-pane fade{$class}\">\n";
        } 
    }
    return $xhtml;
}

public function step_footer(){
    return "</div>\n";
}

public function show(){
    $xhtml = "<ul class=\"nav nav-tabs\" id=".$this->_id.">\n";
    foreach($this->_items as $index => $item){
        $step = "step_".$index;
        if ($item["isparent"] == 1){
            $class = $this->get_active($index);
            $xhtml.= "<li class=\"dropdown{$class}\">\n";
            $xhtml.= "  <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\">".$item["text"]." <b class=\"caret\"></b></a>\n";
            $xhtml.= "      <ul role=\"menu\" class=\"dropdown-menu\">\n";
            $xhtml.= $this->get_children($index);
            $xhtml.= "      </ul>\n";
            $xhtml.= "</li>\n";

        }else{
            if (empty($item["parent"])){
                $class = "";
                if ($this->_selectedIndex == $index){
                    $class = "active";
                }
                if ($item["disable"]){
                    $xhtml.= "<li class=\"disabled\"><a href=\"#".$step."\">".$item["text"]."</a></li>\n";
                }else{
                    $xhtml.= "<li class=\"".$class."\"><a data-toggle=\"tab\" href=\"#".$step."\">".$item["text"]."</a></li>\n";                    
                }
            }
        }
    }
    $xhtml.= "</ul>\n";
    if ($this->_externalData === FALSE){
        $xhtml.= "<div class=\"tab-content\">\n";
        foreach($this->_items as $index => $item){
            $class = "";
            if ($this->_selectedIndex == $index){
                $class = " active in";
            }
            $step = "step_".$index;
            $xhtml.= "<div id=\"{$step}\" class=\"tab-pane fade{$class}\">\n";
            $xhtml.= $item["body"]."\n";
            $xhtml.= "</div>\n";
        }
        $xhtml.= "</div>\n"; 
    }
    return $xhtml;
}

}//End class
?>
