<?php

//Incluímos la conexión a la base de datos
require_once "../config/Conexion.php";

class Persona{

	//Constructor
	public function __construct(){

	}

	//Método para insertar centros
	static public function insertar($idcentro,$fecha,$nombre,$papellido,$sapellido,$sexo,$fechanac,$ocupacion,$estudios,$religion,$direccion,$telefono,$celular,$correo,$facebook,$edocivil,$hijos,$hijas,$resistol,$thiner,$marihuana,$cocaina,$piedra,$cristal,$lsd,$otras,$actualmente,$tiempo,$ayuda,$recomendaron,$coe,$imagen,$idusuario){

		$sql = "INSERT INTO persona (idcentro,fecha,nombre,papellido,sapellido,sexo,fechanac,ocupacion,estudios,religion,direccion,telefono,celular,correo,facebook,edocivil,hijos,hijas,resistol,thiner,marihuana,cocaina,piedra,cristal,lsd,otras,actualmente,tiempo,ayuda,recomendaron,imagen,idusuario,activo)
			VALUES ('$idcentro','$fecha','$nombre','$papellido','$sapellido','$sexo','$fechanac','$ocupacion','$estudios','$religion','$direccion','$telefono','$celular','$correo','$facebook','$edocivil','$hijos','$hijas','$resistol','$thiner','$marihuana','$cocaina','$piedra','$cristal','$lsd','$otras','$actualmente','$tiempo','$ayuda','$recomendaron','$coe','$imagen','$idusuario','1')";
		
		return ejecutarConsulta($sql);
		

	}

	//Método para editar centros
	static public function editar($idpersona,$idcentro,$fecha,$nombre,$papellido,$sapellido,$sexo,$fechanac,$ocupacion,$estudios,$religion,$direccion,$telefono,$celular,$correo,$facebook,$edocivil,$hijos,$hijas,$resistol,$thiner,$marihuana,$cocaina,$piedra,$cristal,$lsd,$otras,$actualmente,$tiempo,$ayuda,$recomendaron,$coe,$imagen,$idusuario){

		$sql = "UPDATE persona SET idcentro='$idcentro',fecha='$fecha',nombre='$nombre',papellido='$papellido',sapellido='$sapellido',sexo='$sexo',fechanac='$fechanac',ocupacion='$ocupacion',estudios='$estudios',religion='$religion',direccion='$direccion',telefono='$telefono',celular='$celular',correo='$correo',facebook='$facebook',edocivil='$edocivil',hijos='$hijos',hijas='$hijas',resistol='$resistol',thiner='$thiner',marihuana='$marihuana',cocaina='$cocaina',piedra='$piedra',cristal='$cristal',lsd='$lsd',otras='$otras',actualmente='$actualmente',tiempo='$tiempo',ayuda='$ayuda',recomendaron='$recomendaron',coe='$coe',imagen='$imagen',idusuario='$idusuario' WHERE idpersona= '$idpersona'";

		return ejecutarConsulta($sql);

	}

	//Método para desactivar centros
	static public function desactivar($idpersona){

		$sql = "UPDATE persona SET activo='0' WHERE idpersona= '$idpersona'";

		return ejecutarConsulta($sql);

	}

	//Método para activar centros
	static public function activar($idpersona){

		$sql = "UPDATE persona SET activo='1' WHERE idpersona= '$idpersona'";

		return ejecutarConsulta($sql);

	}

	//Método para mostrar los datos de un centro a modificar
	static public function mostrar($idpersona){

		$sql = "SELECT * FROM persona WHERE idpersona='$idpersona'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//Método para listar los registros del administrador
	static public function listar(){

		$sql = "SELECT p.idpersona,p.idcentro,c.nombre as centro,p.fecha,p.nombre,p.papellido,p.sapellido,p.sexo,p.fechanac,TIMESTAMPDIFF(YEAR, fechanac, CURDATE()) AS edad,p.ocupacion,p.estudios,p.religion,p.direccion,p.telefono,p.celular,p.correo,p.facebook,p.edocivil,p.hijos,p.hijas,p.resistol,p.thiner,p.marihuana,p.cocaina,p.piedra,p.cristal,p.lsd,p.otras,p.actualmente,p.tiempo,p.ayuda,p.recomendaron,p.coe,p.imagen,p.activo,p.idusuario,u.nombre as entrevistador,p.fechac FROM persona p INNER JOIN centro c ON p.idcentro=c.idcentro INNER JOIN usuarios u ON p.idusuario=u.idusuario";

		return ejecutarConsulta($sql);

	}

	//Método para listar los registros del usuario
	static public function listarUsuario($idcentro){

		$sql = "SELECT p.idpersona,p.idcentro,c.nombre as centro,p.fecha,p.nombre,p.papellido,p.sapellido,p.sexo,p.fechanac,TIMESTAMPDIFF(YEAR, fechanac, CURDATE()) AS edad,p.ocupacion,p.estudios,p.religion,p.direccion,p.telefono,p.celular,p.correo,p.facebook,p.edocivil,p.hijos,p.hijas,p.resistol,p.thiner,p.marihuana,p.cocaina,p.piedra,p.cristal,p.lsd,p.otras,p.actualmente,p.tiempo,p.ayuda,p.recomendaron,p.coe,p.imagen,p.activo,p.idusuario,u.nombre as entrevistador,p.fechac FROM persona p INNER JOIN centro c ON p.idcentro=c.idcentro INNER JOIN usuarios u ON p.idusuario=u.idusuario WHERE p.idcentro = '$idcentro'";

		return ejecutarConsulta($sql);

	}

	//Método para listar los registros del usuario
	static public function listarPersonas($idcentro){

		$sql = "SELECT p.idpersona,p.idcentro,c.nombre as centro,p.fecha,p.nombre,p.papellido,p.sapellido,p.sexo,p.fechanac,TIMESTAMPDIFF(YEAR, fechanac, CURDATE()) AS edad,p.ocupacion,p.estudios,p.religion,p.direccion,p.telefono,p.celular,p.correo,p.facebook,p.edocivil,p.hijos,p.hijas,p.resistol,p.thiner,p.marihuana,p.cocaina,p.piedra,p.cristal,p.lsd,p.otras,p.actualmente,p.tiempo,p.ayuda,p.recomendaron,p.coe,p.imagen,p.activo,p.idusuario,u.nombre as entrevistador,p.fechac FROM persona p INNER JOIN centro c ON p.idcentro=c.idcentro INNER JOIN usuarios u ON p.idusuario=u.idusuario WHERE p.idcentro = '$idcentro'";

		return ejecutarConsulta($sql);

	}
}

?>