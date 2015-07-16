<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="main">
    <div class="container well">
        <div class="row">
            <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
            <div class="col-md-3">
               
                    <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                    <input type="hidden" id="action" name="action" value="buscar" />
                    <input type="hidden" id="controller" name="controller" value="Biblio/LibrosController" />
                    <img src="<?= $PATH_CONFIG["ROOT"]["images"]; ?>/LogoHorizontal-UTS.png"  />
            </div>
                <div class="col-md-9">
                    <br/>
                    <br/>
                    <input type="text" class="input-xxlarge form-control" style="width: 530px;" id="buscado" name="buscador"  value="<?= $busqueda; ?>" />
                    <input type="submit" class=" btn btn-success" value="Buscar">
                    <ul>
                        <li>Busqueda Basica</li>
                        <li><a href="#" id="bs-avanzada">Busqueda Avanzada</a></li>
                    </ul>


                    <div id="busqueda-avanzada" style="display: none;">
                        <table>
                            <?php
                            foreach ($registrosMetadatos as $indice => $campo) {
                                
                                echo "<tr>";
                                echo "<td>" . $campo["etiqueta"] . "</td>";
                                echo "<td><input type=\"text\" id=\"" . $campo["etiqueta"] . "\" name=\"" . $campo["etiqueta"] . "\" class=\"form-control\"  size=\"30\"/></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                        <br/>
                        <br/>
                    </div>



               
            </div>
             </form>    
        </div>
        <div class="row">
             <div class="col-md-12">
                <?php
                echo $paginador->showDetails();
                ?>
                <table class="table table-bordered table-hover table-responsive ">
                    <thead>
                        <tr>
                            <th  colspan="2">Resultados de Búsqueda </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($registros as $indice => $campo) {

                            $parametros->add("action", "verLibro");
                            $parametros->add("buscador", $busqueda);
                            $parametros->add("controller", "Modules_Biblio_Controllers_LibrosController");
                            $parametros->add("codigo", $campo["codlibro"]);
                            $parametros->add("SECURITY_ID", "FALSE");
                            $url_actualizar = $parametros->keyGen();

                            echo "<tr>";
                            echo "<td width='10%'><img src='../../../../media/img/libro.svg'width='70px;' height='70px' class=\"img-polaroid\"></td>";
                            echo "<td>"
                            . " <dl>
  <dt><a href=\"libro.php?{$url_actualizar}\">" . $campo["titulo"] . "</a></dt>
  <dd>" . $campo["subtitulo"] . "</dd>
  <dt>Milk</dt>
  <dd>White cold drink</dd>
</dl></td>";


                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                echo $paginador->showNavigation();
                ?>


            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
<script type="text/javascript">
$("#bs-avanzada").click(function(){
    $("#busqueda-avanzada").show();
});
</script>