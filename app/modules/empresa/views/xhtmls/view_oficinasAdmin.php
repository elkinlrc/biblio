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
                        <h3>Administrar Oficinas</h3>
                    </div>
                    <div class="widget-content">
                        <?php
                        echo $paginador->showDetails();
                        ?>
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th width="20%">Código de la Oficina</th>
                                    <th width="50%" style="text-align: center">Nombre de la Oficina</th>
                                     <th width="15%" style="text-align: center">Actualizar</th>
                                    <th width="15%" style="text-align: center">Eliminar</th>
                           
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($registros as $indice => $campo){
                                    $parametros->add("action", "eliminarOficina");
                                    $parametros->add("controller", "Modules_Empresa_Controllers_OficinasController");
                                    $parametros->add("coddependencia", $campo["coddependencia"]);
                                    $parametros->add("SECURITY_ID", "FALSE");
                                    $url_eliminar = $parametros->keyGen();
                                    //para actualizar
                                    $parametros->add("coddependencia", $campo["coddependencia"]);
                                    $url_actualizar = $parametros->keyGen();
                                    echo "<tr>";
                                    echo "<td>".$campo["coddependencia"]."</td>";
                                    echo "<td>".$campo["oficina"]."</td>";
                                    echo "<td style=\"text-align: center\">";
                                    echo "<a href=\"oficinasActualizar.php?{$url_actualizar}\"><i class=\"icon-edit\" /></a>";
                                    echo "</td>";
                                    echo "<td style=\"text-align: center\">";
                                    echo "<a href=\"".$url_eliminar."\" class=\"confirmar\" title=\"".$campo["oficina"]."\"><i class=\"icon-trash\" /></a>";
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