<?php

//Incluímos la conexión a la base de datos
require_once "../config/Conexion.php";

class Permiso{

	//Constructor
	public function __construct(){

	}

	//Método para listar los centros
	static public function listar(){

		$sql = "SELECT * FROM permiso";

		return ejecutarConsulta($sql);

	}

}

?>