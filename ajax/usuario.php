<?php
if(strlen(session_id()) < 1)
session_start();

require_once "../modelos/Usuario.php";

$user = new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$idcentro=isset($_POST["idcentro"])? limpiarCadena($_POST["idcentro"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$papellido=isset($_POST["papellido"])? limpiarCadena($_POST["papellido"]):"";
$sapellido=isset($_POST["sapellido"])? limpiarCadena($_POST["sapellido"]):"";
$fechanacimiento=isset($_POST["fechanacimiento"])? limpiarCadena($_POST["fechanacimiento"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$usuario=isset($_POST["usuario"])? limpiarCadena($_POST["usuario"]):"";
$password=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){

			$imagen=$_POST["imagenactual"];

		}else{

			$ext = explode(".", $_FILES["imagen"]["name"]);
			if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png"){

				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);

			}
		}

		//Hash SHA256 en la contraseña
		//$clavehash=hash("", $password);

		if(empty($idusuario)){

			$rspta = $user->insertar($idcentro,$nombre,$papellido,$sapellido,$fechanacimiento,$correo,$telefono,$direccion,$imagen,$usuario,$password,$_POST['permiso']); //Poner $clavehash en vez de $password

			echo $rspta ? "Usuario registrado" : "Usuario no se pudo registrar";

		}else{

			$rspta = $user->editar($idusuario,$idcentro,$nombre,$papellido,$sapellido,$fechanacimiento,$correo,$telefono,$direccion,$imagen,$usuario,$password,$_POST['permiso']); //Poner $clavehash en vez de $password

			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";

		}
		
		break;

	case 'desactivar':

		$rspta = $user->desactivar($idusuario);

		echo $rspta ? "Usuario desactivado" : "Usuario no se pudo desactivar";
		
		break;

	case 'activar':

		$rspta = $user->activar($idusuario);

		echo $rspta ? "Usuario activado" : "Usuario no se pudo activar";
		
		break;

	case 'mostrar':

		$rspta = $user->mostrar($idusuario);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		
		break;

	case 'listar':

		$rspta = $user->listar();
		//Declaramos un array
		$data = Array();

		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(

				"0"=>($reg->activo)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-eye"></i></button>'.
					 ' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
					 '<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-eye"></i></button>'.
					 ' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->centro,
				"2"=>$reg->nombre,
				"3"=>$reg->papellido,
				"4"=>$reg->sapellido,
				"5"=>$reg->correo,
				"6"=>$reg->telefono,
				//"7"=>$reg->direccion,
				"7"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
				//"9"=>$reg->usuario,
				//"10"=>$reg->password,
				"8"=>($reg->activo)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
				"9"=>$reg->fechac
			);
		}

		$results = array(

			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);

		echo json_encode($results);
		
		break;

		case 'selectCentro':
			
			require_once "../modelos/Centro.php";
			$centro = new Centro();
			$rspta = $centro->select();

			while ($reg = $rspta->fetch_object()) {
				
				echo '<option value=' . $reg->idcentro . '>' . $reg->nombre . '</option>';
			}

			break;

		case 'permisos':
			//Obtenemos todos los permisos de la tabla permisos
			require_once "../modelos/Permiso.php";
			$permiso = new Permiso();
			$rspta = $permiso->listar();

			//Obtener los permisos asignados al usuario
			$id=$_GET['id'];
			$marcados = $user->listarmarcados($id);

			//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenar los permisos asignados al usuario en el array
			while ($per = $marcados->fetch_object()) {
				
				array_push($valores, $per->idpermiso);
			}

			//Mostramos la lista de permisos en la vista y si están o no marcados
			while ($reg = $rspta->fetch_object()) {
				
				$sw=in_array($reg->idpermiso, $valores)?'checked':'';
				echo '<li> <input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.' </li>';
			}

			break;

		case 'verificar':
			
			$logina=$_POST['logina'];
			$clavea=$_POST['clavea'];

			//Hash SHA256 en la contraseña
			//$clavehash=hash("", $clavea);

			$rspta=$user->verificar($logina, $clavea);

			$fetch=$rspta->fetch_object();

			if(isset($fetch)){

				//Declaramos las variables de sesión
				$_SESSION['idusuario']=$fetch->idusuario;
				$_SESSION['idcentro']=$fetch->idcentro;
				$_SESSION['idusuario']=$fetch->idusuario;
				$_SESSION['nombre']=$fetch->nombre;
				$_SESSION['papellido']=$fetch->papellido;
				$_SESSION['sapellido']=$fetch->sapellido;
				$_SESSION['imagen']=$fetch->imagen;
				$_SESSION['usuario']=$fetch->usuario;

				//Obtenemos los permisos del usuario
				$marcados = $user->listarmarcados($fetch->idusuario);

				//Array para almacenar todos los permisos marcados
				$valores=array();

				//Almacenamos los permisos marcados en el array
				while ($per = $marcados->fetch_object()) {
					
					array_push($valores, $per->idpermiso);
				}

				//Determinamos los accesos del usuario
				in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
				in_array(2, $valores)?$_SESSION['administrador']=1:$_SESSION['administrador']=0;
				in_array(3, $valores)?$_SESSION['centro']=1:$_SESSION['centro']=0;
				in_array(4, $valores)?$_SESSION['usuario']=1:$_SESSION['usuario']=0;

			}

			echo json_encode($fetch);

			break;

		case 'salir':
			
			//Limpiamos las variables de sesión
			session_unset();

			//Destruimos la sesión
			session_destroy();

			//Redireccionamos al login
			header("Location: ../index.php");

			break;

}

?>