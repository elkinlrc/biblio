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
                        <h3>Actualización de Usuarios</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="actualizarUsuarios" />
                            <input type="hidden" id="controller" name="controller" value="empresa/usuarioscontroller" />
                             <input type="hidden" id="codusuario"  name="codusuario" value="<?php echo $Usuarios->get_codusuario();?>" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="2">Actualizar Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                     <td>Perfil</td>
                                        <td><?php
                                        echo $formulario->addObject("MenuList", "codperfil",$arr_perfil,$Usuarios->get_codperfil(), "");
                                         
                                         ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Oficina</td>
                                       <td><?php
                                        echo $formulario->addObject("MenuList", "coddependencia",$arr_oficinas, $Usuarios->get_coddependencia(), "");
                                         ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombres</td>
                                       <td><input type="text" id="nombres" name="nombres" class="form-control validate[required, minSize[4]]" size="30" value="<?php echo $Usuarios->get_nombres();?>"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Primer apellido</td>
                                        <td><input type="text" id="primerapellido" name="primerapellido"  value="<?php echo $Usuarios->get_primerapellido();?>"   class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Segundo apellido</td>
                                        <td><input type="text"   name="segundoapellido" id="segundoapellido" class="form-control validate[required, minSize[4]]" size="30" value="<?php echo $Usuarios->get_segundoapellido();?>"  /></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>genero</td>
                                       <td><?php
                                        
                                        echo $formulario->addObject("MenuList", "genero", $DOM["GENERO"], $Usuarios->get_genero(), "", "class=\"validate[required] \"");
                                        
                                        ?>
                                        </td>
                                    </tr>
                                    
                                      <tr>
                                        <td colspan="2"><input type="submit" value="Actualizar Registro" id="btnactualizar" name="btnactualizar" class="form-control btn-success"/></td>
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