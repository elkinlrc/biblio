<?php
if (!isset($id_security)) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
                    <div class="widget-header">
                        <i class="icon-th-large"></i>
                        <h3>Gestionar Empresa</h3>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th width="25,00%">Sedes</th>
                                    <th width="25,00%">Oficinas</th>
                                    <th width="25,00%">Edificios</th>
                                    <th width="30,00%">Relacion Edificios-Oficinas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="sedesCrear.php">Crear</a></td>
                                    <td><a href="oficinasCrear.php">Crear</a></td>
                                    <td><a href="edificiosCrear.php">Crear</a></td>
                                    <td><a href="rel_Edif_OficCrear.php">Crear</a></td>
                                    
                                   

                                </tr>
                                <tr>
                                    <td><a href="sedesListar.php">Listar</a></td>
                                    <td><a href="oficinasListar.php">Listar</a></td>
                                    <td><a href="edificiosListar.php">Listar</a></td>
                                    <td><a href="rel_Edif_OficListar.php">Listar</a></td>

                                </tr>
                                <tr>
                                    <td><a href="sedesAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                    <td><a href="oficinasAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                    <td><a href="edificiosAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                    <td><a href="rel_Edif_OficAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                   

                                </tr>
                                
                                <tr>
                                    
                                    <td><a href="sedesAdminSuper.php">Súper Administrador-CRUD</a></td>
                                    <td><a href="oficinasAdminSuper.php">Súper Administrador-CRUD</a></td>
                                    <td><a href="edificiosAdminSuper.php">Súper Administrador-CRUD</a></td>
                                   
                                    
                                    
                                </tr>
                            </tbody>
                        </table>



                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th width="25,00%">Perfiles </th>
                                    <th width="25,00%">Nacionalidad</th>
                                    <th width="25,00%">Usuarios</th>
                                    <th width="30,00%">Relacion Usuarios-Nacionalidad</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="perfilesCrear.php">Crear</a></td>
                                    <td><a href="nacionalidadCrear.php">Crear</a></td>
                                    <td><a href="usuariosCrear.php">Crear</a></td>
                                    <td><a href="rel_Usu_NacCrear.php">Crear</a></td>

                                </tr>
                                <tr>
                                    <td><a href="perfilesListar.php">Listar</a></td>
                                    <td><a href="nacionalidadListar.php">Listar</a></td>
                                    <td><a href="usuariosListar.php">Listar</a></td>
                                     <td><a href="rel_Usu_NacListar.php">Listar</a></td>
                                    
                                </tr>
                                <tr>
                                    <td><a href="perfilesAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                    <td><a href="nacionalidadAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                     <td><a href="usuariosAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                    <td><a href="rel_Usu_NacAdmin.php">Listar - Actualizar - Eliminar</a></td>
                                    
                                </tr>
                                
                                <tr>
                                    
                                    <td><a href="perfilesAdminSuper.php">Súper Administrador-CRUD</a></td>
                                    <td><a href="nacionalidadAdminSuper.php">Súper Administrador-CRUD</a></td>
                                    <td><a href="usuariosAdminSuper.php">Súper Administrador-CRUD</a></td>
                                   
                                    
                                    
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr> <td colspan="8">
                                        <a href="auditoriaListar.php"><center><h3>Auditoria</h3></center></a></td></tr></tfoot>
                        </table>
                        



                    </div> <!-- /widget-content -->
                </div> <!-- /widget stacked -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->