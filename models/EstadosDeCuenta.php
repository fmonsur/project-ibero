<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class EstadosDeCuenta
{
	
	function __construct(){}


	public function listarProyectos(){
		$sql = "SELECT u.id,u.nombre,u.apellido,u.correo, SUM(up.valor_ganado) AS valor_ganado FROM usuario u 
INNER JOIN usuario_proyecto up 
ON up.id_usuario = u.id
GROUP BY u.id
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