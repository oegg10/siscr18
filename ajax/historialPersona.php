<?php
if(strlen(session_id()) < 1)
session_start();

require_once "../modelos/HistorialPersona.php";

$hPersona = new HistorialPersona();

$idhp=isset($_POST["idhp"])? limpiarCadena($_POST["idhp"]):""; //idap = idasistenciapersona
$idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$idcentro=$_SESSION["idcentro"];
$idusuario=$_SESSION["idusuario"];
$comentarios=isset($_POST["comentarios"])? limpiarCadena($_POST["comentarios"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if(empty($idhp)){

			$rspta = $hPersona->insertar($idpersona,$idusuario,$comentarios);

			echo $rspta ? "Historial registrada" : "No se pudo registrar el historial";

		}else{

			$rspta = $hPersona->editar($idhp,$idpersona,$idusuario,$comentarios);

			echo $rspta ? "Historial actualizado" : "Historial no se pudo actualizar";

		}
		
		break;

	case 'mostrar':

		$rspta = $hPersona->mostrar($idhp);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		
		break;

	case 'listar':

		$rspta = $hPersona->listar();
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(

				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idhp.')"><i class="fa fa-eye"></i></button>',
				"2"=>$reg->nombre,
				"3"=>$reg->papellido,
				"4"=>$reg->sapellido,
				"5"=>$reg->coe,
				"6"=>($reg->activo)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
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

}

?>