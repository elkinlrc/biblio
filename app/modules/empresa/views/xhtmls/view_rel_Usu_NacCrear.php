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
                        <h3>Crear </h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="crearRELUSUARIOS" />
                            <input type="hidden" id="controller" name="controller" value="empresa/nacionalidadcontroller" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="2">Nuevo </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Seleccionar Nacionalidad</td>
                                        <td> <?php
                                        echo $formulario->addObject("MenuList", "codnacionalidad",$arr_nacionalidad, "", "", "");
                                         ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Seleccionar Usuarios</td>
                                      <td> <?php
                                        echo $formulario->addObject("MenuList", "codusuario",$arr_usuario, "", "", "");
                                        
                                        ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="guardar" id="btn_crear" name="btn_crear" class="form-control btn-success"/></td>
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