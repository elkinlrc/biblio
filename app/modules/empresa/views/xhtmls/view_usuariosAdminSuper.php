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
                        <h3>Administrar Usuarios-Super</h3>
                        
                          <a href="usuariosCrearSuper.php" class="abrirFlotanteSuper" >Nuevo Usuario</a>
                        
                    </div>
                    <div class="widget-content">
                        <?php
                        echo $paginador->showDetails();
                        ?>
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th width="10%">Código Usuario</th>
                                    <th width="10%" style="text-align: center">Perfil</th>
                                    <th width="10%" style="text-align: center">Oficina</th>
                                    <th width="15%" style="text-align: center">Nombres</th>
                                    <th width="15%" style="text-align: center">Primer apellido</th>
                                    <th width="10%" style="text-align: center">Segundo apellido</th>
                                    <th width="10%" style="text-align: center">Género</th>
                                     <th width="5%" style="text-align: center">Actualizar</th>
                                    <th width="5%" style="text-align: center">Eliminar</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($registros as $indice => $campo) {
                                    $parametros->add("action", "eliminarUsuarios");
                                    $parametros->add("controller", "Modules_Empresa_Controllers_UsuariosController");
                                    $parametros->add("codusuario", $campo["codusuario"]);
                                    $parametros->add("SECURITY_ID", "FALSE");
                                    $url_eliminar = $parametros->keyGen();
                                    //para actualizar
                                    $parametros->add("codusuario", $campo["codusuario"]);
                                    $url_actualizar = $parametros->keyGen();
                                    echo "<tr>";
                                    echo "<td>" . $campo["codusuario"] . "</td>";
                                    echo "<td>" . $campo["perfil"] . "</td>";
                                    echo "<td>" . $campo["oficina"] . "</td>";
                                    echo "<td>" . $campo["nombres"] . "</td>";
                                    echo "<td>" . $campo["primerapellido"] . "</td>";
                                    echo "<td>" . $campo["segundoapellido"] . "</td>";
                                    echo "<td>" . $DOM["GENERO"][$campo["genero"]]. "</td>";
                                    echo "<td style=\"text-align: center\">";
                                    echo "<a class=\"abrirFlotanteSuper\" href=\"usuariosActualizarSuper.php?{$url_actualizar}\"><i class=\"icon-edit\" /></a>";
                                    echo "</td>";
                                    echo "<td style=\"text-align: center\">";
                                    echo "<a href=\"" . $url_eliminar . "\" class=\"confirmar\" title=\"" . $campo["nombres"] . "\"><i class=\"icon-trash\" /></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        echo $paginador->showNavigation();
                        ?>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->