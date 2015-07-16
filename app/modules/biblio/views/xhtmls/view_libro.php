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
                        
                        
                            <table class="table table-bordered table-highlight" >
                                <thead>
                                    <tr>
                                        <th colspan="4">Información Básica </th>
                                    </tr>



                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2" colspan="2"><img src="..." class="img-responsive" alt="Responsive image"></td>
                                        <th>Título</th>
                                        <td><?=$obj->get_titulo();?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Subtítulo</th>
                                        <td><?=$obj->get_subtitulo();?></td>

                                <t/>
                                <tr>



                                </tr>
                                <tr>
                                    <th>Clasificación</th>
                                    <td>
                                        <?php
                                        echo $formulario->addObject("MenuList", "codclasificacion", $comboClasificacion, "", "class='form-control'", "");
                                        ?>
                                    </td>

                                    <th>Formato del libros</th>
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
                                if (count($registrosMetadatos)>0) {
                                    foreach ($registrosMetadatos as $indice => $campo) {
                                        
                                        
                                       $i = $i + 1;
                                        if ($i % 2 == 0) {
                                            $form.="<tr>$variable<td><strong>" . $campo . "</strong></td><td>" . $indice . "</td></tr>";
                                            $variable = "";
                                        } else {
                                            $variable.= "<td><strong>" .$campo  . "</strong></td>";
                                            $variable.= "<td>"  .$indice  . "</td>";
                                        }
                                    }
                                }
                                echo $form;
                                ?>
                            </table>
                            <ul class="nav nav-tabs">
                                <li  class="active" ><a href="#home" data-toggle="tab">Cantidad</a></li>
                                <li><a href="#profile" data-toggle="tab">Autores</a></li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <table id="table-data" class="table table-bordered table-highlight">
                                        <tr>
                                            <th colspan="3"><center>Copias del libro</center></th>
                                        </tr>
                                        <tr>
                                            <th >Código de Barras</th> <th >Edición</th> <th  >Sede</th>
                                        </tr>
                                        <tr  class="tr_clone">

                                            <td></td>
                                            <td ></td>
                                            <td >  </td >


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


                       
                        <div id="combo" style="display: none">
                            <?php
                            echo $formulario->addObject("MenuList", "detalles[1][codsede]", $combosedes, "", "class='form-control'", "");
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
            var combo = $('#combo').html().replace("[1]", "[" + c + "]");
            var tr = ' <tr><td><input type="text" size="30" class="form-control validate[required, minSize[4]]" name="detalles[' + c + '][codigobarras]" id="codigobarras"></td>';
            tr = tr + ' <td><input type="text" size="30" class="form-control validate[required, minSize[4]]" name="detalles[' + c + '][edicion]" id="edicion"></td>';
            tr = tr + ' <td colspan="2">' + combo + '  </td>';
            tr = tr + '  </tr>';

            $("#table-data tr:eq(1)").after(tr);

        });


    });
</script>