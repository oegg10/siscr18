<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombre"])){

  header("location: login.html");

}else{

require 'header.php';

if($_SESSION['usuario']==1){
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
                          <h1 class="box-title">Historial Personas <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
                            <th>Primer Ap.</th>
                            <th>Segundo Ap.</th>
                            <th>COE</th>
                            <th>Activo</th>
                            <th>Fecha alta</th>

                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Primer Ap.</th>
                            <th>Segundo Ap.</th>
                            <th>COE</th>
                            <th>Activo</th>
                            <th>Fecha alta</th>

                          </tfoot>

                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Comentarios(*):</label>
                            <input type="hidden" name="idcentro" id="idcentro">
                            <textarea class="form-control" name="comentarios" id="comentarios" maxlength="250" rows="5" cols="40" required>Escribe aquí tus comentarios</textarea>
                            
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
<script type="text/javascript" src="scripts/historialPersona.js"></script>
<?php
}
ob_end_flush();
?>