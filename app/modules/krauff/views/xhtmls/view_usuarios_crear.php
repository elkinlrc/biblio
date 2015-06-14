<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="widget stacked">
                    <div class="widget-header">
                        <i class="icon-plus"></i>
                        <h3>Agregar</h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <form id="frm_usuarios" method="post" action="moon2.php" onSubmit="javascript:return checkform('frm_usuarios');">
                            <input type="hidden" id="action" name="action" value="crear" />
                            <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
                            <fieldset>
                                <div class="table-responsive">
                                    <table border="0"  class="table table-striped table-condensed">
                                        <tbody>
                                            <tr>
                                                <td><label class="col-sm-6 control-label">Perfil</label></td>
                                                <td colspan="2"><label class="col-sm-2 control-label">Nombres</label></td>
                                                <td><label class="col-sm-12 control-label">Tipo Documento</label></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $Formulario->addObject("MenuList", "codperfil", $arr_perfiles, "", "class='form-control'  tabindex='1'"); ?></td>
                                                <td colspan="2"><input type="text" class="form-control validate[required,minSize[1],maxSize[150]]" id="nombres" name="nombres" size="100" tabindex="2"/></td>
                                                <td><?php echo $Formulario->addObject("MenuList", "tipodoc", $DOM["TIPODOC"], "1", "class='form-control' tabindex='3'"); ?></td>
                                            </tr>
                                            <tr>
                                            
                                                <td><label class="col-sm-2 control-label">Documento</label></td>
                                                <td><label class="col-sm-2 control-label">Genero</label></td>
                                                <td><label class="col-sm-6 control-label">Dirección</label></td>
                                                <td><label class="col-sm-6 control-label">telefono</label></td>
                                            </tr>
                                             <tr>

                                                <td><input type="text" class="form-control validate[required,custom[integer],minSize[1],maxSize[30]]" id="documento" name="documento" size="30" tabindex="4"/></td>
                                                <td><?php echo $Formulario->addObject("MenuList", "genero", $DOM["GENERO"], "1", "class='form-control' tabindex='5'"); ?></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="direccion" name="direccion" size="60" tabindex="6"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="telefono" name="telefono" size="30" tabindex="7"/></td>
                                            </tr>
                                        </tbody>   
                                    </table>
                                </div>
                                
                                  <div class="table-responsive">
                                    <table border="0" width="95%" class="table table-striped table-condensed">
                                        <tbody>          
                                           
                                            <tr>
                                                <td><label class="col-sm-2 control-label">Celular</label></td>
                                                <td><label class="col-sm-12 control-label">Nombre Usuario</label></td>
                                                <td><label class="col-sm-2 control-label">Contraseña</label></td>
                                                <td><label class="col-sm-12 control-label">Confirmar Contraseña</label></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control validate[required,custom[integer],minSize[1],maxSize[30]]" id="celular" name="celular" size="30" tabindex="8"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="nombreusuario" name="nombreusuario" size="30" tabindex="9"/></td>
                                                <td><input type="password" id="clavesincifrar" name="clavesincifrar" class="form-control validate[required,minSize[1],maxSize[50]]" size="30" tabindex="10"/></td>
                                                <td><input type="password" id="confirmarclave" name="confirmarclave" class="form-control validate[required,require,equals[clavesincifrar]]" size="30" tabindex="11"/></td>                                                
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-2 control-label">Email</label></td>
                                                <td><label class="col-sm-2 control-label">Ciudad</label></td>
                                                <td><label class="col-sm-2 control-label">Pais</label></td>
                                                <td colspan="3"><?php if($DOM["USER_ID"] == -1) echo "<label class='col-sm-2 control-label'>Colegio</label>";?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control validate[required,custom[email],minSize[1],maxSize[200]]" id="correo" name="correo" size="30" tabindex="12"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="ciudad" name="ciudad" size="30" tabindex="13"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="pais" name="pais" size="30" tabindex="14"/></td>
                                                <td colspan="3"><?php if($DOM["USER_ID"] == -1) {echo $Formulario->addObject("MenuList", "codcolegio", $arraycolegio, "", "class='form-control' tabindex='15'");}?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </div>
                                
                                  <div class="table-responsive">
                                    <table border="0" width="95%" class="table table-striped table-condensed">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <div align="center">
                                                        <button class="btn btn-success" type="submit" tabindex="16">Agregar</button>&nbsp;
                                                       
                                                    </div>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </div>
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