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
                        <h3>Listado Auditorias</h3>
                    </div>
                    <div class="widget-content">
                        <div class="pricing-header">
                            <?php
                            echo $paginador->showDetails();
                            ?>

                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>




                                        <th class="text-center ">Código de la auditoria</th>
                                        <th class="text-center ">Nombre</th>
                                        <th class="text-center ">Tipo operación</th>
                                        <th class="text-center ">Codigo del Registro</th>
                                    </tr>
                                </thead>
                                
                                <tbody> 
                                    <?php
                                    foreach ($registros2 as $indice => $campo) {

                                        echo "<tr>";

                                        echo "<td>" . $campo["codauditoria"] . "</td>";
                                        echo "<td>" . $campo["nombretabla"] . "</td>";
                                        echo "<td>" . $DOM["TIPOOPERACION"][$campo["tipooperacion"]] . "</td>";
                                        echo "<td>" . $campo["codregistro"] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody> 

                            </table> 

                            <?php
                            echo $paginador->showNavigation();
                            ?>
 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










