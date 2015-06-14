<?php
if(!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";exit();
}
?>
<div class="main">
  <div class="container">
    <div class="row">
      <div class="span5">
        <div class="widget stacked">
          <div class="widget-header"> <i class="icon-list"></i>
            <h3>Árbol de Funcionalidades</h3>
          </div>
          <!-- /widget-header -->
          <div class="widget-content">
                <a id="btnTodos" href="#">Todos</a> - <a id="btnCancelar" href="#">Cancelar</a>
            <div id="treeX"></div>
            <div id="seleccionados"></div>
            <div id="activo"></div>
          </div>
          <!-- /widget-content -->
        </div>
        <!-- /widget -->
      </div>
      <!-- /span8 -->
      <div id="edfunc" class="span7" style="display: none">
        <!-- /widget -->
        <div class="widget stacked widget-box">
          <div class="widget-header"> <i class="icon-edit"></i>
            <h3>Edición de funcionalidades</h3>
          </div>
          <!-- /widget-header -->
          <div class="widget-content">
          </div>
          <!-- /widget-content -->
        </div>
        <!-- /widget -->
      </div>
      <!-- /span4 -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
