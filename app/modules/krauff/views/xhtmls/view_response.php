<?php
    if(!isset($id_security)) {
        echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";exit();
    }
    $message = "";
    if (isset($_GET["msg"])){
        $message = utf8_encode(($_GET["msg"]));
    }
?>
<br/><br/><br/>
<div class="container  well">
    
    <div class="row">
        <div class="col-md-12"  >
            <h1>Respuesta del Sistema</h1>		
            <div class="field">
                <p><?php echo $message;?></p>
            </div><!-- /field -->	
            <div>
                <a class="btn btn-success" href="javascript:alert('email: jhonjairo.cortesp@live.com');">Información y Soporte</a>
            </div>
        </div>
    </div> <!-- /content -->
</div> <!-- /account-container -->