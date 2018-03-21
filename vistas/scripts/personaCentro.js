var tabla;

//Función que se ejecuta al inicio
function init(){

	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){

		guardaryeditar(e);
	})


  $("#imagenmuestra").hide();

}

//Función limpiar
function limpiar(){

	$("#fecha").val("");
	$("#centro").val("");
	$("#nombre").val("");
	$("#papellido").val("");
	$("#sapellido").val("");
	$("#sexo").val("");
	$("#fechanac").val("");
	$("#ocupacion").val("");
	$("#estudios").val("");
	$("#religion").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#celular").val("");
	$("#correo").val("");
	$("#facebook").val("");
	$("#edocivil").val("");
	$("#hijos").val("");
	$("#hijas").val("");
	$("#resistol").val("");
	$("#thiner").val("");
	$("#marihuana").val("");
	$("#cocaina").val("");
	$("#piedra").val("");
	$("#cristal").val("");
	$("#lsd").val("");
	$("#otras").val("");
	$("#actualmente").val("");
	$("#tiempo").val("");
	$("#ayuda").val("");
	$("#recomendaron").val("");
	$("#coe").val("");
	$("#idusuario").val("");
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
					url: '../ajax/personaCentro.php?op=listar',
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

		url: "../ajax/persona.php?op=guardaryeditar",
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

function mostrar(idpersona){

	$.post("../ajax/persona.php?op=mostrar",{idpersona : idpersona}, function(data, status){

		data = JSON.parse(data);
		mostrarform(true);

		$("#fecha").val(data.fecha);
		$("#nombre").val(data.nombre);
		$("#papellido").val(data.papellido);
		$("#sapellido").val(data.sapellido);
		$("#sexo").val(data.sexo);
		$("#sexo").selectpicker('refresh');
		$("#fechanac").val(data.fechanac);
		$("#ocupacion").val(data.ocupacion);
		$("#estudios").val(data.estudios);
		$("#estudios").selectpicker('refresh');
		$("#religion").val(data.religion);
		$("#religion").selectpicker('refresh');
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#celular").val(data.celular);
		$("#correo").val(data.correo);
		$("#facebook").val(data.facebook);
		$("#edocivil").val(data.edocivil);
		$("#edocivil").selectpicker('refresh');
		$("#hijos").val(data.hijos);
		$("#hijas").val(data.hijas);
		$("#resistol").val(data.resistol);
		$("#resistol").selectpicker('refresh');
		$("#thiner").val(data.thiner);
		$("#thiner").selectpicker('refresh');
		$("#marihuana").val(data.marihuana);
		$("#marihuana").selectpicker('refresh');
		$("#cocaina").val(data.cocaina);
		$("#cocaina").selectpicker('refresh');
		$("#piedra").val(data.piedra);
		$("#piedra").selectpicker('refresh');
		$("#cristal").val(data.cristal);
		$("#cristal").selectpicker('refresh');
		$("#lsd").val(data.lsd);
		$("#lsd").selectpicker('refresh');
		$("#otras").val(data.otras);
		$("#actualmente").val(data.actualmente);
		$("#tiempo").val(data.tiempo);
		$("#ayuda").val(data.ayuda);
		$("#recomendaron").val(data.recomendaron);
		$("#coe").val("");
		$("#idpersona").val(data.idpersona);

	})
}

//Función para desactivar registros
function desactivar(idpersona){

	bootbox.confirm("¿Está seguro de desactivar a esta persona?", function(result){

		if(result){

			$.post("../ajax/persona.php?op=desactivar", {idpersona : idpersona}, function(e){

				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Función para activar registros
function activar(idpersona){

	bootbox.confirm("¿Está seguro de activar a esta persona?", function(result){

		if(result){

			$.post("../ajax/persona.php?op=activar", {idpersona : idpersona}, function(e){

				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();