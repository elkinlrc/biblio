function trim(myString){
    return myString.replace(/^\s+/g,"").replace(/\s+$/g,"");
}

function checkform(frm){
    if ($("#" + frm).validationEngine('validate')){
        var obj = $("#" + frm);
        if (moon2_process(obj)){
            return true;
        }
    }
    return false;
}

//Moon2 model for processing forms and hyperlinks start
//*****************************************************************************
function moon2_process(obj){
    var path = "";
    var method = obj.attr("method");
    method = method.toLowerCase();
    switch(method){
        case "post":
            path = javaPath + "/process/processform.php";
            obj.attr("action",path);
            return true;
        break;
        case "get":
            var parameters = obj.attr("action");
            var newpath = javaPath + "/process/processurl.php?";
            location.href = newpath + parameters;
        break;
        case "ajax":
            path = javaPath + "/process/processform.php";
            return path;
        break;
        default:
            alert("There is no Method defined");
    }
    return false;
}
//*****************************************************************************
//Moon2 model for processing forms and hyperlinks end


//pagination start
//*****************************************************************************
jQuery(document).ready(function(){
    $("#pagingfrm").validationEngine();
});
function checkfrmpg(){
    if ($('#pagingfrm').validationEngine('validate')){
        var obj = $("#pagingfrm");
        if (moon2_process(obj)){
            return true;
        }
    }
    return false;
}
//*****************************************************************************
//pagination end