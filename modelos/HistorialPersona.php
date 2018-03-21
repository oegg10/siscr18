<?php

//Incluímos la conexión a la base de datos
require_once "../config/Conexion.php";

class HistorialPersona{

	//Constructor
	public function __construct(){

	}

	//Método para insertar centros
	static public function insertar($idpersona,$idusuario,$comentarios){

		$sql = "INSERT INTO historialpersona (idpersona,idusuario,comentarios)
			VALUES ('$persona','$idusuario','$comentarios')";
		
		return ejecutarConsulta($sql);
		

	}

	//Método para editar centros
	static public function editar($idhp,$idpersona,$idusuario,$comentarios){

		$sql = "UPDATE historialpersona SET idpersona='$idpersona',idusuario='$idusuario',comentarios='$comentarios' WHERE idhp= '$idhp'";

		return ejecutarConsulta($sql);

	}

	//Método para mostrar los datos de un centro a modificar
	static public function mostrar($idhp){

		$sql = "SELECT * FROM historialpersona WHERE idhp='$idhp'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//Método para listar los registros del administrador
	static public function listar(){

		$sql = "SELECT h.idhp,h.idpersona,p.nombre,p.papellido,p.sapellido,p.coe,p.activo,u.idusuario,u.usuario as usuario,h.comentarios FROM historialpersona h INNER JOIN persona p ON h.idpersona=p.idpersona INNER JOIN usuarios u ON h.idusuario=u.idusuario";

		return ejecutarConsulta($sql);

	}
}

?>