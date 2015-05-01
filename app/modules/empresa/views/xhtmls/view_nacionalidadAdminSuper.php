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
                        <h3>Administrar Nacionalidades</h3>
                        
                            <a href="nacionalidadCrearSuper.php" class="abrirFlotanteSuper">Nuevo Nacionalidad</a>
                    </div>
                    <div class="widget-content">
                        <?php
                        echo $paginador->showDetails();
                        ?>
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th width="40%">Código de la Nacionalidad</th>
                                    <th width="40%" style="text-align: center">Nacionalidad</th>
                                    <th width="10%" style="text-align: center">Actualizar</th>
                                    <th width="10%" style="text-align: center">Eliminar</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($registros as $indice => $campo) {
                                    $parametros->add("action", "eliminarNacionalidadSuper");
                                    $parametros->add("controller", "Modules_Empresa_Controllers_NacionalidadController");
                                    $parametros->add("codnacionalidad", $campo["codnacionalidad"]);
                                    $parametros->add("SECURITY_ID", "FALSE");
                                    $url_eliminar = $parametros->keyGen();
                                    //para actualizar
                                    $parametros->add("codnacionalidad", $campo["codnacionalidad"]);
                                    $url_actualizar = $parametros->keyGen();

                                    echo "<tr>";
                                    echo "<td>".$campo["codnacionalidad"]."</td>";
                                    echo "<td>".$campo["nacionalidad"]."</td>";
                                    echo "<td style=\"text-align: center\">";
                                    echo "<a class=\"abrirFlotanteSuper\" href=\"nacionalidadActualizar.php?{$url_actualizar}\"><i class=\"icon-edit\" /></a>";
                                    echo "</td>";
                                    echo "<td style=\"text-align: center\">";
                                    echo "<a href=\"" . $url_eliminar . "\" class=\"confirmar\" title=\"" . $campo["nacionalidad"] . "\"><i class=\"icon-trash\" /></a>";
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