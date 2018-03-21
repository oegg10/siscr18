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
	$("#nombrer").val("");
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
		listarUsuarios();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarUsuario").show();

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
					url: '../ajax/asistenciaUsuario.php?op=listar',
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
function listarUsuarios(){

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
					url: '../ajax/asistenciaUsuario.php?op=listarUsuarios',
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

		url: "../ajax/asistenciaUsuario.php?op=guardaryeditar",
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

function mostrar(idau){

	$.post("../ajax/asistenciaUsuario.php?op=mostrar",{idau : idau}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#fecha").val(data.fecha);
		$("#nombrer").val(data.nombrer);
		$("#comentarios").val(data.comentarios);
		$("#idau").val(data.idau);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarUsuario").hide();
 	});

 	$.post("../ajax/asistenciaUsuario.php?op=listarDetalle&id="+idau,function(r){
	        $("#detalles").html(r);
	});
}


//Declaración de variables necesarias para trabajar con las asistencias
var cont = 0; //Contar el número de asistentes
var detalles = 0; //cantidad de asistentes

$("#btnGuardar").hide();

function agregarDetalle(idusuario,nombre){

	if(idusuario!=""){

		var fila = '<tr class="filas" id="fila'+cont+'">'+
		'<td> <button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
		'<td><input type="hidden" name="idusuario[]" value="'+idusuario+'">'+nombre+'</td>'+
		'</tr>'; //Agrega las filas

		cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
		//$('#total').html(detalles);

		evaluar();

	}else{

		alert("Error al ingresar al voluntario");
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