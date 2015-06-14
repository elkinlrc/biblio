<?php

class Modules_Biblio_ModelDb_Prestamosdb extends Moon2_DBmanager_PDO{
    
    
    public function __construct() {
        parent::__construct();   //herede todo del padre
        $this->_table = "prestamos";
        $this->_Pkey["key"] = "codprestamo";
        $this->_Pkey ["value"] = 0;
        $this->_sequence = $this->_table . "_" . $this->_Pkey["key"] . "_seq";
    }

    
     public function load_all(&$rsNumRows, $limit_numrows, $page, $Data) {
        
         
        
        $where=" ";
        $from = "FROM ".$this->_table." p ";
        $inner=" inner join usuarios u on p.codusuario=u.codusuario ";
        $inner.=" inner join detalles d on p.coddetalle=d.coddetalle ";
        $inner.=" inner join libros l on l.codlibro=d.codlibro ";
        $order=" order by fechaprestamo ";
        if(isset($Data["busqueda"])){
            $where = $this->get_where($Data["busqueda"]);
        }
        $order = " ";
                        

        $sql_num = " SELECT COUNT(*) ";
        $sql_num.=$from;
        $sql_num.=$where;
        $sql_num.=$inner;

        $rsNumRows = $this->GetOne($sql_num);
        $sql_registros = "SELECT p.".$this->_Pkey["key"].", u.nombres,d.codigobarras,l.titulo,l.subtitulo,p.fechaprestamo ";
        $sql_registros.=$from;
        $sql_registros.=$where;
        $sql_registros.=$order;
        $sql_registros.=$inner;
        
        
        $arreglo = $this->SelectLimit($sql_registros, $limit_numrows, $page);

        return $arreglo;
    }
    
  
    
    
    
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

