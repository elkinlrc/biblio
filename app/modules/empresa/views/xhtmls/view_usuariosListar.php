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
                        <h3>Listar Usuarios</h3>
                    </div>
                    <div class="widget-content">
                        <form name="formulario" id="formulario" method="POST" action="traceo.php" onsubmit="javascript:return checkform('formulario');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false" />
                            <input type="hidden" id="action" name="action" value="usuariosBuscar" />
                            <input type="hidden" id="controller" name="controller" value="empresa/usuarioscontroller" />


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
                                    <td class="danger" ><input type="text" name="Sw" id="Sw"  class="form-control" value="<?php echo $palabraBusqueda; ?>"/></td> 
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
                                    <th width="10%">Código Usuario</th>
                                    <th width="15%" style="text-align: center">Perfil</th>
                                    <th width="15%" style="text-align: center">Oficina</th>
                                    <th width="15%" style="text-align: center">Nombres</th>
                                    <th width="15%" style="text-align: center">Primer apellido</th>
                                    <th width="10%" style="text-align: center">Segundo apellido</th>
                                    <th width="10%" style="text-align: center">Género</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($registros as $indice => $campo) {
                                    echo "<tr>";
                                    echo "<td>" . $campo["codusuario"] . "</td>";
                                    echo "<td>" . $campo["perfil"] . "</td>";
                                    echo "<td>" . $campo["oficina"] . "</td>";
                                    echo "<td>" . $campo["nombres"] . "</td>";
                                    echo "<td>" . $campo["primerapellido"] . "</td>";
                                    echo "<td>" . $campo["segundoapellido"] . "</td>";
                                    echo "<td>" . $DOM["GENERO"][$campo["genero"]] . "</td>";


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