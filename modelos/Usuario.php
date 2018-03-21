<?php

//Incluímos la conexión a la base de datos
require_once "../config/Conexion.php";

class Usuario{

	//Constructor
	public function __construct(){

	}

	//Método para insertar registros
	static public function insertar($idcentro,$nombre,$papellido,$sapellido,$fechanacimiento,$correo,$telefono,$direccion,$imagen,$usuario,$password,$permisos){

		$sql = "INSERT INTO usuarios (idcentro,nombre,papellido,sapellido,fechanacimiento,correo,telefono,direccion,imagen,usuario,password,activo)
			VALUES ('$idcentro','$nombre','$papellido','$sapellido','$fechanacimiento','$correo','$telefono','$direccion','$imagen','$usuario','$password','1')";
		//return ejecutarConsulta($sql);
		$idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos)) {
			
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario,idpermiso) VALUES ('$idusuarionew', '$permisos[$num_elementos]')";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Método para editar registros
	static public function editar($idusuario,$idcentro,$nombre,$papellido,$sapellido,$fechanacimiento,$correo,$telefono,$direccion,$imagen,$usuario,$password,$permisos){

		$sql = "UPDATE usuarios SET idcentro='$idcentro',nombre='$nombre',papellido='$papellido',sapellido='$sapellido',fechanacimiento='$fechanacimiento',correo='$correo',telefono='$telefono',direccion='$direccion',imagen='$imagen',usuario='$usuario',password='$password' WHERE idusuario= '$idusuario'";

		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";

		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos)) {
			
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario,idpermiso) VALUES ('$idusuario', '$permisos[$num_elementos]')";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Método para desactivar registros
	static public function desactivar($idusuario){

		$sql = "UPDATE usuarios SET activo='0' WHERE idusuario= '$idusuario'";

		return ejecutarConsulta($sql);

	}

	//Método para activar registros
	static public function activar($idusuario){

		$sql = "UPDATE usuarios SET activo='1' WHERE idusuario= '$idusuario'";

		return ejecutarConsulta($sql);

	}

	//Método para mostrar los datos de un centro a modificar
	static public function mostrar($idusuario){

		$sql = "SELECT * FROM usuarios WHERE idusuario='$idusuario'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//Método para listar los registros
	static public function listar(){

		$sql = "SELECT u.idusuario,u.idcentro,c.nombre as centro,u.nombre,u.papellido,u.sapellido,u.fechanacimiento,u.correo,u.telefono,u.direccion,u.imagen,u.usuario,u.password,u.activo,u.fechac FROM usuarios u INNER JOIN centro c ON u.idcentro=c.idcentro";

		return ejecutarConsulta($sql);

	}

	//Método para listar los registros del usuario
	static public function listarUsuarios($idcentro){

		$sql = "SELECT u.idusuario,u.idcentro,c.nombre as centro,u.nombre,u.papellido,u.sapellido,u.fechanacimiento FROM usuarios u INNER JOIN centro c ON u.idcentro=c.idcentro WHERE u.idcentro = '$idcentro'";

		return ejecutarConsulta($sql);

	}

	//Método para listar los permisos marcados
	static public function listarmarcados($idusuario){

		$sql = "SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);

	}

	//Función para verificar el acceso al sistema
	static public function verificar($usuario,$password){

		$sql = "SELECT idusuario,idcentro,nombre,papellido,sapellido,fechanacimiento,correo,telefono,direccion,imagen,usuario FROM usuarios WHERE usuario='$usuario' AND password='$password' AND activo='1'";

		return ejecutarConsulta($sql);

	}

}

?>