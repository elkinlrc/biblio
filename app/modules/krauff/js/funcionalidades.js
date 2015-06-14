//Codigo para todos y cancelar
$(document).ready(function(){
    $("#btnTodos").click(function(){
      $("#treeX").dynatree("getRoot").visit(function(node){
        node.select(true);
      });
      return false;
    });
    
    $("#btnCancelar").click(function(){
      $("#treeX").dynatree("getRoot").visit(function(node){
        node.select(false);
      });
      return false;
    });
});

//Constructor del arbol
$(function(){
    //Configuración y variables
    var obj = $("<form>") 
    obj.attr("method", "ajax");
    var urlpage  = moon2_process(obj);
    var parametros ={ action: "json_completo", 
                    controller: "krauff/funcionalidadescontroller" 
                    };
    //Iniciar el javascript para cargar el arbol
    $("#treeX").dynatree({
        checkbox: true,
        selectMode: 3,
          onSelect: function(select, node) {
            // Get a list of all selected nodes, and convert to a key array:
            var selKeys = $.map(node.tree.getSelectedNodes(), function(node){
              return node.data.key;
            });
            $("#seleccionados").text(selKeys.join(", "));
          },
        initAjax: {
            url: urlpage,
            type:  "post",
            data: parametros
          },
        onActivate: function(node) {
          $("#activo").text(node.data.title);
          $("#edfunc").show();
        },
        onDeactivate: function(node) {
          $("#activo").text("-");
        },
        dnd: {
             onDragStart: function(node) {
               /** This function MUST be defined to enable dragging for the tree.
                *  Return false to cancel dragging of node.
                */
               logMsg("tree.onDragStart(%o)", node);
               return true;
             },
             preventVoidMoves: true,
             onDragEnter: function(node, sourceNode) {
               return true;
             },
             onDrop: function(node, sourceNode, hitMode, ui, draggable) {
               sourceNode.move(node, hitMode);
               mover_nodo(hitMode, sourceNode.data.key, node.data.key);
               // expand the drop target
               // sourceNode.expand(true);
             }
           }
    });
});

//Codigo ajax para mover los nodos
function mover_nodo(modo, origen, destino){
    var obj = $("<form>") 
    obj.attr("method", "ajax");
    pagina = moon2_process(obj);

    var parametros = {
            action: "mover_nodo",
            modo: modo,
            origen: origen,
            destino: destino,
            controller: "krauff/funcionalidadescontroller"
    };
    $.ajax({
            data:  parametros,
            url:   pagina,
            type:  'post',
            beforeSend: function () {
                //$("#resultado").html("Procesando...");
            },
            success:  function (response) {
                $.msgGrowl ({type: 'success', title: 'Operación Exitosa:', text: 'El movimiento del nodo se registró con éxito'});
            },
            error: function(response) {
                $.msgGrowl ({type: 'error', title: 'Error en la operación:', text: 'El movimiento del nodo NO pudo ser grabado. Recargue la página con F5'});
            }
    });
}