<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class GestionarProyectos
{
	
	function __construct(){}


	public function listarProyectos(){
		$sql = "SELECT 
		p.id,
		p.nombre,
		p.nivel,
		p.valor_proyecto,
		p.adelanto_check,
		c.nombre AS nombre_cliente,
		p.fecha_inicio,
		p.fecha_posible_fin,
		p.estado
		FROM proyecto p
		INNER JOIN cliente c 
		ON c.id = p.id_cliente
		";

		return ejecutarConsulta($sql);
	}

	public function eliminarUsuarioProyectoPorID($id_proyecto){
		$sql = "DELETE FROM usuario_proyecto WHERE id_proyecto ='$id_proyecto'";
		return ejecutarConsulta($sql);
	}

	public function eliminarProyectoPorID($id){
		$sql = "DELETE FROM proyecto WHERE id = '$id'";
		return ejecutarConsulta($sql);
	}
}