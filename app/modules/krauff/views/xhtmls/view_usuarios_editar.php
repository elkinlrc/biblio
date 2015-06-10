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
                        <i class="icon-edit"></i>
                        <h3>Editar</h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <form id="frm_usuarios" method="post" action="moon2.php" onSubmit="javascript:return checkform('frm_usuarios');">
                            <input type="hidden" id="action" name="action" value="editar" />
                            <input type="hidden" id="codusuario" name="codusuario" value="<?php echo $Usuario->get_codusuario() ?>" />
                            <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />                            
                               <div class="table-responsive">
                                    <table border="0"  class="table table-striped table-condensed">
                                        <tbody>
                                            <tr>
                                                <td><label class="col-sm-6 control-label">Perfil</label></td>
                                                <td colspan="2"><label class="col-sm-2 control-label">Nombres</label></td>
                                                <td><label class="col-sm-12 control-label">Tipo Documento</label></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $Formulario->addObject("MenuList", "codperfil", $arr_perfiles, $Usuario->get_codperfil(), "class='form-control'  tabindex='1' style='cursor:pointer;'"); ?></td>
                                                <td colspan="2"><input type="text" class="form-control validate[required,minSize[1],maxSize[150]]" id="nombres" name="nombres" size="70" tabindex="2" value="<?php echo $Usuario->get_nombres() ?>"/></td>
                                                <td><?php echo $Formulario->addObject("MenuList", "tipodoc", $DOM["TIPODOC"], $Usuario->get_tipodoc(), "class='form-control' tabindex='3' style='cursor:pointer;'"); ?></td>
                                            </tr>
                                            <tr>
                                            
                                                <td><label class="col-sm-2 control-label">Documento</label></td>
                                                <td><label class="col-sm-2 control-label">Genero</label></td>
                                                <td><label class="col-sm-6 control-label">Dirección</label></td>
                                                <td><label class="col-sm-6 control-label">telefono</label></td>
                                            </tr>
                                             <tr>

                                                <td><input type="text" class="form-control validate[required,custom[integer],minSize[1],maxSize[30]]" id="documento" name="documento" size="20" tabindex="4" value="<?php echo $Usuario->get_documento() ?>"/></td>
                                                <td><?php echo $Formulario->addObject("MenuList", "genero", $DOM["GENERO"], $Usuario->get_genero(), "class='form-control' tabindex='5' style='cursor:pointer;'"); ?></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="direccion" name="direccion" size="60" tabindex="6" value="<?php echo $Usuario->get_direccion() ?>"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="telefono" name="telefono" size="30" tabindex="7" value="<?php echo $Usuario->get_telefono() ?>"/></td>
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
                                                <td><input type="text" class="form-control validate[required,custom[integer],minSize[1],maxSize[30]]" id="celular" name="celular" size="30" tabindex="8" value="<?php echo $Usuario->get_celular() ?>"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="nombreusuario" name="nombreusuario" size="30" tabindex="9" value="<?php echo $Usuario->get_nombreusuario() ?>"/></td>
                                                <td><input type="password" id="clavesincifrar" name="clavesincifrar" class="form-control validate[required,minSize[1],maxSize[50]]" size="30" tabindex="10" value="<?php echo $Usuario->get_clavesincifrar() ?>"/></td>
                                                <td><input type="password" id="confirmarclave" name="confirmarclave" class="form-control validate[required,require,equals[clavesincifrar]]" size="30" tabindex="11" value="<?php echo $Usuario->get_clavesincifrar() ?>"/></td>                                                
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-2 control-label">Email</label></td>
                                                <td><label class="col-sm-2 control-label">Ciudad</label></td>
                                                <td><label class="col-sm-2 control-label">Pais</label></td>
                                                <td colspan="3"><?php if($DOM["USER_ID"] == -1) echo "<label class='col-sm-2 control-label'>Empresas</label>";?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control validate[required,custom[email],minSize[1],maxSize[200]]" id="correo" name="correo" size="30" tabindex="12" value="<?php echo $Usuario->get_correo() ?>"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="ciudad" name="ciudad" size="30" tabindex="13" value="<?php echo $Usuario->get_ciudad() ?>"/></td>
                                                <td><input type="text" class="form-control validate[required,minSize[1],maxSize[100]]" id="pais" name="pais" size="30" tabindex="14" value="<?php echo $Usuario->get_pais() ?>"/></td>
                                                <td colspan="3"><?php if($DOM["USER_ID"] == -1) {echo $Formulario->addObject("MenuList", "codempresa", $arrayEmpresa,$Usuario->get_codempresa(), "class='form-control' tabindex='15'");}?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </div>
                                
                                    <table border="0" width="95%" class="table table-striped table-condensed">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <div align="center">
                                                        <button class="btn btn-success" type="submit" tabindex="16">Editar</button>&nbsp;
                                                        
                                                    </div>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </form>
                        <div class="clear"></div>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget -->						
            </div> <!-- /span12 -->     	
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->