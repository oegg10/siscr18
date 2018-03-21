<?php
if(strlen(session_id()) < 1)
session_start();

require_once "../modelos/AsistenciaPersona.php";

$aPersona = new AsistenciaPersona();

$idap=isset($_POST["idap"])? limpiarCadena($_POST["idap"]):""; //idap = idasistenciapersona
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$idcentro=$_SESSION["idcentro"];
$idusuario=$_SESSION["idusuario"];
$leccion=isset($_POST["leccion"])? limpiarCadena($_POST["leccion"]):"";
$otra=isset($_POST["otra"])? limpiarCadena($_POST["otra"]):"";
$comentarios=isset($_POST["comentarios"])? limpiarCadena($_POST["comentarios"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if(empty($idap)){

			$rspta = $aPersona->insertar($fecha,$idcentro,$idusuario,$leccion,$otra,$comentarios,$_POST["idpersona"],$_POST["referencia"]);

			echo $rspta ? "Asistencia registrada" : "No se pudieron registrar todos los datos de la asistencia";

		}else{

		}
		
		break;

	case 'anular':

		$rspta = $aPersona->anular($idap);

		echo $rspta ? "Asistencia anulada" : "Asistencia no se pudo anular";
		
		break;

	case 'mostrar':

		$rspta = $aPersona->mostrar($idap);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		
		break;

	case 'listarDetalle':
		//Recibir la asistencia
		$id = $_GET['id'];

		$rspta = $aPersona->listarDetalle($id);

		$total = 0;

		echo '<thead style="background-color: #A9D0F5">
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Primer Ap.</th>
                                <th>Segundo Ap.</th>
                                <th>Referencia</th>
                              </thead>';

		while ($reg = $rspta->fetch_object()) {

			
			echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->papellido.'</td><td>'.$reg->sapellido.'</td><td>'.$reg->referencia.'</td></tr>';

			$total = $total + 1;
		}

		echo '<tfoot>
                <th></th>
                <th></th>
                <th><h4><strong>Asistentes</strong></h4></th>
                <th></th>
                <th><h4 id="total">'.$total.'</h4></th>
              </tfoot>';

		break;

	case 'listar':

		$rspta = $aPersona->listar();
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(

				"0"=>($reg->estado=='Aceptado')?'<button class="btn btn-warning" onclick="mostrar('.$reg->idap.')"><i class="fa fa-eye"></i></button>'.
					 ' <button class="btn btn-danger" onclick="anular('.$reg->idap.')"><i class="fa fa-close"></i></button>':
					 '<button class="btn btn-warning" onclick="mostrar('.$reg->idap.')"><i class="fa fa-eye"></i></button>',
				"1"=>$reg->fecha,
				"2"=>$reg->usuario,
				"3"=>$reg->leccion,
				"4"=>$reg->otra,
				"5"=>$reg->comentarios,
				"6"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>',
				"7"=>$reg->fechac
			);
		}

		$results = array(

			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);

		echo json_encode($results);
		
		break;

	case 'listarPersonas':
		
		require_once "../modelos/Persona.php";
		$persona = new Persona();

		$idcentro=$_SESSION["idcentro"];
		$rspta = $persona->listarPersonas($idcentro);
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()){
			
			$nombrep = $reg->nombre." ".$reg->papellido." ".$reg->sapellido;

			$data[]=array(

				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idpersona.',\''.$nombrep.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->nombre,
				"2"=>$reg->papellido,
				"3"=>$reg->sapellido,
				"4"=>"<img src='../files/personas/".$reg->imagen."' height='50px' width='50px' >",
				"5"=>$reg->coe,
				"6"=>($reg->activo)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
			);
		}

		$results = array(

			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);

		echo json_encode($results);

		break;

}

?>