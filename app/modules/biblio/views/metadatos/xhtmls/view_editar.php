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
                        <h3>Editar Columna</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="editar" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/MetadatosController" />
                            <input type="hidden" id="codautor" name="codmetadato" value="<?php echo $obj->get_codmetadato()?>" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="2">Datos de la Columna</th>
                                    </tr>



                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>MetaColumna</td>
                                        <td><input type="text" id="etiqueta" name="etiqueta" value="<?php echo $obj->get_etiqueta(); ?>" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                     <tr>
                                        <td>Mínimo</td>
                                        <td><input type="number" id="minimo" name="minimo"  class="form-control" size="30" value="<?php echo $obj->get_minimo(); ?>"/></td>
                                    </tr>
                                      <tr>
                                        <td>Máximo</td>
                                        <td><input type="number" id="maximo" name="maximo" class="form-control" size="30" value="<?php echo $obj->get_maximo(); ?>"/></td>
                                    </tr>
                                     <tr>
                                        <td>Requerido</td>
                                        <td>
                                    <?php
                                        echo $formulario->addObject("MenuList", "requerido",$DOM["REQ"],$obj->get_requerido(), "", "");
                                         ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Actualizar Registro" id="btncrearr" name="btncrearr" class="form-control btn-success"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
