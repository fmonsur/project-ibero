<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class NivelProyecto
{
	
	function __construct(){}

	public function listarNivelesProyecto(){
		$sql = "SELECT * FROM nivel_proyecto";

		return ejecutarConsulta($sql);
	}

	public function listarActivos(){
		$sql = "SELECT * FROM nivel_proyecto WHERE estado = 1";

		return ejecutarConsulta($sql);
	}

	public function nivelPorID($id){
		$sql = "SELECT * FROM nivel_proyecto WHERE id = '$id'";

		return ejecutarConsultaSimpleFila($sql);
	}

}