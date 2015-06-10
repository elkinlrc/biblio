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
                        <h3>Crear Libro</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="crear" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/LibrosController" />
                            <table class="table table-bordered table-highlight" >
                                <thead>
                                    <tr>
                                        <th colspan="4">Información Básica </th>
                                    </tr>



                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>titulo</td>
                                        <td><input type="text" id="titulo" name="titulo" class="form-control validate[required, minSize[4]]" size="30" value=""/></td>

                                        <td>Subtitulo</td>
                                        <td><input type="text" id="subtitulo" name="subtitulo" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    <tr>
                                        <td>Clasificación</td>
                                        <td>
                                            <?php
                                            echo $formulario->addObject("MenuList", "codclasificacion", $comboClasificacion, "", "", "");
                                            ?>
                                        </td>

                                        <td>Formato del libros</td>
                                        <td>
                                            <?php
                                            echo $formulario->addObject("MenuList", "codformato", $comboFormatos, "", "", "");
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $form = "";
                                    $i = 0;
                                    $variable = "";
                                    foreach ($registrosMetadatos as $indice => $campo) {


                                        $i = $i + 1;
                                        $lbminimo = "";
                                        $lbrequerido = "";
                                        $minimo = $campo["minimo"];
                                        $requerido = $campo["requerido"];
                                        if ($minimo > 0) {

                                            $lbminimo = "minSize[" . $minimo . "]";
                                        }
                                        if ($requerido == "si") {
                                            $lbrequerido = "required";
                                        }

                                        if ($i % 2 == 0) {
                                            $form.="<tr>$variable<td>" . $campo["etiqueta"] . "</td><td><input type=\"text\" id=\"" . $campo["etiqueta"] . "\" name=\"valor[" . $campo["codmetadato"] . "]\" class=\"form-control validate[$lbrequerido, $lbminimo]\" size=\"30\"/></td></tr>";
                                            $variable = "";
                                        } else {
                                            $variable.= "<td>" . $campo["etiqueta"] . "</td>";
                                            $variable.= "<td><input type=\"text\" id=\"" . $campo["etiqueta"] . "\" name=\"valor[" . $campo["codmetadato"] . "]\" class=\"form-control validate[$lbrequerido, $lbminimo]\" size=\"30\"/></td>";
                                        }
                                    }
                                    echo $form;
                                    ?>
                            </table>
                            <ul class="nav nav-tabs">
                                <li><a href="#home" data-toggle="tab">Cantidad</a></li>
                                <li><a href="#profile" data-toggle="tab">Autores</a></li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <table id="table-data" class="table table-bordered table-highlight">
                                        <tr>
                                            <th colspan="4"><center>Copias del libro</center></th>
                                        </tr>
                                        <tr>
                                            <th >Código de Barras</th> <th >Edición</th> <th  >Sede</th><th><input type="button" class="tr_clone_add" value="Nuevo" name="add"></th>
                                        </tr>
                                        <tr  class="tr_clone">

                                            <td><input type="text" id="codigobarras" name="detalles[1][codigobarras]" class="form-control validate[required, minSize[4]]" size="30"/></td>





                                            <td ><input type="text" id="edicion" name="detalles[1][edicion]" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                            <td colspan="2">
                                                <?php
                                                echo $formulario->addObject("MenuList", "detalles[1][codsede]", $combosedes, "", "", "");
                                                ?>
                                            </td >
                                            

                                        </tr>
                                        </tr>
                                        <tr>
                                            <th colspan="4"><br/></th>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><input type="submit" value="Crear Registro" id="btncrearr" name="btncrearr" class="form-control btn-success"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="profile">
                                    <input type="text" name="autor" class="form-control" >





                                </div>

                            </div>


                        </form>
                        <div id="combo" style="display: none">
                             <?php
                                                echo $formulario->addObject("MenuList", "detalles[1][codsede]", $combosedes, "", "", "");
                                                ?>
                        </div>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
<script>
    $(function () {
        var c=1;
       $(".tr_clone_add").on('click', function(){
           c=c+1;
       
            //var thisRow = $(this).closest('tr')[0];
            //$(thisRow).clone().insertAfter(thisRow).find('input:text').val('');
            var combo= $('#combo').html().replace("[1]", "["+c+"]");
            var tr = ' <tr><td><input type="text" size="30" class="form-control validate[required, minSize[4]]" name="detalles['+c+'][codigobarras]" id="codigobarras"></td>';
            tr = tr + ' <td><input type="text" size="30" class="form-control validate[required, minSize[4]]" name="detalles['+c+'][edicion]" id="edicion"></td>';
            tr = tr + ' <td colspan="2">'+combo+'  </td>';
            tr = tr + '  </tr>';

            $("#table-data tr:eq(1)").after(tr);
  
 });

  
    });
</script>