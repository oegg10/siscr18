<?php
if(strlen(session_id()) < 1)
session_start();

require_once "../modelos/Centro.php";

$centro = new Centro();

$idcentro=isset($_POST["idcentro"])? limpiarCadena($_POST["idcentro"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$localidad=isset($_POST["localidad"])? limpiarCadena($_POST["localidad"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$responsable=isset($_POST["responsable"])? limpiarCadena($_POST["responsable"]):"";
$telresponsable=isset($_POST["telresponsable"])? limpiarCadena($_POST["telresponsable"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if(empty($idcentro)){

			$rspta = $centro->insertar($nombre,$direccion,$estado,$localidad,$telefono,$correo,$responsable,$telresponsable);

			echo $rspta ? "Centro registrado" : "Centro no se pudo registrar";

		}else{

			$rspta = $centro->editar($idcentro,$nombre,$direccion,$estado,$localidad,$telefono,$correo,$responsable,$telresponsable);

			echo $rspta ? "Centro actualizado" : "Centro no se pudo actualizar";

		}
		
		break;

	case 'desactivar':

		$rspta = $centro->desactivar($idcentro);

		echo $rspta ? "Centro desactivado" : "Centro no se pudo desactivar";
		
		break;

	case 'activar':

		$rspta = $centro->activar($idcentro);

		echo $rspta ? "Centro activado" : "Centro no se pudo activar";
		
		break;

	case 'mostrar':

		$rspta = $centro->mostrar($idcentro);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		
		break;

	case 'listar':

		$rspta = $centro->listar();
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(

				"0"=>($reg->activo)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="fa fa-eye"></i></button>'.
					 ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcentro.')"><i class="fa fa-close"></i></button>':
					 '<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="fa fa-eye"></i></button>'.
					 ' <button class="btn btn-primary" onclick="activar('.$reg->idcentro.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->nombre,
				"2"=>$reg->direccion,
				"3"=>$reg->estado,
				"4"=>$reg->localidad,
				"5"=>$reg->telefono,
				"6"=>$reg->correo,
				"7"=>$reg->responsable,
				"8"=>$reg->telresponsable,
				"9"=>($reg->activo)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
				"10"=>$reg->fechac
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