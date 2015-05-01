<?php
interface Moon2_Interfaces_MandatoryModel {
    public function add($obj);
    public function update($obj);
    public function delete($obj);
    public function loadOne($Obj);
    public function add_searchField($key, $field);
    public function load_all(&$rsNumRows, $limit_numrows, $page, $Data=array());
}
?>