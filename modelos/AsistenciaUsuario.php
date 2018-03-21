<?php

//Incluímos la conexión a la base de datos
require_once "../config/Conexion.php";

class AsistenciaUsuario{

	//Constructor
	public function __construct(){

	}

	//Método para insertar registros
	public function insertar($fecha,$idcentro,$idusuario,$comentarios,$idus){

		$sql = "INSERT INTO asistenciaus (fecha,idcentro,idusuario)
			VALUES ('$fecha','$idcentro','$idusuario')";

		//return ejecutarConsulta($sql);
		$idasistenciaus=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idus)) {
			
			$sql_detalle = "INSERT INTO detalle_us(idau,idus) VALUES ('$idasistenciaus', '$idus[$num_elementos]')";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Método para mostrar los datos de un centro a modificar
	static public function mostrar($idau){

		$sql = "SELECT a.fecha,a.idcentro,a.idusuario,u.usuario as responsable,a.comentarios,a.fechac FROM asistenciaus a INNER JOIN usuarios u ON a.idusuario=u.idusuario WHERE idau='$idau'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idau){

			$sql = "SELECT au.idau,au.idus,u.nombre,u.papellido,u.sapellido FROM detalle_us au INNER JOIN usuarios u ON au.idus=u.idusuario WHERE au.idau = '$idau'";

			return ejecutarConsulta($sql);

	}

	//Método para listar los centros
	static public function listar(){

		$sql = "SELECT a.idau,a.fecha,a.idcentro,a.idusuario,u.usuario as responsable,a.comentarios,a.fechac FROM asistenciaus a INNER JOIN usuarios u ON a.idusuario=u.idusuario ORDER BY a.idau DESC";

		return ejecutarConsulta($sql);

	}

}

?>