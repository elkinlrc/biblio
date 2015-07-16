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
                        
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="crear" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/ColeccionesController" />
                            <fieldset>
        <legend>Crear Colección</legend>
        <div class="form-group">
            <label for="coleccion" class="col-lg-2 control-label">Colección</label>
            <div class="col-lg-10">
                <input class="form-control" id="coleccion" name='coleccion' placeholder="Nombre de la colección" type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="diasmaxprestamo" class="col-lg-2 control-label">Número de dias </label>
            <div class="col-lg-10">
                <input class="form-control" id="diasmaxprestamo" name="diasmaxprestamo"  type="number">
            </div>
        </div>
        <div class="form-group">
            <label for="valormultadia" class="col-lg-2 control-label">Valor multa por dia</label>
            <div class="col-lg-10">
                <input class="form-control" id="valormultadia" name="valormultadia" placeholder="Valor de la multa por día" type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="maximarenovaciones" class="col-lg-2 control-label">Valor multa por dia</label>
            <div class="col-lg-10">
                <input class="form-control" id="maximarenovaciones" name="maximarenovaciones" placeholder="Número maximo de renovaciones despues de prestado el libro" type="number">
            </div>
        </div>
       
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-default">volver</button>
                <button type="submit" class="btn btn-primary">Guadar</button>
            </div>
        </div>
    </fieldset>
                        </form>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
