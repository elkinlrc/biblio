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
                        <h3>Crear Edificio</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="crearEdificio" />
                            <input type="hidden" id="controller" name="controller" value="empresa/edificioscontroller" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="2">Nuevo Edificio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                     <td>Sede</td>
                                        <td><?php
                                        echo $formulario->addObject("MenuList", "codsede",$arr_equipos, "", "", "");
                                         ?>
                                        </td>
                                    <tr>
                                        <td>Nombre del Edificio</td>
                                        <td><input type="text" id="edificio" name="edificio" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    <tr>
                                       
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Crear Registro" id="btncrear" name="btncrear" class="form-control btn-success"/></td>
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