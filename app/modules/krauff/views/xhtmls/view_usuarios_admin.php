<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
$Paginador = new Moon2_Pagination_Pager($rsNumRows, $limit_numrows, $num_page, $Params);
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-list"></i>
                        <h3>Usuarios <a class="abrir_flotant" href="usuarios_crear.php" title="Nuevo Usuario"><i class="icon-save btn btn-default"></i></a></h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <?php
                        if ($cantidad_filas > 0) {
                            ?>
                        <!--Buscador de Registros-->    
                        <form id="frm_usuarios" method="post" action="moon2.php" onSubmit="javascript:return checkform('frm_usuarios');"> 
                            <input type="hidden" id="action" name="action" value="buscar" />
                            <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
                            <table border="0" width="95%" class="table table-hover table-condensed">
                                <tr>
                                    <td width="65%"><p class="news-item-preview">&nbsp;<?php echo $Paginador->showDetails(); ?></p></td>
                                    <td width="5%"><?php echo $Formulario->addObject("MenuList", "nomcampos", $arr_nomusuarios, $combo_campos, "onchange='javascript:limpiarbusqueda();' class='form-control' style='cursor:pointer;'") ?></td>
                                    <td><input type="text" class="form-control validate[required,minSize[1],maxSize[30]]" id="buscar" name="buscar" size="40" value="<?php echo $caja_busqueda; ?>" /></td>
                                    <td><button class="btn btn-success" type="submit" tabindex="11">Buscar</button></td>
                                </tr>
                            </table>
                            <!--<?php print_r($arr_nomperfiles); ?>-->
                        </form>          
                        <!--Finaliza el Buscador de Registros--> 
                        <div class="table-responsive">
                            <table id="melleva" class="table table-bordered table-hover table-highlight">
                                    <?php echo $Face->headerTable($arr_cabeceras_tabla, $order, $Params); ?>
                                <tbody>
                                    <?php
                                    $xhtml = "";
                                    $Url = clone $Params;
                                    $controller = "Modules_Krauff_Controllers_UsuariosController";
                                    foreach ($filas as $indice => $campo) {
                                        $id_fila = $campo["codusuario"];
                                        $cod_usuario = $campo["codusuario"];
                                        $nombre_perfil = $campo["nombreperfil"];
                                        $genero = $DOM["GENERO"][$campo["genero"]];
                                        $nombres_usuario = $campo["nombres"];
                                        $tipo_documento = $DOM["TIPODOC"][$campo["tipodoc"]];
                                        $documento = $campo["documento"];
                                        $usuario = $campo["nombreusuario"];


                                        $Url->add("action", "eliminar");
                                        $Url->add("controller", $controller);
                                        $Url->add("codusuario", $cod_usuario);
                                        $params_eliminar = $Url->keyGen();

                                        $Url->add("action", "actualizar");
                                        $Url->add("codusuario", $cod_usuario);
                                        $params_actualizar = $Url->keyGen();
                                        
                                        $Url->add("codusuario", $cod_usuario);
                                        $params_funcionalidades = $Url->keyGen();

                                        $xhtml.= "<tr id=\"" . $id_fila . "\">\n";
                                        $xhtml.= "<td>{$cod_usuario}</td>";
                                        $xhtml.= "<td>{$nombre_perfil}</td>";
                                        $xhtml.= "<td>{$genero}</td>";
                                        $xhtml.= "<td>{$nombres_usuario}</td>";
                                        $xhtml.= "<td>{$tipo_documento}</td>";
                                        $xhtml.= "<td>{$documento}</td>";
                                        $xhtml.= "<td>{$usuario}</td>";
                                        $xhtml.= "<td>";
                                        $xhtml.= "  <div class=\"btn-toolbar\">";
                                        $xhtml.= "  <div class=\"btn-group\">";
                                        $xhtml.= "   <a title=\"Editar Usuario\" class=\"btn btn-default abrir_flotant\" href=\"usuarios_editar.php?{$params_actualizar}\"><i class=\"icon-edit\"></i></a>";
                                        $xhtml.= "   <a title=\"Eliminar Usuario: {$nombres_usuario}\" class=\"btn btn-default msgbox-confirm\" href=\"{$params_eliminar}\"><i class=\"icon-trash\"></i></a>";
                                        if($DOM["USER_ID"] == -1){
                                        $xhtml.= "   <a title=\"Funcionalidades\" class=\"btn btn-default abrir_flotante2\" href=\"permisos_admin.php?{$params_funcionalidades}\"><i class=\"icon-user\"></i></a>";
                                        }
                                        $xhtml.= "  </div>";
                                        $xhtml.= "  </div>";
                                        $xhtml.= "</td>";
                                        $xhtml.= "</tr>\n";
                                    }
                                    echo $xhtml;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                            <?php echo $Paginador->showNavigation(); ?>
                            <?php
                        } else {
                            ?>

                            <div class="alert alert-warning alert-dismissable">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <strong>ADVERTENCIA: </strong> No se encontraron Registros.
                            </div>
                            <?php
                        }
                        ?>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget -->						
            </div> <!-- /span12 -->     	
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
