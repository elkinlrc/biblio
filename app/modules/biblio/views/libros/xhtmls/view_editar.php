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
                        <h3>Editar libro</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="crear" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/LibrosController" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="4">Clasificación </th>
                                    </tr>



                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>titulo</td>
                                        <td><input type="text" id="titulo" name="titulo" class="form-control validate[required, minSize[4]]" size="30" value="<?php echo $obj->get_titulo();?>"/></td>
                                                                               <td>Subtitulo</td>
                                        <td><input type="text" id="subtitulo" name="subtitulo" class="form-control validate[required, minSize[4]]" size="30" value="<?php echo $obj->get_subtitulo();?>"/></td>
 
                                    </tr>
                                      <tr>
                                          <td>Clasificacion</td>
                                          <td>
                                    <?php
                                        echo $formulario->addObject("MenuList", "codclasificacion",$comboClasificacion, "", "", "");
                                         ?>
                                          </td>
                                          <td>Formato del libros</td>
                                          <td>
                                    <?php
                                        echo $formulario->addObject("MenuList", "codformato",$comboFormatos, "", "", "");
                                         ?>
                                          </td>
                                      </tr>
                                      <?php
                                      $i=0;
                                      $form="";
                                foreach ($registrosMetadatos as $indice => $campo){
                                    $i=$i+1;
                                    
                                    $lbminimo="";
                                    $lbrequerido="";
                                    $minimo=$campo["minimo"];
                                    $requerido=$campo["requerido"];
                                    if($minimo>0 ){
                                        
                                          $lbminimo="minSize[".$minimo."]";
                                     }
                                     if($requerido=="si"){
                                         $lbrequerido="required";
                                     }
                                  
                                    if($numero%2)
                                    {
                                        
                                        
                                    }  
                                    else{
                                        
                                    }
                                    echo "<tr>";
                                  
                                    echo "<td>".$campo["etiqueta"]."</td>";
                                    echo "<td><input type=\"text\" id=\"".$campo["etiqueta"]."\" name=\"valor[".$campo["codmetadato"]."]\" class=\"form-control validate[$lbrequerido, $lbminimo]\" size=\"30\"/></td>";
                                    
                                    echo "</tr>";
                                }
                                ?>
                                    
                                      
                                      
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Crear Registro" id="btncrearr" name="btncrearr" class="form-control btn-success"/></td>
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
