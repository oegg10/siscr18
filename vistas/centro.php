<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombre"])){

  header("location: login.html");

}else{

require 'header.php';

if($_SESSION['administrador']==1){
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Centro <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Localidad</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Responsable</th>
                            <th>Tel. Responsable</th>
                            <th>Activo</th>
                            <th>Fecha alta</th>

                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Localidad</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Responsable</th>
                            <th>Tel. Responsable</th>
                            <th>Activo</th>
                            <th>Fecha alta</th>

                          </tfoot>

                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idcentro" id="idcentro">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del centro" required>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección(*):</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="200" placeholder="Dirección" required>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado:</label>
                            <input type="text" class="form-control" name="estado" id="estado" maxlength="45" placeholder="Estado">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Localidad:</label>
                            <input type="text" class="form-control" name="localidad" id="localidad" maxlength="50" placeholder="Localidad">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="15" placeholder="Telefono">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Correo:</label>
                            <input type="email" class="form-control" name="correo" id="correo" maxlength="60" placeholder="Correo">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Responsable del centro(*):</label>
                            <input type="text" class="form-control" name="responsable" id="responsable" maxlength="100" placeholder="Responsable del centro" required>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono del responsable:</label>
                            <input type="text" class="form-control" name="telresponsable" id="telresponsable" maxlength="15" placeholder="Teléfono del responsable del centro">
                            
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"> Cancelar</i></button>
                          </div>

                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}else{

  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/centro.js"></script>
<?php
}
ob_end_flush();
?>