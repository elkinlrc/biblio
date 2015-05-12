<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                
                    
                    
                        
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/LibrosController" />
                            <img src="<?=$PATH_CONFIG["ROOT"]["images"];?>/LogoHorizontal-UTS.png"  />
                            <div class="input-append">
                            <input type="text" class="input-xxlarge form-control" style="width: 530px;" id="buscado" name="buscador"  />
                            <input type="submit" class=" btn btn-success" value="Buscar">
                            <div class="btn-group">
                                <button class="btn">Opciones</button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret">prueba</span>
                            </button>
  
</div>
</div>
                            
                            
 
                            
                            <ul>
                                <li>Busqueda Basica</li>
                                <li>Busqueda Avanzada</li>
                            </ul>
                          
                        </form>
                    
                    
                    
                
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
