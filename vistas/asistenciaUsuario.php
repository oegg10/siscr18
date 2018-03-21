<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombre"])){

  header("location: login.html");

}else{

require 'header.php';

if($_SESSION['centro']==1){
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
                          <h1 class="box-title">Asistencia de Voluntarios <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Responsable</th>
                            <th>Comentarios</th>
                            <th>Fecha alta</th>

                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Responsable</th>
                            <th>Comentarios</th>
                            <th>Fecha alta</th>

                          </tfoot>

                        </table>
                    </div>
                    <div class="panel-body" style="height: 290px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="hidden" name="idau" id="idau">

                            <input type="date" class="form-control" name="fecha" id="fecha" required>

                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Nombre del que realiza la asistencia de voluntarios(*):</label>
                            <input type="text" class="form-control" name="nombrer" id="nombrer" maxlength="70" placeholder="Nombre de quien realiza la asistencia" required>
                            
                          </div>
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Comentarios:</label>

                            <textarea class="form-control" name="comentarios" id="comentarios" maxlength="250" rows="5" cols="40">Escribe aquí tus comentarios</textarea>
                            
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <a data-toggle="modal" href="#myModal">
                              
                              <button id="btnAgregarUsuario" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span>Agregar voluntario</button>

                            </a>
                            
                          </div>

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color: #A9D0F5">
                                <th>Opciones</th>
                                <th>Nombre</th>
                              </thead>
                              <tfoot>
                                <th><h4><strong>Voluntarios</strong></h4></th>
                                <th><h4 id="total">0</h4></th>
                              </tfoot>
                              <tbody>
                                
                              </tbody>
                            </table>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"> Cancelar</i></button>
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

  <!-- Modal -->
  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione a los voluntarios</h4>
        </div>
        <div class="modal-body">
          <table id="tblpersonas" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Primer Ap.</th>
              <th>Segundo Ap.</th>
              <th>Imagen</th>
              <th>Activo</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Primer Ap.</th>
              <th>Segundo Ap.</th>
              <th>Imagen</th>
              <th>Activo</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Fin modal -->

<?php
}else{

  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/asistenciaUsuario.js"></script>
<?php
}
ob_end_flush();
?>