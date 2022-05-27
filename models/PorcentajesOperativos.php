<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class PorcentajesOperativos
{
	
	function __construct(){}

	public function listarPorcentajes(){
		$sql = "SELECT * FROM porcentajes_operativos";

		return ejecutarConsulta($sql);
	}

	public function listarActivos(){
		$sql = "SELECT * FROM porcentajes_operativos WHERE estado = 1";

		return ejecutarConsulta($sql);
	}
}