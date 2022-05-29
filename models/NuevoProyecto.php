<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class NuevoProyecto
{
	
	function __construct(){}

	public function nuevoProyecto(
		$nombre,
		$detalle,
		$id_cliente,
		$id_moneda,
		$nivel,
		$valor_proyecto,
		$porcentaje_comision,
		$valor_proyecto_comision,
		$valor_proyecto_menos_comision,
		$valor_final_proyecto,
		$porcentaje_administrativo,
		$porcentaje_operativo,
		$valor_adminstrativo,
		$valor_operativo,
		$porcentaje_arte,
		$valor_arte,
		$valor_tip_arte,
		$valor_arte_final,
		$porcenteje_animacion,
		$valor_animacion,
		$valor_tip_animacion,
		$valor_animacion_final,
		$valor_extra_arte,
		$valor_extra_arte_comision,
		$valor_extra_arte_menos_comision,
		$valor_extra_arte_final,
		$valor_extra_animacion,
		$valor_extra_animacion_comision,
		$valor_extra_animacion_menos_comision,
		$valor_extra_animacion_final,
		$valor_extra_sonido,
		$valor_extra_sonido_comision,
		$valor_extra_sonido_menos_comision,
		$valor_tip_sonido,
		$valor_extra_sonido_final,
		$valor_tip,
		$valor_tip_comision,
		$valor_tip_menos_comision,
		$valor_tip_base_calculo,
		$porcentaje_tip_arte,
		$porcentaje_tip_animacion,
		$porcentaje_tip_sonido,
		$valor_pago_eps,
		$valor_pago_retencion,
		$fecha_inicio,
		$fecha_posible_fin,
		$fecha_registro,
		$valor_extra_arte_forja,
		$valor_extra_animacion_forja, 
		$valor_extra_sonido_forja,
		$valor_tip_final,
		$id_usuario
	){
		$sql = "INSERT INTO proyecto(
			nombre,
			detalle,
			id_cliente,
			id_moneda,
			nivel,
			valor_proyecto,
			porcentaje_comision,
			valor_proyecto_comision,
			valor_proyecto_menos_comision,
			valor_final_proyecto,
			porcentaje_administrativo,
			porcentaje_operativo,
			valor_adminstrativo,
			valor_operativo,
			porcentaje_arte,
			valor_arte,
			valor_tip_arte,
			valor_arte_final,
			porcenteje_animacion,
			valor_animacion,
			valor_tip_animacion,
			valor_animacion_final,
			valor_extra_arte,
			valor_extra_arte_comision,
			valor_extra_arte_menos_comision,
			valor_extra_arte_final,
			valor_extra_animacion,
			valor_extra_animacion_comision,
			valor_extra_animacion_menos_comision,
			valor_extra_animacion_final,
			valor_extra_sonido,
			valor_extra_sonido_comision,
			valor_extra_sonido_menos_comision,
			valor_tip_sonido,
			valor_extra_sonido_final,
			valor_tip,
			valor_tip_comision,
			valor_tip_menos_comision,
			valor_tip_base_calculo,
			porcentaje_tip_arte,
			porcentaje_tip_animacion,
			porcentaje_tip_sonido,
			valor_pago_eps,
			valor_pago_retencion,
			fecha_inicio,
			fecha_posible_fin,
			fecha_registro,
			valor_extra_arte_forja,
			valor_extra_animacion_forja, 
			valor_extra_sonido_forja,
			valor_tip_final,
			id_usuario)
		VALUES(
			'$nombre',
			'$detalle',
			'$id_cliente',
			'$id_moneda',
			'$nivel',
			'$valor_proyecto',
			'$porcentaje_comision',
			'$valor_proyecto_comision',
			'$valor_proyecto_menos_comision',
			'$valor_final_proyecto',
			'$porcentaje_administrativo',
			'$porcentaje_operativo',
			'$valor_adminstrativo',
			'$valor_operativo',
			'$porcentaje_arte',
			'$valor_arte',
			'$valor_tip_arte',
			'$valor_arte_final',
			'$porcenteje_animacion',
			'$valor_animacion',
			'$valor_tip_animacion',
			'$valor_animacion_final',
			'$valor_extra_arte',
			'$valor_extra_arte_comision',
			'$valor_extra_arte_menos_comision',
			'$valor_extra_arte_final',
			'$valor_extra_animacion',
			'$valor_extra_animacion_comision',
			'$valor_extra_animacion_menos_comision',
			'$valor_extra_animacion_final',
			'$valor_extra_sonido',
			'$valor_extra_sonido_comision',
			'$valor_extra_sonido_menos_comision',
			'$valor_tip_sonido',
			'$valor_extra_sonido_final',
			'$valor_tip',
			'$valor_tip_comision',
			'$valor_tip_menos_comision',
			'$valor_tip_base_calculo',
			'$porcentaje_tip_arte',
			'$porcentaje_tip_animacion',
			'$porcentaje_tip_sonido',
			'$valor_pago_eps',
			'$valor_pago_retencion',
			'$fecha_inicio',
			'$fecha_posible_fin',
			'$fecha_registro',
			'$valor_extra_arte_forja',
			'$valor_extra_animacion_forja', 
			'$valor_extra_sonido_forja',
			'$valor_tip_final',
			'$id_usuario'
		)";

		return ejecutarConsulta_retornaID($sql);
	}

	public function registrarProyectoRetiro(
		$fecha,
		$id_proyecto,
		$cantidad_usd,
		$tasa,
		$cambio_cop,
		$fecha_registro,
		$id_usuario
	){
		$sql = "INSERT INTO retiros(
			fecha,
			detalle,
			id_proyecto,
			cantidad_usd,
			tasa,
			cambio_cop,
			fecha_registro,
			id_usuario)
		VALUES(
			'$fecha',
			'Proyecto',
			'$id_proyecto',
			'$cantidad_usd',
			'$tasa',
			'$cambio_cop',
			'$fecha_registro',
			'$id_usuario'
		)";

		return ejecutarConsulta($sql);
	}

	public function verFilaPorID($tabla, $id){
		$sql = "SELECT * FROM $tabla WHERE id = '$id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function verParametrosConfiguracion($parametro){
		$sql = "SELECT * FROM configuracion WHERE parametro = '$parametro'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function verNivelPorID($id_nivel){
		$sql = "SELECT * FROM nivel_proyecto WHERE id = '$id_nivel'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function crearUsuarioForjaEnUsuarioProyecto($id_proyecto){
		$sql = "INSERT INTO usuario_proyecto(
			id_proyecto,
			id_usuario,
			id_perfil)
		VALUES(
			'$id_proyecto',
			1,
			1
		)";

		return ejecutarConsulta($sql);		
	}

	public function insertarValoresUsuarioProyecto($id_proyecto,$id_usuario,$id_perfil,$porcentaje,$valor_ganado){
		$sql = "INSERT INTO usuario_proyecto(
			id_proyecto,
			id_usuario,
			id_perfil,
			porcentaje,
			valor_ganado)
		VALUES(
			'$id_proyecto',
			'$id_usuario',
			'$id_perfil',
			'$porcentaje',
			'$valor_ganado'
		)";

		return ejecutarConsulta($sql);
	}

}

