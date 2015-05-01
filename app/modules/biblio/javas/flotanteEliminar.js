//inicio Método que se usa para abrir ventana flotante al momento de eliminar
$(function() {
    $(document).on('click', 'a.confirmar', function(e) {
        e.preventDefault();
        var $this = $(this);
        var txt = $this.attr('title');
        $.msgbox('¿Está seguro que desea borrar el registro ?: <br />' + txt, {
            type: 'confirm', 
            buttons: [
                {type: 'submit', value: 'aceptar'},
                {type: 'cancel', value: 'cancelar'}
            ]
        }, function(result) {
            if (result === 'aceptar') {
                var obj = $('<form>');
                obj.attr('method', 'GET');
                obj.attr('action', $this.attr('href'));
                moon2_process(obj);
            }
        });
    });
});
//fin Método que se usa para abrir ventana flotante al momento de eliminar
