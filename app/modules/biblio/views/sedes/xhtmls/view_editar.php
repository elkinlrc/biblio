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
                        <h3>Editar Sede</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="editar" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/SedesController" />
                            <input type="hidden" id="codsede" name="codsede" value="<?php echo $obj->get_codsede();?>" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="2">Datos de la sede</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>Nombre</td>
                                        <td><input type="text" id="nombre" name="nombre" value="<?php echo $obj->get_nombre(); ?>" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    <tr>
                                        <td>Dirección</td>
                                        <td><input type="text" id="direccion" name="direccion" value="<?php echo $obj->get_direccion(); ?>" class="form-control validate[required, minSize[4]]" size="30"/></td>
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
