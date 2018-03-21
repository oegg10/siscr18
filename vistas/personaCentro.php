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
                          <h1 class="box-title">Persona <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            
                            <th>Opciones</th>
                            <th>Centro</th>
                            <th>Nombre</th>
                            <th>Primer Ap.</th>
                            <th>Segundo Ap.</th>
                            <th>Sexo</th>
                            <th>Correo</th>
                            <th>Edad</th>
                            <th>Ocupacion</th>
                            <th>COE</th>
                            <th>Activo</th>
                            <th>Fecha alta</th>

                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            
                            <th>Opciones</th>
                            <th>Centro</th>
                            <th>Nombre</th>
                            <th>Primer Ap.</th>
                            <th>Segundo Ap.</th>
                            <th>Sexo</th>
                            <th>Correo</th>
                            <th>Edad</th>
                            <th>Ocupacion</th>
                            <th>COE</th>
                            <th>Activo</th>
                            <th>Fecha alta</th>

                          </tfoot>

                        </table>
                    </div>
                    <div class="panel-body" style="height: 1200px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="hidden" name="idpersona" id="idpersona">

                            <input type="date" class="form-control" name="fecha" id="fecha" required>

                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="20" placeholder="Nombre" required>
                            
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Primer apellido(*):</label>
                            <input type="text" class="form-control" name="papellido" id="papellido" maxlength="20" placeholder="Primer apellido" required>
                            
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Segundo apellido:</label>
                            <input type="text" class="form-control" name="sapellido" id="sapellido" maxlength="20" placeholder="Segundo apellido">
                            
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Sexo(*):</label>
                            
                            <select name="sexo" id="sexo" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="MASCULINO">MASCULINO</option>
                              <option value="FEMENINO">FEMENINO</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha de nacimiento(*):</label>
                            <input type="date" class="form-control" name="fechanac" id="fechanac">
                            
                          </div>

                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Ocupación:</label>
                            <input type="text" class="form-control" name="ocupacion" id="ocupacion" maxlength="100" placeholder="Ocupacion">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estudios(*):</label>
                            
                            <select name="estudios" id="estudios" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NINGUNA">NINGUNO</option>
                              <option value="PRIMARIA">PRIMARIA</option>
                              <option value="SECUNDARIA">SECUNDARIA</option>
                              <option value="BACHILLERATO (PREPARATORIA)">BACHILLERATO (PREPARATORIA)</option>
                              <option value="PROFESIONAL">PROFESIONAL</option>
                              <option value="POSGRADO">POSGRADO</option>
                              <option value="SE IGNORA">SE IGNORA</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Religión(*):</label>
                            
                            <select name="religion" id="religion" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NINGUNA">NINGUNA</option>
                              <option value="CATOLICO (A)">CATOLICO (A)</option>
                              <option value="CRISTIANO (A)">CRISTIANO (A)</option>
                              <option value="JUDIO (A)">JUDIO (A)</option>
                              <option value="CREE EN DIOS">CREE EN DIOS</option>
                              <option value="OTRA">OTRA</option>

                            </select>
                            
                          </div>

                           <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" placeholder="Dirección">
                            
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="10" placeholder="Telefono">
                            
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Celular:</label>
                            <input type="text" class="form-control" name="celular" id="celular" maxlength="10" placeholder="Celular">
                            
                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Correo:</label>
                            <input type="email" class="form-control" name="correo" id="correo" maxlength="60" placeholder="Correo">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Facebook:</label>
                            <input type="text" class="form-control" name="facebook" id="facebook" maxlength="100" placeholder="Facebook">
                            
                          </div>

                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado Civil(*):</label>
                            
                            <select name="edocivil" id="edocivil" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="CASADO (A)">CASADO (A)</option>
                              <option value="UNION LIBRE">UNION LIBRE</option>
                              <option value="SEPARADO (A)">SEPARADO (A)</option>
                              <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                              <option value="VIUDO (A)">VIUDO (A)</option>
                              <option value="SOLTERO (A)">SOLTERO (A)</option>
                              <option value="SE IGNORA (A)">SE IGNORA (A)</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Hijos:</label>
                            <input type="text" class="form-control" name="hijos" id="hijos" maxlength="200" placeholder="Hijos">
                            
                          </div>

                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Hijas:</label>
                            <input type="text" class="form-control" name="hijas" id="hijas" maxlength="200" placeholder="Hijas">
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Resistol(*):</label>
                            
                            <select name="resistol" id="resistol" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Thiner(*):</label>
                            
                            <select name="thiner" id="thiner" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Marihuana(*):</label>
                            
                            <select name="marihuana" id="marihuana" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Cocaína(*):</label>
                            
                            <select name="cocaina" id="cocaina" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Piedra(*):</label>
                            
                            <select name="piedra" id="piedra" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Cristal(*):</label>
                            
                            <select name="cristal" id="cristal" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>LSD(*):</label>
                            
                            <select name="lsd" id="lsd" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <label>Otras drogas:</label>
                            <input type="text" class="form-control" name="otras" id="otras" maxlength="100" placeholder="Otras drogas">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Drogas que consume actualmente:</label>
                            <input type="text" class="form-control" name="actualmente" id="actualmente" maxlength="100" placeholder="Drogas que consume actualmente">
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tiempo de consumo:</label>
                            <input type="text" class="form-control" name="tiempo" id="tiempo" maxlength="100" placeholder="Tiempo de consumo">
                            
                          </div>
                            
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>¿En que otra cosa necesita ayuda?:</label>
                            <input type="text" class="form-control" name="ayuda" id="ayuda" maxlength="200" placeholder="¿En que otra cosa necesita ayuda?">
                            
                          </div>

                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>¿Quén lo recomendo con nosotros?:</label>
                            <input type="text" class="form-control" name="recomendaron" id="recomendaron" maxlength="100" placeholder="¿En que otra cosa necesita ayuda?">
                            
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>COE(*):</label>
                            
                            <select name="coe" id="coe" class="form-control selectpicker" required>
                              
                              <option value="SELECCIONE">SELECCIONE</option>
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>

                            </select>
                            
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Foto:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">

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
<script type="text/javascript" src="scripts/personaCentro.js"></script>
<?php
}
ob_end_flush();
?>