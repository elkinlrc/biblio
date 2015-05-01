<?php
if(!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";exit();
}
?>
<div class="main">
  <div class="container">
    <div class="row">
      <div class="span7">
        <div class="widget stacked">
          <div class="widget-header"> <i class="icon-list"></i>
            <h3>Editar Funcionalidades</h3>
          </div>
          <!-- /widget-header -->
          <div class="widget-content">
                <a id="btnTodos" href="#">Todos</a> - <a id="btnCancelar" href="#">Cancelar</a>
            <div id="treeX"></div>
            <div id="seleccionados" style="display: none"></div>
            <div id="activo"></div>
            
            </br>
            <div class="table-responsive">
            <table table border="0" width="95%" class="table table-striped table-condensed">
                <tr>
                    <td>
                        <div align="center">
                            <button class="btn btn-success" type="button" onclick="javascript:insertar_funcionalida(<?php echo $cod_usuario; ?>);" tabindex="1">Agregar</button>                                         
                        </div> 
                    </td>
                      <td>
                        <div align="center">
                            <button class="btn btn-danger" type="button" onclick="javascript:eliminar_funcionalida(<?php echo $cod_usuario; ?>);" tabindex="2">Eliminar</button>                                         
                        </div> 
                    </td>
                </tr>
            </table>
            </div>
          </div>
          <!-- /widget-content -->
        </div>
        <!-- /widget -->
      </div>
      <!-- /span8 -->
      <!-- /span4 -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
