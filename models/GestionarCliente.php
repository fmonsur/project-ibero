<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class GestionarCliente
{
	
	function __construct(){}

	public function nuevoCliente($nombre,$porcentaje_comision,$porcentaje_anticipo){
		$sql = "INSERT INTO cliente(
			nombre,
			porcentaje_comision,
			porcentaje_anticipo)
		VALUES(
			'$nombre',
			'$porcentaje_comision',
			'$porcentaje_anticipo')";

		return ejecutarConsulta($sql);
	}

	public function listarClientes(){
		$sql = "SELECT * FROM cliente";

		return ejecutarConsulta($sql);
	}

	public function listarActivos(){
		$sql = "SELECT * FROM cliente WHERE estado = 1";

		return ejecutarConsulta($sql);
	}

	public function verClientePorID($id){
		$sql = "SELECT * FROM cliente WHERE id = '$id'";

		return ejecutarConsultaSimpleFila($sql);
	}



}