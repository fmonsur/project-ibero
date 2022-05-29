<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class NuevoProyectoFiverr
{
	
	function __construct(){}

	function insertarProyecto(
		$nombre,
		$detalle,
		$id_moneda,
		$id_cliente,
		$id_usuario,
		$id_periodo_de_pago,
		$nivel,
		$valor_proyecto,
		$valor_proyecto_comision,
		$valor_proyecto_menos_comision,
		$valor_final_proyecto,
		$valor_proyecto_cop,
		$arte_check,
		$animacion_check,
		$subdireccioin_arte,
		$subdireccioin_animacion,
		$valor_arte,
		$valor_arte_final,
		$valor_animacion,
		$valor_animacion_final,
		$adelanto_check,
		$adelanto_valor_comision,
		$adelanto_valor_tasa,
		$valor_extra_arte,
		$valor_extra_arte_comision,
		$valor_extra_arte_comision_adelanto,
		$valor_extra_arte_menos_comision,
		$valor_extra_arte_final,
		$valor_extra_arte_forja,
		$valor_extra_animacion,
		$valor_extra_animacion_comision,
		$valor_extra_animacion_comision_adelanto,
		$valor_extra_animacion_menos_comision,
		$valor_extra_animacion_final,
		$valor_extra_animacion_forja,
		$valor_extra_sonido,
		$valor_extra_sonido_comision,
		$valor_extra_sonido_adelanto,
		$valor_extra_sonido_menos_comision,
		$valor_extra_sonido_final,
		$valor_extra_sonido_forja,
		$valor_tip,
		$valor_tip_comision,
		$valor_tip_comision_adelanto,
		$valor_tip_menos_comision,
		$valor_tip_final,
		$valor_tip_base_calculo,
		$valor_tip_arte,
		$valor_tip_animacion,
		$valor_tip_sonido,
		$valor_adminstrativo,
		$valor_administrativo_para_forja,
		$valor_operativo,
		$valor_pago_eps,
		$valor_pago_retencion,
		$porcentaje_comision,
		$porcentaje_descuento_delanto,
		$porcentaje_administrativo,
		$porcentaje_operativo,
		$porcentaje_arte,
		$porcenteje_animacion,
		$porcentaje_tip_arte,
		$porcentaje_tip_animacion,
		$porcentaje_tip_sonido,
		$porcentaje_extra_arte_forja,
		$porcentaje_extra_animacion_forja,
		$porcentaje_extra_sonido_forja,
		$fecha_inicio,
		$fecha_posible_fin,
		$fecha_fin,
		$fecha_registro
	){
		$sql = "INSERT INTO proyecto(
			nombre,
			detalle,
			id_moneda,
			id_cliente,
			id_usuario,
			id_periodo_de_pago,
			nivel,
			valor_proyecto,
			valor_proyecto_comision,
			valor_proyecto_menos_comision,
			valor_final_proyecto,
			valor_proyecto_cop,
			arte_check,
			animacion_check,
			subdireccioin_arte,
			subdireccioin_animacion,
			valor_arte,
			valor_arte_final,
			valor_animacion,
			valor_animacion_final,
			adelanto_check,
			adelanto_valor_comision,
			adelanto_valor_tasa,
			valor_extra_arte,
			valor_extra_arte_comision,
			valor_extra_arte_comision_adelanto,
			valor_extra_arte_menos_comision,
			valor_extra_arte_final,
			valor_extra_arte_forja,
			valor_extra_animacion,
			valor_extra_animacion_comision,
			valor_extra_animacion_comision_adelanto,
			valor_extra_animacion_menos_comision,
			valor_extra_animacion_final,
			valor_extra_animacion_forja,
			valor_extra_sonido,
			valor_extra_sonido_comision,
			valor_extra_sonido_adelanto,
			valor_extra_sonido_menos_comision,
			valor_extra_sonido_final,
			valor_extra_sonido_forja,
			valor_tip,
			valor_tip_comision,
			valor_tip_comision_adelanto,
			valor_tip_menos_comision,
			valor_tip_final,
			valor_tip_base_calculo,
			valor_tip_arte,
			valor_tip_animacion,
			valor_tip_sonido,
			valor_adminstrativo,
			valor_administrativo_para_forja,
			valor_operativo,
			valor_pago_eps,
			valor_pago_retencion,
			porcentaje_comision,
			porcentaje_descuento_delanto,
			porcentaje_administrativo,
			porcentaje_operativo,
			porcentaje_arte,
			porcenteje_animacion,
			porcentaje_tip_arte,
			porcentaje_tip_animacion,
			porcentaje_tip_sonido,
			porcentaje_extra_arte_forja,
			porcentaje_extra_animacion_forja,
			porcentaje_extra_sonido_forja,
			fecha_inicio,
			fecha_posible_fin,
			fecha_fin,
			fecha_registro)
		VALUES(
			'$nombre',
			'$detalle',
			'$id_moneda',
			'$id_cliente',
			'$id_usuario',
			'$id_periodo_de_pago',
			'$nivel',
			'$valor_proyecto',
			'$valor_proyecto_comision',
			'$valor_proyecto_menos_comision',
			'$valor_final_proyecto',
			'$valor_proyecto_cop',
			'$arte_check',
			'$animacion_check',
			'$subdireccioin_arte',
			'$subdireccioin_animacion',
			'$valor_arte',
			'$valor_arte_final',
			'$valor_animacion',
			'$valor_animacion_final',
			'$adelanto_check',
			'$adelanto_valor_comision',
			'$adelanto_valor_tasa',
			'$valor_extra_arte',
			'$valor_extra_arte_comision',
			'$valor_extra_arte_comision_adelanto',
			'$valor_extra_arte_menos_comision',
			'$valor_extra_arte_final',
			'$valor_extra_arte_forja',
			'$valor_extra_animacion',
			'$valor_extra_animacion_comision',
			'$valor_extra_animacion_comision_adelanto',
			'$valor_extra_animacion_menos_comision',
			'$valor_extra_animacion_final',
			'$valor_extra_animacion_forja',
			'$valor_extra_sonido',
			'$valor_extra_sonido_comision',
			'$valor_extra_sonido_adelanto',
			'$valor_extra_sonido_menos_comision',
			'$valor_extra_sonido_final',
			'$valor_extra_sonido_forja',
			'$valor_tip',
			'$valor_tip_comision',
			'$valor_tip_comision_adelanto',
			'$valor_tip_menos_comision',
			'$valor_tip_final',
			'$valor_tip_base_calculo',
			'$valor_tip_arte',
			'$valor_tip_animacion',
			'$valor_tip_sonido',
			'$valor_adminstrativo',
			'$valor_administrativo_para_forja',
			'$valor_operativo',
			'$valor_pago_eps',
			'$valor_pago_retencion',
			'$porcentaje_comision',
			'$porcentaje_descuento_delanto',
			'$porcentaje_administrativo',
			'$porcentaje_operativo',
			'$porcentaje_arte',
			'$porcenteje_animacion',
			'$porcentaje_tip_arte',
			'$porcentaje_tip_animacion',
			'$porcentaje_tip_sonido',
			'$porcentaje_extra_arte_forja',
			'$porcentaje_extra_animacion_forja',
			'$porcentaje_extra_sonido_forja',
			'$fecha_inicio',
			'$fecha_posible_fin',
			'$fecha_fin',
			'$fecha_registro'
		)";

		return ejecutarConsulta_retornaID($sql);
	}


	public function actualizarProyecto(
		$id_proyecto,
		$nombre,
		$detalle,
		$id_moneda,
		$id_cliente,
		$id_usuario,
		$id_periodo_de_pago,
		$nivel,
		$valor_proyecto,
		$valor_proyecto_comision,
		$valor_proyecto_menos_comision,
		$valor_final_proyecto,
		$valor_proyecto_cop,
		$arte_check,
		$animacion_check,
		$subdireccioin_arte,
		$subdireccioin_animacion,
		$valor_arte,
		$valor_arte_final,
		$valor_animacion,
		$valor_animacion_final,
		$adelanto_check,
		$adelanto_valor_comision,
		$adelanto_valor_tasa,
		$valor_extra_arte,
		$valor_extra_arte_comision,
		$valor_extra_arte_comision_adelanto,
		$valor_extra_arte_menos_comision,
		$valor_extra_arte_final,
		$valor_extra_arte_forja,
		$valor_extra_animacion,
		$valor_extra_animacion_comision,
		$valor_extra_animacion_comision_adelanto,
		$valor_extra_animacion_menos_comision,
		$valor_extra_animacion_final,
		$valor_extra_animacion_forja,
		$valor_extra_sonido,
		$valor_extra_sonido_comision,
		$valor_extra_sonido_adelanto,
		$valor_extra_sonido_menos_comision,
		$valor_extra_sonido_final,
		$valor_extra_sonido_forja,
		$valor_tip,
		$valor_tip_comision,
		$valor_tip_comision_adelanto,
		$valor_tip_menos_comision,
		$valor_tip_final,
		$valor_tip_base_calculo,
		$valor_tip_arte,
		$valor_tip_animacion,
		$valor_tip_sonido,
		$valor_adminstrativo,
		$valor_administrativo_para_forja,
		$valor_operativo,
		$valor_pago_eps,
		$valor_pago_retencion,
		$porcentaje_comision,
		$porcentaje_descuento_delanto,
		$porcentaje_administrativo,
		$porcentaje_operativo,
		$porcentaje_arte,
		$porcenteje_animacion,
		$porcentaje_tip_arte,
		$porcentaje_tip_animacion,
		$porcentaje_tip_sonido,
		$porcentaje_extra_arte_forja,
		$porcentaje_extra_animacion_forja,
		$porcentaje_extra_sonido_forja,
		$fecha_inicio,
		$fecha_posible_fin,
		$fecha_fin,
		$fecha_registro
	){
		$sql = "UPDATE proyecto SET 
		nombre = '$nombre',
		detalle = '$detalle',
		id_moneda = '$id_moneda',
		id_cliente = '$id_cliente',
		id_usuario = '$id_usuario',
		id_periodo_de_pago = '$id_periodo_de_pago',
		nivel = '$nivel',
		valor_proyecto = '$valor_proyecto',
		valor_proyecto_comision = '$valor_proyecto_comision',
		valor_proyecto_menos_comision = '$valor_proyecto_menos_comision',
		valor_final_proyecto = '$valor_final_proyecto',
		valor_proyecto_cop = '$valor_proyecto_cop',
		arte_check = '$arte_check',
		animacion_check = '$animacion_check',
		subdireccioin_arte = '$subdireccioin_arte',
		subdireccioin_animacion = '$subdireccioin_animacion',
		valor_arte = '$valor_arte',
		valor_arte_final = '$valor_arte_final',
		valor_animacion = '$valor_animacion',
		valor_animacion_final = '$valor_animacion_final',
		adelanto_check = '$adelanto_check',
		adelanto_valor_comision = '$adelanto_valor_comision',
		adelanto_valor_tasa = '$adelanto_valor_tasa',
		valor_extra_arte = '$valor_extra_arte',
		valor_extra_arte_comision = '$valor_extra_arte_comision',
		valor_extra_arte_comision_adelanto = '$valor_extra_arte_comision_adelanto',
		valor_extra_arte_menos_comision = '$valor_extra_arte_menos_comision',
		valor_extra_arte_final = '$valor_extra_arte_final',
		valor_extra_arte_forja = '$valor_extra_arte_forja',
		valor_extra_animacion = '$valor_extra_animacion',
		valor_extra_animacion_comision = '$valor_extra_animacion_comision',
		valor_extra_animacion_comision_adelanto = '$valor_extra_animacion_comision_adelanto',
		valor_extra_animacion_menos_comision = '$valor_extra_animacion_menos_comision',
		valor_extra_animacion_final = '$valor_extra_animacion_final',
		valor_extra_animacion_forja = '$valor_extra_animacion_forja',
		valor_extra_sonido = '$valor_extra_sonido',
		valor_extra_sonido_comision = '$valor_extra_sonido_comision',
		valor_extra_sonido_adelanto = '$valor_extra_sonido_adelanto',
		valor_extra_sonido_menos_comision = '$valor_extra_sonido_menos_comision',
		valor_extra_sonido_final = '$valor_extra_sonido_final',
		valor_extra_sonido_forja = '$valor_extra_sonido_forja',
		valor_tip = '$valor_tip',
		valor_tip_comision = '$valor_tip_comision',
		valor_tip_comision_adelanto = '$valor_tip_comision_adelanto',
		valor_tip_menos_comision = '$valor_tip_menos_comision',
		valor_tip_final = '$valor_tip_final',
		valor_tip_base_calculo = '$valor_tip_base_calculo',
		valor_tip_arte = '$valor_tip_arte',
		valor_tip_animacion = '$valor_tip_animacion',
		valor_tip_sonido = '$valor_tip_sonido',
		valor_adminstrativo = '$valor_adminstrativo',
		valor_administrativo_para_forja = '$valor_administrativo_para_forja',
		valor_operativo = '$valor_operativo',
		valor_pago_eps = '$valor_pago_eps',
		valor_pago_retencion = '$valor_pago_retencion',
		porcentaje_comision = '$porcentaje_comision',
		porcentaje_descuento_delanto = '$porcentaje_descuento_delanto',
		porcentaje_administrativo = '$porcentaje_administrativo',
		porcentaje_operativo = '$porcentaje_operativo',
		porcentaje_arte = '$porcentaje_arte',
		porcenteje_animacion = '$porcenteje_animacion',
		porcentaje_tip_arte = '$porcentaje_tip_arte',
		porcentaje_tip_animacion = '$porcentaje_tip_animacion',
		porcentaje_tip_sonido = '$porcentaje_tip_sonido',
		porcentaje_extra_arte_forja = '$porcentaje_extra_arte_forja',
		porcentaje_extra_animacion_forja = '$porcentaje_extra_animacion_forja',
		porcentaje_extra_sonido_forja = '$porcentaje_extra_sonido_forja',
		fecha_inicio = '$fecha_inicio',
		fecha_posible_fin = '$fecha_posible_fin',
		fecha_fin = '$fecha_fin',
		fecha_registro = '$fecha_registro'
		WHERE id = '$id_proyecto' ";

		return ejecutarConsulta($sql);
	}


	public function verProyectoPorId($id_proyecto){
		$sql = "SELECT * FROM proyecto WHERE id = '$id_proyecto'"; 
		return ejecutarConsultaSimpleFila($sql);
	}

	// public function registrarProyectoRetiro(
	// 	$fecha,
	// 	$id_proyecto,
	// 	$cantidad_usd,
	// 	$tasa,
	// 	$cambio_cop,
	// 	$fecha_registro,
	// 	$id_usuario
	// ){
	// 	$sql = "INSERT INTO retiros(
	// 		fecha,
	// 		detalle,
	// 		id_proyecto,
	// 		cantidad_usd,
	// 		tasa,
	// 		cambio_cop,
	// 		fecha_registro,
	// 		id_usuario)
	// 	VALUES(
	// 		'$fecha',
	// 		'Proyecto',
	// 		'$id_proyecto',
	// 		'$cantidad_usd',
	// 		'$tasa',
	// 		'$cambio_cop',
	// 		'$fecha_registro',
	// 		'$id_usuario'
	// 	)";

	// 	return ejecutarConsulta($sql);
	// }

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

	// public function crearUsuarioForjaEnUsuarioProyecto($id_proyecto){
	// 	$sql = "INSERT INTO usuario_proyecto(
	// 		id_proyecto,
	// 		id_usuario,
	// 		id_perfil)
	// 	VALUES(
	// 		'$id_proyecto',
	// 		1,
	// 		1
	// 	)";

	// 	return ejecutarConsulta($sql);		
	// }

	// public function insertarValoresUsuarioProyecto($id_proyecto,$id_usuario,$id_perfil,$porcentaje,$valor_ganado){
	// 	$sql = "INSERT INTO usuario_proyecto(
	// 		id_proyecto,
	// 		id_usuario,
	// 		id_perfil,
	// 		porcentaje,
	// 		valor_ganado)
	// 	VALUES(
	// 		'$id_proyecto',
	// 		'$id_usuario',
	// 		'$id_perfil',
	// 		'$porcentaje',
	// 		'$valor_ganado'
	// 	)";

	// 	return ejecutarConsulta($sql);
	// }

	public function insertarValorAdminstrativoForja(
		$id_proyecto,
		$id_usuario,
		$id_perfil,
		$porcentaje,
		$valor_ganado){
		$sql = "INSERT INTO usuario_proyecto (
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

	public function verUsuarioProyectoPorIdProyecto($id_proyecto){
		$sql = "SELECT
		u.nombre,
		u.apellido,
		p.nombre AS nombre_perfil,
		up.porcentaje,
		up.valor_ganado
		FROM usuario_proyecto up 
		INNER JOIN usuario u 
		ON u.id = up.id_usuario
		INNER JOIN perfil p
		ON p.id = up.id_perfil
		WHERE up.id_proyecto = '$id_proyecto'";

		return ejecutarConsulta($sql);
	}

	public function verDirectoresPorIdProyecto($id_proyecto){
		$sql = "SELECT	
		up.id,
		u.id AS id_usuario,
		u.nombre,
		u.apellido,
		p.nombre AS nombre_perfil,
		up.porcentaje,
		up.valor_ganado        
		FROM usuario_proyecto up 
		INNER JOIN usuario u 
		ON u.id = up.id_usuario
		INNER JOIN perfil p
		ON p.id = up.id_perfil
		WHERE up.id_proyecto = '$id_proyecto'
		AND p.es_direccion = 1";

		return ejecutarConsulta($sql);
	}

	public function verValorAdministrativoForjaIdProyecto($id_proyecto){
		$sql = "SELECT	
		up.id,
		u.nombre,
		u.apellido,
		p.nombre AS nombre_perfil,
		up.porcentaje,
		up.valor_ganado        
		FROM usuario_proyecto up 
		INNER JOIN usuario u 
		ON u.id = up.id_usuario
		INNER JOIN perfil p
		ON p.id = up.id_perfil
		WHERE up.id_proyecto = '$id_proyecto'
		AND up.id_usuario = 1
		AND up.id_perfil = 1";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function eliminarRegistrosUsuarioProyectoPorIdProyecto($id_proyecto){
		$sql = "DELETE FROM usuario_proyecto WHERE id_proyecto = '$id_proyecto'";
		return ejecutarConsulta($sql);
	}

	public function eliminarUsuarioProyectoPorIdProyectoPerfil($id_proyecto,$id_perfil){
		$sql = "DELETE FROM usuario_proyecto WHERE id_proyecto = '$id_proyecto' AND id_perfil = '$id_perfil'";
		return ejecutarConsulta($sql);
	}

	public function validarProyectoUsuarioPerfil($id_proyecto,$id_usuario,$id_perfil){
		$sql = "SELECT id FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto'
		AND id_usuario = '$id_usuario'
		AND id_perfil = '$id_perfil'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function obtenerUsuariosProyectoPorIdProyectoPerfil($id_proyecto,$id_perfil){
		$sql = "SELECT id FROM usuario_proyecto WHERE id_proyecto = '$id_proyecto' AND id_perfil = '$id_perfil' "; 
		return ejecutarConsulta($sql);
	}
	
	public function insertarUsuarioProyecto($id_proyecto,$id_usuario,$id_perfil,$porcentaje,$valor_ganado){
		$sql = "INSERT INTO usuario_proyecto(id_proyecto,id_usuario,id_perfil,porcentaje,valor_ganado)
		VALUES('$id_proyecto','$id_usuario','$id_perfil','$porcentaje','$valor_ganado')";

		return ejecutarConsulta($sql);		
	}

	public function actualizarUsuarioProyectoPorId($id,$porcentaje,$valor_ganado){
		$sql = "UPDATE usuario_proyecto 
		SET porcentaje = '$porcentaje', valor_ganado = '$valor_ganado'
		WHERE id = '$id' ";

		return ejecutarConsulta($sql);
	}

	public function validarUsuForjaEnUsuarioProyectoPerfil($id_proyecto,$id_perfil){
		$sql = "SELECT * FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto'
		AND id_usuario = 1
		AND id_perfil = '$id_perfil'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function validarUsuarioEnUsuarioProyectoPerfil($id_proyecto,$id_usuario,$id_perfil){
		$sql = "SELECT * FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto'
		AND id_usuario = '$id_usuario'
		AND id_perfil = '$id_perfil'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function cantidadUsuariosPorPerfilProyecto($id_proyecto,$id_perfil){
		$sql ="SELECT COUNT(id) AS cantidad 
		FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto'
		AND id_perfil = '$id_perfil'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function porcentajeUsuariosPorPerfilProyecto($id_proyecto,$id_perfil){
		$sql ="SELECT SUM(porcentaje) AS porcentaje 
		FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto'
		AND id_perfil = '$id_perfil'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function ActualizarValoresForjaUsuarioProyecto($id_usuario_proyecto,$porcentaje,$valor_ganado){
		$sql = "UPDATE usuario_proyecto SET porcentaje = '$porcentaje', valor_ganado = '$valor_ganado'
		WHERE id = '$id_usuario_proyecto'";

		return ejecutarConsulta($sql);
	}

	public function eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,$id_perfil){
		$sql = "DELETE FROM usuario_proyecto WHERE id_proyecto = '$id_proyecto' AND id_perfil = '$id_perfil'";

		return ejecutarConsulta($sql);
	}

	public function cargarTablaProyectoPerfil($id_proyecto,$id_perfil){
		$sql = "SELECT 
		p.id AS id,
		p.id_perfil,
		per.nombre AS perfil,
		u.nombre AS usuario_nombre,
		u.apellido AS usuario_apellidos,
		p.porcentaje,
		p.valor_ganado,
		per.es_direccion,
		p.id_usuario
		FROM usuario_proyecto p 
		INNER JOIN usuario u 
		ON u.id = p.id_usuario
		INNER JOIN perfil per 
		ON per.id = p.id_perfil
		WHERE id_proyecto = '$id_proyecto'
		AND p.id_perfil = '$id_perfil'
		 ";

		return ejecutarConsulta($sql);
	}

	public function cargarTablaProyectoPerfilSonido($id_proyecto){
		$sql = "SELECT 
		p.id AS id,
		p.id_perfil,
		per.nombre AS perfil,
		u.nombre AS usuario_nombre,
		u.apellido AS usuario_apellidos,
		p.porcentaje,
		p.valor_ganado,
		per.es_direccion,
		p.id_usuario
		FROM usuario_proyecto p 
		INNER JOIN usuario u 
		ON u.id = p.id_usuario
		INNER JOIN perfil per 
		ON per.id = p.id_perfil
		WHERE id_proyecto = '$id_proyecto'
		AND p.id_perfil = 4
		-- AND p.id_perfil = 7
        OR p.id_perfil = 7
		 ";

		return ejecutarConsulta($sql);
	}

	public function verTodosUsuarioProyecto($id_proyecto){
		$sql = "SELECT * FROM usuario_proyecto WHERE id_proyecto = '$id_proyecto'";

		return ejecutarConsulta($sql);
	}
}

