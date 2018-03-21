var tabla;

//Función que se ejecuta al inicio
function init(){

	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){

		guardaryeditar(e);
	})

}

//Función limpiar
function limpiar(){

	$("#idcentro").val("");
	$("#nombre").val("");
	$("#direccion").val("");
	$("#estado").val("");
	$("#localidad").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#responsable").val("");
	$("#telresponsable").val("");
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
					url: '../ajax/centro.php?op=listar',
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

		url: "../ajax/centro.php?op=guardaryeditar",
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

function mostrar(idcentro){

	$.post("../ajax/centro.php?op=mostrar",{idcentro : idcentro}, function(data, status){

		data = JSON.parse(data);
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#direccion").val(data.direccion);
		$("#estado").val(data.estado);
		$("#localidad").val(data.localidad);
		$("#telefono").val(data.telefono);
		$("#correo").val(data.correo);
		$("#responsable").val(data.responsable);
		$("#telresponsable").val(data.telresponsable);
		$("#idcentro").val(data.idcentro);

	})
}

//Función para desactivar registros
function desactivar(idcentro){

	bootbox.confirm("¿Está seguro de desactivar el centro?", function(result){

		if(result){

			$.post("../ajax/centro.php?op=desactivar", {idcentro : idcentro}, function(e){

				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Función para activar registros
function activar(idcentro){

	bootbox.confirm("¿Está seguro de activar el centro?", function(result){

		if(result){

			$.post("../ajax/centro.php?op=activar", {idcentro : idcentro}, function(e){

				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();