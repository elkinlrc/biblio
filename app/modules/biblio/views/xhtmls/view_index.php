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
                        <h3>Buscar libros</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="crearAutores" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/AutoresController" />
                            <input type="text" id="buscado" name="buscador" value="" />
                          
                        </form>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
