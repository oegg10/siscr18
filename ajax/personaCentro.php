<?php
if(strlen(session_id()) < 1)
session_start();

require_once "../modelos/Persona.php";

$persona = new Persona();

$idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$idcentro=$_SESSION["idcentro"];
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$papellido=isset($_POST["papellido"])? limpiarCadena($_POST["papellido"]):"";
$sapellido=isset($_POST["sapellido"])? limpiarCadena($_POST["sapellido"]):"";
$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
$fechanac=isset($_POST["fechanac"])? limpiarCadena($_POST["fechanac"]):"";
$ocupacion=isset($_POST["ocupacion"])? limpiarCadena($_POST["ocupacion"]):"";
$estudios=isset($_POST["estudios"])? limpiarCadena($_POST["estudios"]):"";
$religion=isset($_POST["religion"])? limpiarCadena($_POST["religion"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$celular=isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$facebook=isset($_POST["facebook"])? limpiarCadena($_POST["facebook"]):"";
$edocivil=isset($_POST["edocivil"])? limpiarCadena($_POST["edocivil"]):"";
$hijos=isset($_POST["hijos"])? limpiarCadena($_POST["hijos"]):"";
$hijas=isset($_POST["hijas"])? limpiarCadena($_POST["hijas"]):"";
$resistol=isset($_POST["resistol"])? limpiarCadena($_POST["resistol"]):"";
$thiner=isset($_POST["thiner"])? limpiarCadena($_POST["thiner"]):"";
$marihuana=isset($_POST["marihuana"])? limpiarCadena($_POST["marihuana"]):"";
$cocaina=isset($_POST["cocaina"])? limpiarCadena($_POST["cocaina"]):"";
$piedra=isset($_POST["piedra"])? limpiarCadena($_POST["piedra"]):"";
$cristal=isset($_POST["cristal"])? limpiarCadena($_POST["cristal"]):"";
$lsd=isset($_POST["lsd"])? limpiarCadena($_POST["lsd"]):"";
$otras=isset($_POST["otras"])? limpiarCadena($_POST["otras"]):"";
$actualmente=isset($_POST["actualmente"])? limpiarCadena($_POST["actualmente"]):"";
$tiempo=isset($_POST["tiempo"])? limpiarCadena($_POST["tiempo"]):"";
$ayuda=isset($_POST["ayuda"])? limpiarCadena($_POST["ayuda"]):"";
$recomendaron=isset($_POST["recomendaron"])? limpiarCadena($_POST["recomendaron"]):"";
$coe=isset($_POST["coe"])? limpiarCadena($_POST["coe"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$idusuario=$_SESSION["idusuario"];

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){

			$imagen=$_POST["imagenactual"];

		}else{

			$ext = explode(".", $_FILES["imagen"]["name"]);
			if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png"){

				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/personas/" . $imagen);

			}
		}

		if(empty($idpersona)){

			$rspta = $persona->insertar($idcentro,$fecha,$nombre,$papellido,$sapellido,$sexo,$fechanac,$ocupacion,$estudios,$religion,$direccion,$telefono,$celular,$correo,$facebook,$edocivil,$hijos,$hijas,$resistol,$thiner,$marihuana,$cocaina,$piedra,$cristal,$lsd,$otras,$actualmente,$tiempo,$ayuda,$recomendaron,$coe,$imagen,$idusuario);

			echo $rspta ? "Persona registrada" : "Persona NO se pudo registrar";

		}else{

			$rspta = $persona->editar($idpersona,$idcentro,$fecha,$nombre,$papellido,$sapellido,$sexo,$fechanac,$ocupacion,$estudios,$religion,$direccion,$telefono,$celular,$correo,$facebook,$edocivil,$hijos,$hijas,$resistol,$thiner,$marihuana,$cocaina,$piedra,$cristal,$lsd,$otras,$actualmente,$tiempo,$ayuda,$recomendaron,$coe,$imagen,$idusuario);

			echo $rspta ? "Persona actualizada" : "Persona NO se pudo actualizar";

		}
		
		break;

	case 'desactivar':

		$rspta = $persona->desactivar($idpersona);

		echo $rspta ? "Persona desactivada" : "Persona NO se pudo desactivar";
		
		break;

	case 'activar':

		$rspta = $persona->activar($idpersona);

		echo $rspta ? "Persona activada" : "Persona NO se pudo activar";
		
		break;

	case 'mostrar':

		$rspta = $persona->mostrar($idpersona);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		
		break;

	case 'listar':

		$idcentro=$_SESSION["idcentro"];
		$rspta = $persona->listarUsuario($idcentro);
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(

				"0"=>($reg->activo)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idpersona.')"><i class="fa fa-eye"></i></button>'.
					 ' <button class="btn btn-danger" onclick="desactivar('.$reg->idpersona.')"><i class="fa fa-close"></i></button>':
					 '<button class="btn btn-warning" onclick="mostrar('.$reg->idpersona.')"><i class="fa fa-eye"></i></button>'.
					 ' <button class="btn btn-primary" onclick="activar('.$reg->idpersona.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->centro,
				"2"=>$reg->nombre,
				"3"=>$reg->papellido,
				"4"=>$reg->sapellido,
				"5"=>$reg->sexo,
				"6"=>$reg->correo,
				"7"=>$reg->edad,
				"8"=>$reg->ocupacion,
				"9"=>$reg->coe,
				"10"=>($reg->activo)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
				"11"=>$reg->fechac
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