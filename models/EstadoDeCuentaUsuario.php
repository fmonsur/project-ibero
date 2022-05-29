<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class EstadoDeCuentaUsuario
{
	
	function __construct(){}


	public function obtenerEstadoDeCuenta($id_usuario){
		$sql = "SELECT 
		p.id,
		p.nombre AS nombre_proyecto,
		p.valor_proyecto,
		up.valor_ganado,
		pe.nombre AS perfil
		FROM proyecto p
		INNER JOIN usuario_proyecto up 
		ON up.id_proyecto = p.id
		INNER JOIN perfil pe 
		ON pe.id = up.id_perfil
		WHERE up.id_usuario = '$id_usuario'
		AND up.valor_ganado > 0
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