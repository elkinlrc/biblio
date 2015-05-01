<?php
    if(!isset($id_security)) {
        echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";exit();
    }
?>
<div class="account-container stacked">
    <div class="content clearfix">
	<form id="formID" class="formular" method="post" action="moon2.php" onSubmit="javascript:return verificar();">
            <input type="hidden" id="action" name="action" value="login" />
            <input type="hidden" id="SECURITY_ID" name="SECURITY_ID" value="enabled" />
            <input type="hidden" id="controller" name="controller" value="krauff/usuarioscontroller" />
            <fieldset>
            <h1>Acceso al Sistema</h1>		
            <div class="login-fields">
                <p>Ingreso Para Usuarios Registrados:</p>
                <div class="field">
                    <label for="usu">Nombre de Usuario</label>
                    <div class="">
                        <input class="form-control input-lg username-field validate[required]" type="text" name="usu" id="usu" placeholder="Usuario" />
                    </div>
                </div>
                <div class="field">
                    <label for="cla">Contraseña</label>
                    <div class="controls">
                        <input class="form-control input-lg password-field validate[required]" type="password" name="cla" id="cla" placeholder="Contraseña" />
                    </div>
                </div>		
            </div> <!-- /login-fields -->	
            <div class="form-actions">
                <button type="submit" class="btn btn btn-primary">Ingresar al Sistema</button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-info">Cancelar</button>
            </div>
            </fieldset>
        </form>	
    </div> <!-- /content -->
</div> <!-- /account-container -->