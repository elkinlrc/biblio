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
                        <h3>Crear Sedes-Súper</h3>
                    </div>
                    <div class="widget-content">
                        <form name="formulario" id="formulario" method="POST" action="traceo.php" onsubmit="javascript:return checkform('formulario');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false" />
                            <input type="hidden" id="action" name="action" value="crearSedesSuper" />
                            <input type="hidden" id="controller" name="controller" value="empresa/sedescontroller"/>
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="2">Nueva Sede Super</th>
                                    </tr>

                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>Sede</td>
                                        <td><input type="text" id="sede" name="sede" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    <tr>
                                        <td>Direccion</td>
                                        <td><input type="text" id="direccion" name="direccion" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Crear Registro" id="btncrearr2" name="btncrearr2" class="form-control btn-success"/></td>
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