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
                        <h3>Listar Libros</h3>
                    </div>
                    <div class="widget-content">
                        <a href="crear.php" class="btn btn-success">Nuevo</a>

                        <form name="formulario" id="formulario" method="POST" action="traceo.php" onsubmit="javascript:return checkform('formulario');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false" />
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="biblio/libroscontroller" />


                            <table class="table table-striped">

                                <tr>
                                    <td class="">&nbsp;</td>
                                    <td class=""><?php
                                        echo $formulario->addObject("RadioHorizontal", "So", $arr_busqueda, $opcionBusqueda, "Codigo");
                                        ?>
                                    </td>  
                                    <td class=></td>

                                </tr>


                                <tr>
                                    <td class="">Buscar</td>
                                    <td class="" ><input type="text" name="Sw" id="Sw"  class="form-control" value="<?php echo $palabraBusqueda; ?>"/></td> 
                                    <td class="" ><input type="submit" name="btnBuscar" id="btnBuscar" value=" Iniciar Busqueda" class="btn btn-primary" /></td>




                                </tr>


                            </table>
                        </form>


                        <?php
                        echo $paginador->showDetails();
                        ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="20%">Código </th>
                                    <th width="50%" style="text-align: center">Título</th>
                                    <th width="50%" style="text-align: center">Subtítulo </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($registros as $indice => $campo) {

                                    $parametros->add("action", "eliminar");
                                    $parametros->add("controller", "Modules_Biblio_Controllers_LibrosController");
                                    $parametros->add("codigo", $campo["codlibro"]);
                                    $parametros->add("SECURITY_ID", "FALSE");
                                    $url_actualizar = $parametros->keyGen();

                                    echo "<tr>";
                                    echo "<td><a href=\"editar.php?{$url_actualizar}\">" . $campo["codlibro"] . "</a></td>";
                                    echo "<td>" . $campo["titulo"] . "</td>";
                                    echo "<td>" . $campo["subtitulo"] . "</td>";

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