<?php

//Incluímos la conexión a la base de datos
require_once "../config/Conexion.php";

class AsistenciaPersona{

	//Constructor
	public function __construct(){

	}

	//Método para insertar registros
	public function insertar($fecha,$idcentro,$idusuario,$leccion,$otra,$comentarios,$idpersona,$referencia){

		$sql = "INSERT INTO asistenciap (fecha,idcentro,idusuario,leccion,otra,comentarios,estado)
			VALUES ('$fecha','$idcentro','$idusuario','$leccion','$otra','$comentarios','Aceptado')";

		//return ejecutarConsulta($sql);
		$idasistenciapnew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idpersona)) {
			
			$sql_detalle = "INSERT INTO detalle_ap(idap,idpersona,referencia) VALUES ('$idasistenciapnew', '$idpersona[$num_elementos]','$referencia[$num_elementos]')";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}


	//Método para anular centros
	static public function anular($idap){

		$sql = "UPDATE asistenciap SET estado='Anulado' WHERE idap= '$idap'";

		return ejecutarConsulta($sql);

	}

	//Método para mostrar los datos de un centro a modificar
	static public function mostrar($idap){

		$sql = "SELECT a.idap,a.fecha,a.idcentro,a.idusuario,u.usuario as usuario,a.leccion,a.otra,a.comentarios,a.estado FROM asistenciap a INNER JOIN usuarios u ON a.idusuario=u.idusuario WHERE idap='$idap'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idap){

			$sql = "SELECT ap.idap,ap.idpersona,p.nombre,p.papellido,p.sapellido,ap.referencia FROM detalle_ap ap INNER JOIN persona p ON ap.idpersona=p.idpersona WHERE ap.idap = '$idap'";

			return ejecutarConsulta($sql);

	}

	//Método para listar los centros
	static public function listar(){

		$sql = "SELECT a.idap,a.fecha,a.idcentro,a.idusuario,u.usuario as usuario,a.leccion,a.otra,a.comentarios,a.estado,a.fechac FROM asistenciap a INNER JOIN usuarios u ON a.idusuario=u.idusuario ORDER BY a.idap DESC";

		return ejecutarConsulta($sql);

	}

}

?>