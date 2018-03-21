<?php
if(strlen(session_id()) < 1)
session_start();

require_once "../modelos/AsistenciaUsuario.php";

$aUsuario = new AsistenciaUsuario();

$idau=isset($_POST["idau"])? limpiarCadena($_POST["idau"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$idcentro=$_SESSION["idcentro"];
$idusuario=$_SESSION["idusuario"];
$comentarios=isset($_POST["comentarios"])? limpiarCadena($_POST["comentarios"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if(empty($idau)){

			$rspta = $aUsuario->insertar($fecha,$idcentro,$idusuario,$comentarios,$_POST["idus"]);

			echo $rspta ? "Asistencia de usuario registrada" : "No se pudieron registrar todos los datos de la asistencia del uasuario";

		}else{

		}
		
		break;

	case 'anular':

		$rspta = $aUsuario->anular($idau);

		echo $rspta ? "Asistencia anulada" : "Asistencia no se pudo anular";
		
		break;

	case 'mostrar':

		$rspta = $aUsuario->mostrar($idau);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		
		break;

	case 'listarDetalle':
		//Recibir la asistencia
		$id = $_GET['id'];

		$rspta = $aUsuario->listarDetalle($id);

		$total = 0;

		echo '<thead style="background-color: #A9D0F5">
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Primer Ap.</th>
                                <th>Segundo Ap.</th>
                              </thead>';

		while ($reg = $rspta->fetch_object()) {

			
			echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->papellido.'</td><td>'.$reg->sapellido.'</td></tr>';

			$total = $total + 1;
		}

		echo '<tfoot>
                <th></th>
                <th></th>
                <th><h4><strong>Voluntarios</strong></h4></th>
                <th></th>
                <th><h4 id="total">'.$total.'</h4></th>
              </tfoot>';

		break;

	case 'listar':

		$rspta = $aUsuario->listar();
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(

				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idap.')"><i class="fa fa-eye"></i></button>'
				"1"=>$reg->fecha,
				"2"=>$reg->responsable,
				"3"=>$reg->comentarios,
				"4"=>$reg->fechac
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
		
		require_once "../modelos/Usuario.php";
		$usuario = new Usuario();

		$idcentro=$_SESSION["idcentro"];
		$rspta = $usuario->listarUsuarios($idcentro);
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()){
			
			$nombreu = $reg->nombre." ".$reg->papellido." ".$reg->sapellido;

			$data[]=array(

				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idusuario.',\''.$nombreu.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->nombre,
				"2"=>$reg->papellido,
				"3"=>$reg->sapellido,
				"4"=>"<img src='../files/personas/".$reg->imagen."' height='50px' width='50px' >",
				"5"=>($reg->activo)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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