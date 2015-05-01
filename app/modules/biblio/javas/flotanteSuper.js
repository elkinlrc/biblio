//inicio de metodo

$(function (){
    $(document).on("click","a.abrirFlotanteSuper",function (e){
                 e.preventDefault();
                 var $this = $(this);
                 var ancho = 800;
                 var alto  = 400;
                 var espaciohorizontal = 50;
                 var espaciovertical = 10;
                 $("<iframe id=\"vfcreare\" src=\"" + this.href + "\" />").dialog({
                     autoOpen: true,
                     width: ancho,
                     height: alto,
                     modal: true,
                     resizable: false,
                     hide: "clip",
                     show: "puff"
                     }).width(ancho-espaciohorizontal).height(alto-espaciovertical);
        
    });
}); //fin de la funcion




//finish del metodo
