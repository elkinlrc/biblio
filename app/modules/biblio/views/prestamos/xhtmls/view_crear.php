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
                        <h3>Realizar Préstamo</h3>
                    </div>
                    <div class="widget-content">
                        <form id="frm" name="frm" method="POST" action="traceo.php" onsubmit="javascript:return checkform('frm');">
                            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="false"/>
                            <input type="hidden" id="action" name="action" value="crear" />
                            <input type="hidden" id="controller" name="controller" value="Biblio/AutoresController" />
                            <table class="table table-bordered table-highlight">
                                <thead>
                                    <tr>
                                        <th colspan="3">Préstamo de libros</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>Usuario</td>
                                        <td>
                                            <input type="hidden" id="codusuario" name="codusuario" value="" />    
                                            <input type="text" id="usuario"  autocomplete="off" name="usuario" class="form-control validate[required, minSize[4]]" size="30"/>
                                        </td>
                                        <td> <div id='button-usuario'></div></td>
                                    </tr>
                                    <tr>
                                        <td>Libro</td>
                                        <td>
                                         <input type="hidden" id="codlibro" name="codlibro" value="" />       
                                         <input type="text" id="libro" name="libro" autocomplete="off" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                
                                        <ul id="search-libros" class="dropdown-menu well" role="menu" aria-labelledby="dropdownMenu1" >
                                        </ul>
                                        <td><div id='button-libro'></div></td>
                                    </tr>
                                    <tr>
                                        <td>Dias para préstamo</td>
                                        <td><input type="text" id="nombre" name="nombre" class="form-control validate[required, minSize[4]]" size="30"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3"><input type="submit" value="Crear Registro" id="btncrearr" name="btncrearr" class="form-control btn-success"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->
<script type="text/javascript">
     $(function () {
       
         $("#frm").on("keyup",'#libro',function(){
           var codigo=$("#libro");
           cantidad=codigo.val();
      
           if(cantidad.length>=3){
                html="";
                
                $.ajax({
                    //data: { buscar: codigo.val()},
                    type: 'GET',
                    url: "libros.php?buscar="+codigo.val()+"<?=$parametros->keyGen();?>",
                    dataType: "json",
                     beforeSend: function() {
                         
                    },
                    success: function(data) {
                      
                       //$("#ul-clientes-list-group").html("");
                        $.each(data, function( i,elem) {
                                
                           html=html+"<li role='presentation'><a data-libro='"+elem.codlibro+"' data-value='"+elem.titulo+" - "+elem.codigobarras+"' role='menuitem' class='setcliente'  tabindex='-1' href='#'>"+elem.titulo+" - "+elem.codigobarras+"</a></li>";
                          
                      
                         });
                         if(html==""){
                            $("#search-libros").css("display","none");
                         }else{
                            $("#search-libros").css("display","block");
                         }
                         $("#search-libros").html(html);
                         $("#search-libros").css("top",$("#libro").css("left"));
                         $("#search-libros").css("left",$("#libro").css("left"));                         
                  
                       
           
                    }
                });   
           }else{
                $("#search-libros").css("display","none");
                //$("#ul-clientes-list-group").html("");
           }
         
   
        });
        $("#search-libros").delegate(".setcliente","click",function(){
            $("#codlibro").val($(this).attr("data-libro"));
            $("#libro").val($(this).attr("data-value"));
            $("#libro").prop('disabled', true); 
            $("#button-libro").html('<i class="mdi-navigation-cancel"></i>');
            $("#search-libros").css("display","none");
           
   });
        
 });
 </script>