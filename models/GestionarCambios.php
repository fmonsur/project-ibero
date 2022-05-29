<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class GestionarCambios
{
	
	function __construct(){}

	public function nuevoCambio($fecha,$detalle,$cantidad_usd,$tasa,$cambio_cop,$fecha_registro,$id_usuario){
		$consecutivo = ejecutarConsultaSimplefila("SELECT MAX(retiro_no)+1 AS siguiente FROM retiros");
		$retiro_no = $consecutivo['siguiente'];

		$sql = "INSERT INTO retiros(
			fecha,
			retiro_no,
			detalle,
			cantidad_usd,
			tasa,
			cambio_cop,
			fecha_registro,
			id_usuario)
		VALUES(
			'$fecha',
			'$retiro_no',
			'$detalle',
			'$cantidad_usd',
			'$tasa',
			'$cambio_cop',
			'$fecha_registro',
			'$id_usuario')";

		return ejecutarConsulta($sql);
	}

	public function totalesRetiro($campo){
		
		$sql = "SELECT SUM($campo) AS total FROM retiros";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarCanjes(){
		// $sql = "SELECT * FROM retiros WHERE retiro_no > 0 ";
		$sql = "SELECT * FROM retiros";

		return ejecutarConsulta($sql);
	}
}