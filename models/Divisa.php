<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class Divisa
{
	
	function __construct(){}

	public function listarDivisa(){
		$sql = "SELECT * FROM divisa";

		return ejecutarConsulta($sql);
	}

	public function listarActivos(){
		$sql = "SELECT * FROM divisa WHERE estado = 1";

		return ejecutarConsulta($sql);
	}
}