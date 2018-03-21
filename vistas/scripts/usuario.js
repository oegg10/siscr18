var tabla;

//Función que se ejecuta al inicio
function init(){

  mostrarform(false);
  listar();

  $("#formulario").on("submit", function(e){

    guardaryeditar(e);
    
  })

  //Cargamos los items al select centro
  $.post("../ajax/usuario.php?op=selectCentro", function(r){

        $("#idcentro").html(r);
        $('#idcentro').selectpicker('refresh');

  });

  $("#imagenmuestra").hide();

  //Mostramos los permisos
  $.post("../ajax/usuario.php?op=permisos&id=", function(r){

    $("#permisos").html(r);

  });

}

//Función limpiar
function limpiar(){

  $("#nombre").val("");
  $("#papellido").val("");
  $("#sapellido").val("");
  $("#fechanacimiento").val("");
  $("#correo").val("");
  $("#telefono").val("");
  $("#direccion").val("");
  $("#usuario").val("");
  $("#password").val("");
}

//función mostrar formulario
function mostrarform(flag){

  limpiar();
  if(flag){

    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#btnGuardar").prop("disabled", false);
    $("#btnagregar").hide();

  }else{

    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#btnagregar").show();

  }

}

//función cancelar formulario
function cancelarform(){

  limpiar();
  mostrarform(false);

}

//Función para listar
function listar(){

  tabla=$('#tbllistado').dataTable({

    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [              
                //'copyHtml5',
                'excelHtml5',
                //'csvHtml5',
                'pdf'
            ],

    "ajax":
        {
          url: '../ajax/usuario.php?op=listar',
          type : "get",
          dataType : "json",            
          error: function(e){
            console.log(e.responseText);  
          }
        },

    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
      "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
  }).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e){

  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({

    url: "../ajax/usuario.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function(datos){

      bootbox.alert(datos);
      mostrarform(false);
      tabla.ajax.reload();
    }

  });

  limpiar();
}

function mostrar(idusuario){

  $.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status){

    data = JSON.parse(data);
    mostrarform(true);

    $("#idcentro").val(data.idcentro);
    $('#idcentro').selectpicker('refresh');
    $("#nombre").val(data.nombre);
    $("#papellido").val(data.papellido);
    $("#sapellido").val(data.sapellido);
    $("#fechanacimiento").val(data.fechanacimiento);
    $("#correo").val(data.correo);
    $("#telefono").val(data.telefono);
    $("#direccion").val(data.direccion);
    $("#imagenmuestra").show();
    $("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
    $("#imagenactual").val(data.imagen);
    $("#usuario").val(data.usuario);
    $("#password").val(data.password);
    $("#idusuario").val(data.idusuario);

  });

  $.post("../ajax/usuario.php?op=permisos&id="+idusuario, function(r){

    $("#permisos").html(r);

  });
}

//Función para desactivar registros
function desactivar(idusuario){

  bootbox.confirm("¿Está seguro de desactivar el usuario?", function(result){

    if(result){

      $.post("../ajax/usuario.php?op=desactivar", {idusuario : idusuario}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}

//Función para activar registros
function activar(idusuario){

  bootbox.confirm("¿Está seguro de activar el usuario?", function(result){

    if(result){

      $.post("../ajax/usuario.php?op=activar", {idusuario : idusuario}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  })
}

init();