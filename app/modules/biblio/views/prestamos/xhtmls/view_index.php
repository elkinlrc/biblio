<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="main">
    <div class="container well">
        <div class="row">
            <div class="col-md-12">
                <div class="widget stacked">
                    <div class="widget-header">
                        <i class="icon-th-large"></i>
                        <h3>Listar Prestamos</h3>
                    </div>
                    <div class="widget-content">
                        <a href="crear.php" class="btn btn-success">Nuevo</a>
                        <br/>
                         <form name="formulario" id="formulario" method="POST" action="traceo.php" onsubmit="javascript:return checkform('formulario');">
                                <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false" />
                                <input type="hidden" id="action" name="action" value="buscar" />
                                <input type="hidden" id="controller" name="controller" value="biblio/autorescontroller" />
                                

                                <table class="table table-striped">
                                    
                                    <tr>
                                        <td class="">&nbsp;</td>
                                        <td class="">
                                            
                                            <?php
                                        echo $formulario->addObject("RadioHorizontal", "So", $arr_busqueda, $opcionBusqueda, "");
                                        ?>
                                            
                                        </td>  
                                        <td class=""></td>
                                        
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td class="">Buscar</td>
                                        <td class="" ><input type="text" name="Sw" id="Sw"  class="form-control" value="<?php echo $palabraBusqueda;?>"/></td> 
                                        <td class="" ><input type="submit" name="btnBuscar" id="btnBuscar" value=" Iniciar Busqueda" class="btn btn-danger" /></td>
                                        
                                        
                                       
                                        
                                    </tr>
                                    
                                    
                                </table>
                                </form>
                        
                        
                        <?php
                        echo $paginador->showDetails();
                        ?>
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th >Código </th>
                                    <th style="text-align: center">Nombre usuario </th>
                                    <th  style="text-align: center">Libro </th>
                                    <th  style="text-align: center">Código de barras </th>
                                    <th  style="text-align: center">Dia de prestamo </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($registros as $indice => $campo){
                                    
                                    //$parametros->add("action", "eliminar");
                                    $parametros->add("controller", "Modules_Biblio_Controllers_autoresController");
                                    $parametros->add("codigo", $campo["codprestamo"]);
                                    $parametros->add("SECURITY_ID", "FALSE");
                                    $url_actualizar = $parametros->keyGen();
                                    
                                    echo "<tr>";
                                    echo "<td><a href=\"editar.php?{$url_actualizar}\">".$campo["codprestamo"]."</a></td>";
                                    echo "<td>".$campo["nombres"]."</td>";
                                    echo "<td>".$campo["titulo"]."</td>";
                                    echo "<td>".$campo["codigobarras"]."</td>";
                                    echo "<td>".$campo["fechaprestamo"]."</td>";
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