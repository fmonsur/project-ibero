<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class NombreClase
{
	
	function __construct(){}

	public function select(){
		$sql = ("SELECT * FROM tabla WHERE campo = condicion");

		return ejecutarConsulta($sql);
	}

	public function selectFila(){
		$sql = ("SELECT * FROM tabla WHERE campo = condicion");

		return ejecutarConsultaSimpleFila($sql);
	}

	public function update(){
		$sql = ("UPDATE table SET campo = valor WHERE campo = condicion");

		return ejecutarConsulta($sql);
	}


}