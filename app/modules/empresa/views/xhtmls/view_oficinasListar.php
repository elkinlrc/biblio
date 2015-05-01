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
                <div class="widget stacked">
                    <div class="widget-header">
                        <i class="icon-th-large"></i>
                        <h3>Listar Oficinas</h3>
                    </div>
                    <div class="widget-content">
                        
                          <form name="formulario" id="formulario" method="POST" action="traceo.php" onsubmit="javascript:return checkform('formulario');">
                                <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false" />
                                <input type="hidden" id="action" name="action" value="oficinasBuscar" />
                                <input type="hidden" id="controller" name="controller" value="empresa/oficinascontroller" />
                                

                                <table class="table table-striped">
                                    
                                    <tr>
                                        <td class="danger">&nbsp;</td>
                                        <td class="danger"><?php
                                        echo $formulario->addObject("RadioHorizontal", "So", $arr_busqueda, $opcionBusqueda, "");
                                        ?>
                                        </td>  
                                        <td class="danger"></td>
                                        
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td class="danger">Buscar</td>
                                        <td class="danger" ><input type="text" name="Sw" id="Sw"  class="form-control" value="<?php echo $palabraBusqueda;?>"/></td> 
                                        <td class="danger" ><input type="submit" name="btnBuscar" id="btnBuscar" value=" Iniciar Busqueda" class="btn btn-danger" /></td>
                                        
                                        
                                       
                                        
                                    </tr>
                                    
                                    
                                </table>
                                </form>
                        
                        <?php
                        echo $paginador->showDetails();
                        ?>
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th width="20%">Código de la Oficina</th>
                                    <th width="80%" style="text-align: center">Nombre de la Oficina</th>
                           
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($registros as $indice => $campo){
                                    echo "<tr>";
                                    echo "<td>".$campo["coddependencia"]."</td>";
                                    echo "<td>".$campo["oficina"]."</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        echo $paginador->showNavigation();
                        ?>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->