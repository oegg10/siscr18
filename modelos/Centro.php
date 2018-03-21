<?php

//Incluímos la conexión a la base de datos
require_once "../config/Conexion.php";

class Centro{

	//Constructor
	public function __construct(){

	}

	//Método para insertar centros
	static public function insertar($nombre,$direccion,$estado,$localidad,$telefono,$correo,$responsable,$telresponsable){

		$sql = "INSERT INTO centro (nombre,direccion,estado,localidad,telefono,correo,responsable,telresponsable,activo)
			VALUES ('$nombre','$direccion','$estado','$localidad','$telefono','$correo','$responsable','$telresponsable','1')";
		return ejecutarConsulta($sql);

	}

	//Método para editar centros
	static public function editar($idcentro,$nombre,$direccion,$estado,$localidad,$telefono,$correo,$responsable,$telresponsable){

		$sql = "UPDATE centro SET nombre='$nombre',direccion='$direccion',estado='$estado',localidad='$localidad',telefono='$telefono',correo='$correo',responsable='$responsable',telresponsable='$telresponsable' WHERE idcentro= '$idcentro'";
		return ejecutarConsulta($sql);

	}

	//Método para desactivar centros
	static public function desactivar($idcentro){

		$sql = "UPDATE centro SET activo='0' WHERE idcentro= '$idcentro'";

		return ejecutarConsulta($sql);

	}

	//Método para activar centros
	static public function activar($idcentro){

		$sql = "UPDATE centro SET activo='1' WHERE idcentro= '$idcentro'";

		return ejecutarConsulta($sql);

	}

	//Método para mostrar los datos de un centro a modificar
	static public function mostrar($idcentro){

		$sql = "SELECT * FROM centro WHERE idcentro='$idcentro'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//Método para listar los centros
	static public function listar(){

		$sql = "SELECT * FROM centro";

		return ejecutarConsulta($sql);

	}

	//Método para listar los registros y mostrar en el select
	static public function select(){

		$sql = "SELECT * FROM centro WHERE activo=1";

		return ejecutarConsulta($sql);

	}

}

?>