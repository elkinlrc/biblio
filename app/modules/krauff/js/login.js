jQuery(document).ready(function(){
    $("#formID").validationEngine();
    $("#usu").focus();
});

function verificar(){
    if ($('#formID').validationEngine('validate')){
        var obj = $("#formID");
        if (moon2_process(obj)){
            var pass = hex_md5($('#cla').val());
            $('#cla').val(pass);
            return true;
        }
    }
    return false;
}