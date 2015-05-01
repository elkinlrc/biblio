<?php
define("MAX_NUM_BOXES", 10);
define("MAX_NUM_SHORTCUTS", 50);

class Moon2_Pagination_Pager {
    private $_from;
    private $_total;
    private $_xhtml;
    private $_numberPages;
    private $_currentPage;
    private $_limitNumrows;
    private $_tmp_limit;
    private $_tmp_params;
    
public function __construct($total, $limit_numrows, $from, $Parameters){
    $xhtml = "";
    $this->_total = $total;
    $this->_from = (int)$from + 1;
    $this->_limitNumrows = $limit_numrows;
    $this->_tmp_params = clone $Parameters;
    $parametersTOdelete = array ("msg");
    foreach($parametersTOdelete as $key => $value){
        $this->_tmp_params->delete_param($value);
    }
    
    if ($total<=0) return $xhtml;
    $this->_numberPages = ceil($total/$this->_limitNumrows);
    $this->_tmp_limit = $this->_numberPages;
    $more = "";
    if ($this->_numberPages > MAX_NUM_BOXES){
        $this->_tmp_limit = MAX_NUM_BOXES;
        $title = "Entre 1 y ".$this->_numberPages;
        $links = $this->generateShortcuts();
        $more = "<li><a title=\"{$title}\" data-content='{$links}' data-placement=\"right\" data-toggle=\"popover\" href=\"#\">Ir a </a></li>\n";
    }
    if ($total >= $this->_limitNumrows){
        $counter = 0;
        $xhtml.= "<ul class=\"pagination\">\n";

        $first = 1;
        $last = $this->_tmp_limit;
        if($this->_from > ($this->_limitNumrows * MAX_NUM_BOXES)){
            $selected_page = ceil($this->_from / $this->_limitNumrows);
            $last = $this->get_last($selected_page);
            $first = $last - MAX_NUM_BOXES + 1;
            $counter = (($last - MAX_NUM_BOXES) * $this->_limitNumrows);
            if ($last > $this->_numberPages){
                $last = $this->_numberPages;
            }
        }

        $xhtml.= $this->get_backward($first);
        for ($i = $first; $i <= $last; $i++){
            $class = "";
            $this->_tmp_params->add("npage",$counter);
            $url_params = $this->_tmp_params->keyGen(false, true);
            if ($counter == $from){
                $this->_currentPage = $i;
                $class = " class=\"active\"";
            }
            $counter = $counter + $this->_limitNumrows;
            $xhtml.= "<li{$class}><a href=\"".$_SERVER['PHP_SELF']."?".$url_params."\">{$i}</a></li>\n"; 
        }
        $xhtml.= $this->get_forward($first);
        $xhtml.= $more;
        $xhtml.= "</ul>\n";
    }
    $this->_xhtml = $xhtml;
}

public function showDetails(){
    $to = (int)$this->_from + (int)$this->_limitNumrows - 1;
    if ($to > $this->_total){
        $to = $this->_total;
    }
    $xhtml = $this->_total." registros encontrados en ".$this->_numberPages." páginas, mostrando del registro ";
    $xhtml.= $this->_from." al ".$to;
    return $xhtml;
}

public function showNavigation(){
    return $this->_xhtml;
}


//Private methods start
//***********************************************************************************************
private function get_forward($first){
    $xhtml = "";
    $forward= (($first + MAX_NUM_BOXES) - 1) * $this->_limitNumrows;
    $this->_tmp_params->add("npage",$forward);
    $url_params = $this->_tmp_params->keyGen(false, true);
    if ($this->_numberPages > ($first + MAX_NUM_BOXES)){
        $xhtml = "<li><a href=\"".$_SERVER['PHP_SELF']."?".$url_params."\"><i class=\"icon-forward\"></i></a></li>";
    }
    return $xhtml;
}

private function get_backward($first){
    $xhtml = "";
    $backward = (($first - MAX_NUM_BOXES) - 1) * $this->_limitNumrows;
    $this->_tmp_params->add("npage",$backward);
    $url_params = $this->_tmp_params->keyGen(false, true);
    if ($first > 1){
        $xhtml.= "<li><a href=\"".$_SERVER['PHP_SELF']."?".$url_params."\"><i class=\"icon-backward\"></i></a></li>";
    }
    return $xhtml;
}

private function get_last($value){
    $last = 0;
    while ($last < $value){
        $last = $last + MAX_NUM_BOXES;
    }
    return $last;
}

private function generateShortcuts(){
    $xhtml = "<form id=\"pagingfrm\" name=\"pagingfrm\" method=\"post\" action=\"moon.php\"  onSubmit=\"javascript:return checkfrmpg();\">\n";
    $xhtml.= " <input type=\"hidden\" id=\"limnum\" name=\"limnum\" value=\"".$this->_limitNumrows."\" />\n";
    $xhtml.= " <input type=\"hidden\" id=\"action\" name=\"action\" value=\"goTopage\" />\n";
    $xhtml.= " <input type=\"hidden\" id=\"page_from\" name=\"page_from\" value=\"".$_SERVER['PHP_SELF']."\" />\n";
    $xhtml.= " <input type=\"hidden\" id=\"controller\" name=\"controller\" value=\"moon2/pagination/PagerController\" />\n";
    foreach($this->_tmp_params->get_parameters() as $key => $value){
        $xhtml.= "<input id=\"{$key}\" name=\"{$key}\" type=\"hidden\" value=\"{$value}\" />\n";
    }
						    
    $xhtml.= "  <div>\n";
    $xhtml.= "      <div class=\"col-xs-6\">";
    $xhtml.= "          <input type=\"text\" name=\"pg\" id=\"pg\" maxlength=\"6\" class=\"validate[required,custom[integer],min[1],max[".$this->_numberPages."]]\" size=\"4\"/>\n";
    $xhtml.= "      </div>";
    $xhtml.= "      <div class=\"col-xs-1\">";
    $xhtml.= "          <input class=\"btn-primary\" type=\"submit\" name=\"btngp\" id=\"btngp\" value=\"Ir\" />\n";
    $xhtml.= "      </div>";
    $xhtml.= "  </div>";
    
    $xhtml.= "</form>\n";
    return $xhtml;
}
//***********************************************************************************************
//Private methods end

}//End class
?>