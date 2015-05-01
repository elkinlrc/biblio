<?php
    if(!isset($id_security)) {
        echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";exit();
    }
    $message = "";
    if (isset($_GET["msg"])){
        $message = utf8_encode(($_GET["msg"]));
    }
?>
<div class="account-container stacked">
    <div class="content clearfix">
            <h1>Respuesta del Sistema</h1>		
            <div class="field">
                <p><?php echo $message;?></p>
            </div><!-- /field -->	
            <div>
                <a class="btn btn-success" href="javascript:alert('email: jhonjairo.cortesp@live.com');">Información y Soporte</a>
            </div>
    </div> <!-- /content -->
</div> <!-- /account-container -->