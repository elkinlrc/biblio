<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="main">
    <div class="container well">
        <div class="row">
            <div class="col-md-12">
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
                                        <td rowspan="2" colspan="2"><img src="..." class="img-responsive" alt="Responsive image"></td>
                                        <td><strong>Título</strong></td>
                                        <td><input type="text" id="titulo" name="titulo" class="form-control validate[required, minSize[4]]" size="30" value=""/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subtítulo</strong></td>
                                    <td><input type="text" id="subtitulo" name="subtitulo" class="form-control validate[required, minSize[4]]" size="30"/></td>

                                    <t/>
                                <tr>


                                    
                                </tr>
                                <tr>
                                    <td><strong>Clasificación</strong></td>
                                    <td>
                                        <?php
                                        echo $formulario->addObject("MenuList", "codclasificacion", $comboClasificacion, "", "class='form-control'", "");
                                        ?>
                                    </td>

                                    <td><strong>Formato del libros</strong></td>
                                    <td>
                                        <?php
                                        echo $formulario->addObject("MenuList", "codformato", $comboFormatos, "", "class='form-control'", "");
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $form = "";
                                $i = 0;
                                $variable = "";
                                $total=count($registrosMetadatos);
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
                                        $form.="<tr>$variable<td><strong>" . $campo["etiqueta"] . "</strong></td><td><input type=\"text\" id=\"" . $campo["etiqueta"] . "\" name=\"valor[" . $campo["codmetadato"] . "]\" class=\"form-control validate[$lbrequerido, $lbminimo]\" size=\"30\"/></td></tr>";
                                        $variable = "";
                                    } else {
                                        $variable.= "<td><strong>" . $campo["etiqueta"] . "</strong></td>";
                                        $variable.= "<td><input type=\"text\" id=\"" . $campo["etiqueta"] . "\" name=\"valor[" . $campo["codmetadato"] . "]\" class=\"form-control validate[$lbrequerido, $lbminimo]\" size=\"30\"/></td>";
                                      if($i==$total){
                                          $form.=$variable;
                                      }  
                                    }
                                }
                                echo $form;
                                ?>
                            </table>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Autores
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Copias del libro
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <table id="table-data" class="table table-bordered table-highlight">
                                        <tr>
                                            <th colspan="6"><center>Copias del libro</center></th>
                                        </tr>
                                        <tr>
                                            <th >Código de Barras</th> <th >Edición</th> <th  >Sede</th><th  >Tipo adquisición</th><th  >Precio</th>
                                            <th><button type="button" class="tr_clone_add"  name="add" ><i class="mdi-content-add"></i></button></th>
                                        </tr>
                                        <tr  class="tr_clone">

                                            <td><input type="text" id="codigobarras" name="detalles[1][codigobarras]" class="form-control validate[required, minSize[4]]" size="30"/></td>





                                            <td ><input type="text" id="edicion" name="detalles[1][edicion]" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                            <td >
                                                <?php
                                                echo $formulario->addObject("MenuList", "detalles[1][codsede]", $combosedes, "", "class='form-control' ", "");
                                                ?>
                                            </td >
                                            <td >
                                                <?php
                                                echo $formulario->addObject("MenuList", "detalles[1][codadquisicion]", $comboAdquisiciones, "", "class='form-control' ", "");
                                                ?>
                                            </td >
                                            <td colspan="2"><input type="text" id="precio" name="detalles[1][precio]" class="form-control" size="30"/></td>

                                        </tr>
                                        </tr>
                                        <tr>
                                            <th colspan="6"><br/></th>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td><td><input type="submit" value="Crear Registro" id="btncrearr" name="btncrearr" class="form-control btn-success"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
      </div>
    </div>
  </div>
  
</div>


                        </form>
                        <div id="combo1" style="display: none">
                            <?php
                            echo $formulario->addObject("MenuList", "detalles[1][codsede]", $combosedes, "", "class='form-control'", "");
                            ?>
                        </div>
                          <div id="combo2" style="display: none">
                            <?php
                            echo $formulario->addObject("MenuList", "detalles[1][codadquisicion]",$comboAdquisiciones, "", "class='form-control'", "");
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
        var c = 1;
        $(".tr_clone_add").on('click', function () {
            c = c + 1;

            //var thisRow = $(this).closest('tr')[0];
            //$(thisRow).clon e().insertAfter(thisRow).find('input:text').val('');
            var combo1 = $('#combo1').html().replace("[1]", "[" + c + "]");
            var combo2 = $('#combo2').html().replace("[1]", "[" + c + "]");
            var tr = ' <tr><td><input type="text" size="30" class="form-control validate[required, minSize[4]]" name="detalles[' + c + '][codigobarras]" id="codigobarras"></td>';
            tr = tr + ' <td><input type="text" size="30" class="form-control validate[required, minSize[4]]" name="detalles[' + c + '][edicion]" id="edicion"></td>';
            tr = tr + ' <td >' + combo1 + '  </td>';
            tr = tr + ' <td >' + combo2 + '  </td>';
            tr = tr + ' <td ><input type="text" class="form-control " name="detalles[' + c + '][precio]" id="precio">  </td>';
            tr = tr + '  </tr>';

            $("#table-data tr:eq(1)").after(tr);

        });


    });
</script>