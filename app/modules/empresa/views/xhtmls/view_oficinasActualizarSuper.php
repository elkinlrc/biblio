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
                        <h3>Actualizar Oficina</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="actualizarOficinaSuper" />
                            <input type="hidden" id="controller" name="controller" value="empresa/oficinascontroller" />
                            <input type="hidden" id="coddependencia" name="coddependencia" value="<?php echo $Oficinas->get_coddependencia();?>" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="2">Actualizar Oficina</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nombre de la Oficina</td>
                                        <td><input value="<?php echo $Oficinas->get_oficina(); ?>" type="text" id="oficina" name="oficina" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Actualizar Registro" id="btncrear" name="btncrear" class="form-control btn-success"/></td>
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