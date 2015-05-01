<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="widget stacked">
                    <div class="widget-header">
                        <i class="icon-edit"></i>
                        <h3>Actualizar</h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <form id="frm_perfil" method="ajax" action="moon2.php" onSubmit="javascript:return checkform_ajax('frm_perfil');">
                            <input type="hidden" id="action" name="action" value="editar" />
                            <input type="hidden" id="codperfil" name="codperfil" value="<?php echo $Perfil->get_codperfil() ?>" />
                            <input type="hidden" id="controller" name="controller" value="krauff/perfilescontroller" />
                            <fieldset>
                                <div class="table-responsive">
                                    <table border="0" width="95%" class="table table-striped table-condensed">
                                        <tbody>
                                            <tr>
                                                <td width="10%"><label class="col-sm-2 control-label">Nombre</label></td>
                                                <td width="10%"><input type="text" class="form-control validate[required,minSize[3],maxSize[200]]" id="nombreperfil" name="nombreperfil" size="40" tabindex="1" value="<?php echo $Perfil->get_nombreperfil() ?>" /></td>
                                                <td width="10%">&nbsp;</td>
                                                <td width="25%">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div align="center">
                                                        <button class="btn btn-success" type="submit" tabindex="2">Actualizar</button>&nbsp;
                                                        
                                                    </div>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                        </form>
                        <div class="clear"></div>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget -->						
            </div> <!-- /span12 -->     	
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->