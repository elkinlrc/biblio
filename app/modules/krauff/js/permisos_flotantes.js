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

//Validación de formularios con ajax- Inicio
function checkform_ajax(idFrm){
    var obj = $("#" + idFrm +"");
    if (obj.validationEngine('validate')){
        var action = $("#action").val();
        ruta = moon2_process(obj);
        editar_fila(ruta);
    }
    return false;
}
//Validación de formularios con ajax- Fin


//Actualizar con ajax - Inicio
function editar_fila(pagina){
    var parametros = $("#frm_perfil").serialize();
    $.ajax({
            data:  parametros,
            url:   pagina,
            type:  'post',
            beforeSend: function () {
                    //$("#resultado").html("Procesando...");
            },
            success:  function (response) {
                    console.log("Correcto");
                    codfila = $("#codperfil").val();
                    window.parent.$("#" + codfila).replaceWith(response);
                    window.parent.$.msgGrowl ({type: 'success', title: 'Operación AJAX Exitosa:', text: 'El perfil fue actualizado con éxito'});
                    window.parent.$('#xflotante').dialog('destroy');
            },
            error: function(response) {
                console.log("Error en la actualización del perfil " + response);
            }
    });
}
//Actualizar con ajax - Fin


//Flotante crear, editar - Inicio
$(function() {
    $(document).on('click', 'a.abrir_flotante2', function (e) {
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 20;
            var verticalPadding = 20;
            $('<iframe id="xflotante" src="' + this.href + '" />').dialog({
                    title: ($this.attr('title')) ? $this.attr('title') : 'Moon2',
                    autoOpen: true,
                    width: 830,
                    height: 530,
                    modal: true,
                    resizable: false,
                    hide: "clip",
                    show: "puff"
            }).width(800 - horizontalPadding).height(500 - verticalPadding);
    });
});
//Flotante crear - Fin

function eliminar_funcionalida(codusuario){
   var usuario = codusuario;
   var cod_funcionalida = $("#seleccionados").text();
    
    var obj = $("<form>");
    obj.attr("method", "ajax");
    pagina = moon2_process(obj);

    var parametros = {
            "codusuario" : usuario,
            "codfunc" : cod_funcionalida,
            "action" : 'eliminar_funcionalida',
            "controller": 'Krauff/FuncionalidadesController'
    };
    $.ajax({
            data:  parametros,
            url:   pagina,
            type:  'post',
            beforeSend: function () {
                    //$("#resultado").html("Procesando...");
            },
            success:  function (response) {
               var filas = response;
               if(filas === "1f"){
                        $.msgGrowl ({type: 'error', title: 'Error:', text: 'No Existen Funcionalidades Seleccionadas'});
                    }
                     else{
                        $.msgGrowl ({type: 'success', title: 'Exito:', text: 'Operación Realizada Exitosamente'});
                    }
            },
            error: function(response) {
                console.log("Error en el proceso de borrado" + response);
            }
    });  
}

function insertar_funcionalida(codusuario){
   var usuario = codusuario;
   var cod_funcionalida = $("#seleccionados").text();
    
    var obj = $("<form>");
    obj.attr("method", "ajax");
    pagina = moon2_process(obj);

    var parametros = {
            "codusuario" : usuario,
            "codfunc" : cod_funcionalida,
            "action" : 'insertar_funcionalida',
            "controller": 'Krauff/FuncionalidadesController'
    };
    $.ajax({
            data:  parametros,
            url:   pagina,
            type:  'post',
            beforeSend: function () {
                    //$("#resultado").html("Procesando...");
            },
            success:  function (response) {
               var filas = response;
               if(filas === "1f"){
                        $.msgGrowl ({type: 'error', title: 'Error:', text: 'No Existen Funcionalidades Seleccionadas'});
                    }
                    else{
                        $.msgGrowl ({type: 'success', title: 'Exito:', text: 'Operación Realizada Exitosamente'});
                    }
            },
            error: function(response) {
                console.log("Error en el proceso de borrado" + response);
            }
    });  
}