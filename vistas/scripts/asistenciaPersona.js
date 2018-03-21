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

	$("#fecha").val("");
	$("#leccion").val("");
	$("#otra").val("");
	$("#comentarios").val("");

	$(".filas").remove();
	$("#total").html("0");

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha').val(today);
	
}

//función mostrar formulario
function mostrarform(flag){

	limpiar();
	if(flag){

		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled", false);
		$("#btnagregar").hide();
		listarPersonas();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarPersona").show();

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
					url: '../ajax/asistenciaPersona.php?op=listar',
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

//Función para listar
function listarPersonas(){

	tabla=$('#tblpersonas').dataTable({

		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            //'copyHtml5',
		            //'excelHtml5',
		            //'csvHtml5',
		            //'pdf'
		        ],

		"ajax":
				{
					url: '../ajax/asistenciaPersona.php?op=listarPersonas',
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
	//$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/asistenciaPersona.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){

			bootbox.alert(datos);
			mostrarform(false);
			listar();
		}

	});

	limpiar();
}

function mostrar(idap){

	$.post("../ajax/asistenciaPersona.php?op=mostrar",{idap : idap}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#fecha").val(data.fecha);
		$("#leccion").val(data.leccion);
		$("#leccion").selectpicker('refresh');
		$("#otra").val(data.otra);
		$("#comentarios").val(data.comentarios);
		$("#idap").val(data.idap);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarPersona").hide();
 	});

 	$.post("../ajax/asistenciaPersona.php?op=listarDetalle&id="+idap,function(r){
	        $("#detalles").html(r);
	});
}

//Función para anular registros
function anular(idap){

	bootbox.confirm("¿Está seguro de anular esta asistencia?", function(result){

		if(result){

			$.post("../ajax/asistenciaPersona.php?op=anular", {idap : idap}, function(e){

				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Declaración de variables necesarias para trabajar con las asistencias
var cont = 0; //Contar el número de asistentes
var detalles = 0; //cantidad de asistentes

$("#btnGuardar").hide();

function agregarDetalle(idpersona,nombre){

	var referencia = "Sin Dato";

	if(idpersona!=""){

		var fila = '<tr class="filas" id="fila'+cont+'">'+
		'<td> <button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
		'<td><input type="hidden" name="idpersona[]" value="'+idpersona+'">'+nombre+'</td>'+
		'<td><input type="text" name="referencia[]" id="referencia[]" value="'+referencia+'" maxlength="10"></td>'+
		'</tr>'; //Agrega las filas

		cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
		//$('#total').html(detalles);

		evaluar();

	}else{

		alert("Error al ingresar a la persona");
	}

}

function evaluar(){

	if(detalles > 0){

		$("#btnGuardar").show();
		$('#total').html(detalles);

	}else{

		$("#btnGuardar").hide();
		cont=0;
		$('#total').html(detalles);
	}
}

function eliminarDetalle(indice){

  	$("#fila" + indice).remove();
  	detalles=detalles-1;
  	evaluar();

  }

init();