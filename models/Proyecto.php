<?php 
include '../config/conexion.php';

/**
 * Encoded By @FranciscoMonsalve
 */
class Proyecto
{
	
	function __construct(){}

	public function verProyectoPorId($id){
		$sql = "SELECT * FROM proyecto WHERE id = '$id'";

		return ejecutarConsultaSimpleFila($sql);
	}
	public function verFilaPorID($tabla, $id){
		$sql = "SELECT * FROM $tabla WHERE id = '$id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function selectUsuarioPorPerfil($id_perfil){
		$sql = "SELECT * FROM usuario_perfil up 
		INNER JOIN usuario u 
		ON u.id = up.id_usuario
		WHERE up.id_perfil = '$id_perfil'
		AND u.estado = 1";

		return ejecutarConsulta($sql);
	}

	public function actualizarProyecto(
		$id,
		$valor_avance,
		$valor_avance_comision,
		$valor_final_proyecto,
		$valor_adminstrativo,
		$valor_operativo,
		$valor_arte,
		$valor_tip_arte,
		$valor_arte_final,
		$valor_animacion,
		$valor_tip_animacion,
		$valor_animacion_final,
		$valor_extra_arte_comision_adelanto,
		$valor_extra_arte_final,
		$valor_extra_animacion_comision_adelanto,
		$valor_extra_animacion_final,
		$valor_extra_sonido_adelanto,
		$valor_tip_sonido,
		$valor_extra_sonido_final,
		$valor_tip_base_calculo,
		$porcentaje_tip_arte,
		$porcentaje_tip_animacion,
		$porcentaje_tip_sonido,
		$valor_extra_arte_forja,
		$valor_extra_animacion_forja,
		$valor_extra_sonido_forja,
		$valor_administrativo_para_forja,
		$valor_tip_comision_adelanto,
		$valor_tip_final
	)
	{
		$sql = "UPDATE proyecto SET
		valor_avance = '$valor_avance',
		valor_avance_comision = '$valor_avance_comision',
		valor_final_proyecto = '$valor_final_proyecto',
		valor_adminstrativo = '$valor_adminstrativo',
		valor_operativo = '$valor_operativo',
		valor_arte = '$valor_arte',
		valor_tip_arte = '$valor_tip_arte',
		valor_arte_final = '$valor_arte_final',
		valor_animacion = '$valor_animacion',
		valor_tip_animacion = '$valor_tip_animacion',
		valor_animacion_final = '$valor_animacion_final',
		valor_extra_arte_comision_adelanto = '$valor_extra_arte_comision_adelanto',
		valor_extra_arte_final = '$valor_extra_arte_final',
		valor_extra_animacion_comision_adelanto = '$valor_extra_animacion_comision_adelanto',
		valor_extra_animacion_final = '$valor_extra_animacion_final',
		valor_extra_sonido_adelanto = '$valor_extra_sonido_adelanto',
		valor_tip_sonido = '$valor_tip_sonido',
		valor_extra_sonido_final = '$valor_extra_sonido_final',
		valor_tip_base_calculo = '$valor_tip_base_calculo',
		porcentaje_tip_arte = '$porcentaje_tip_arte',
		porcentaje_tip_animacion = '$porcentaje_tip_animacion',
		porcentaje_tip_sonido = '$porcentaje_tip_sonido',
		valor_extra_arte_forja = '$valor_extra_arte_forja',
		valor_extra_animacion_forja = '$valor_extra_animacion_forja',
		valor_extra_sonido_forja = '$valor_extra_sonido_forja',
		valor_administrativo_para_forja = '$valor_administrativo_para_forja',
		valor_tip_comision_adelanto = '$valor_tip_comision_adelanto',
		valor_tip_final = '$valor_tip_final'
		
		WHERE id = '$id' ";

		return ejecutarConsulta($sql);	
	}

	public function selectEstados(){
		$sql = "SELECT * FROM estados WHERE estado = 1";

		return ejecutarConsulta($sql);
	}

	public function insertarUsuarioProyecto($id_proyecto,$id_usuario,$id_perfil){
		$sql = "INSERT INTO usuario_proyecto(id_proyecto,id_usuario,id_perfil)VALUES('$id_proyecto','$id_usuario','$id_perfil')";

		return ejecutarConsulta($sql);		
	}

	public function insertarUsuarioProyectoFull($id_proyecto,$id_usuario,$id_perfil,$porcentaje,$valor_ganado){
		$sql = "INSERT INTO usuario_proyecto(
			id_proyecto,id_usuario,id_perfil,porcentaje,valor_ganado
		)VALUES('$id_proyecto','$id_usuario','$id_perfil','$porcentaje','$valor_ganado')";

		return ejecutarConsulta($sql);		
	}

	public function validarProyectoUsuarioPerfil($id_proyecto,$id_usuario,$id_perfil){
		$sql = "SELECT id FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto'
		AND id_usuario = '$id_usuario'
		AND id_perfil = '$id_perfil'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarUsuarioProyectoPerfil($id_proyecto,$id_perfil){
		$sql = "SELECT 
		p.id AS id,
		u.nombre AS usuario_nombre,
		u.apellido AS usuario_apellidos,
		p.id_perfil,
		p.porcentaje,
		p.valor_ganado
		FROM usuario_proyecto p 
		INNER JOIN usuario u 
		ON u.id = p.id_usuario
		WHERE id_proyecto = '$id_proyecto'
		AND id_perfil = '$id_perfil'";

		return ejecutarConsulta($sql);
	}

	public function cargarTablaProyectoEspecialidad($id_proyecto,$id_especialidad){
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
		AND per.id_especialidad = '$id_especialidad'
		ORDER BY per.es_direccion DESC ";

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
		AND p.id_perfil = '$id_perfil' ";

		return ejecutarConsulta($sql);
	}


	public function eliminarUsuarioProyecto($id_usuario_proyecto){
		$sql = "DELETE FROM usuario_proyecto WHERE id = '$id_usuario_proyecto'";
		return ejecutarConsulta($sql);
	}

	public function actualizarUsuarioProyecto($id_usuario_proyecto,$porcentaje,$valor_ganado){
		$sql = "UPDATE usuario_proyecto 
		SET porcentaje = '$porcentaje', 
		valor_ganado = '$valor_ganado'
		WHERE id = '$id_usuario_proyecto'";
		return ejecutarConsulta($sql);
	}

	public function calcularTotalPorcentaje($id_proyecto,$id_perfil){
		$sql = "SELECT SUM(porcentaje) AS total_porcentaje FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto' 
		AND id_perfil = '$id_perfil'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function obtenerUsuariosPorTipoProyecto($id_proyecto,$tipo){
		$sql = "SELECT 
		up.id,
		up.porcentaje 
		FROM usuario_proyecto up 
		INNER JOIN perfil p 
		ON p.id = up.id_perfil
		WHERE id_proyecto = '$id_proyecto'
		AND p.es_direccion = '$tipo'";

		return ejecutarConsulta($sql);	
	}
	public function obtenerUsuariosPorProyectoPerfil($id_proyecto,$id_perfil){
		$sql = "SELECT 
		up.id,
		up.porcentaje 
		FROM usuario_proyecto up 
		INNER JOIN perfil p 
		ON p.id = up.id_perfil
		WHERE id_proyecto = '$id_proyecto'
		AND up.id_perfil = '$id_perfil'";

		return ejecutarConsulta($sql);	
	}

	public function recalcularValorGanado($id, $valor_ganado){
		$sql = "UPDATE usuario_proyecto 
		SET valor_ganado = '$valor_ganado'
		WHERE id = '$id'";
		return ejecutarConsulta($sql);
	}

	// =======================================================
	// OPTIMIZACIÓN DE CONSULTAS
	// =======================================================
	public function listarUsuariosPorProyectoDireccion($id_proyecto, $es_direccion){
		$sql = "SELECT * FROM usuario_proyecto up
		INNER JOIN perfil p 
		ON p.id = up.id_perfil
		WHERE up.id_proyecto = '$id_proyecto'
		AND p.es_direccion = '$es_direccion'";

		return ejecutarConsulta($sql);		
	}

	public function totalPorcentajePorProyectoDireccion($id_proyecto, $es_direccion){
		$sql = "SELECT SUM(up.porcentaje) AS total FROM usuario_proyecto up
		INNER JOIN perfil p 
		ON p.id = up.id_perfil
		WHERE up.id_proyecto = '$id_proyecto'
		AND p.es_direccion = '$es_direccion'";

		return ejecutarConsultaSimpleFila($sql);		
	}

	public function totalPorcentajePorProyectoDireccionPerfil($id_proyecto, $es_direccion, $id_perfil){
		$sql = "SELECT SUM(up.porcentaje) AS total FROM usuario_proyecto up
		INNER JOIN perfil p 
		ON p.id = up.id_perfil
		WHERE up.id_proyecto = '$id_proyecto'
		AND p.es_direccion = '$es_direccion'
		AND up.id_perfil = '$id_perfil' ";

		return ejecutarConsultaSimpleFila($sql);		
	}

	public function totalValorGanadoPorProyectoDireccion($id_proyecto, $es_direccion){
		$sql = "SELECT SUM(up.valor_ganado) AS total FROM usuario_proyecto up
		INNER JOIN perfil p 
		ON p.id = up.id_perfil
		WHERE up.id_proyecto = '$id_proyecto'
		AND p.es_direccion = '$es_direccion'";

		return ejecutarConsultaSimpleFila($sql);		
	}
	// ============================================================
	public function obtenerIdUsuarioProyectoForja($id_proyecto){
		$sql = "SELECT id FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto'
		AND id_usuario = 1
		AND id_perfil = 1 ";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function obtenerTodoPorIdUsuarioProyecto($id_usuario_proyecto){
		$sql = "SELECT * FROM usuario_proyecto 
		WHERE id = '$id_usuario_proyecto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,$id_usuario,$id_perfil){
		$sql = "SELECT * FROM usuario_proyecto 
		WHERE id_proyecto = '$id_proyecto' 
		AND id_usuario = '$id_usuario' 
		AND id_perfil = '$id_perfil'";

		return ejecutarConsultaSimpleFila($sql); 
		
	}

	public function obtenerPeriodosDePago(){
		$sql = "SELECT * FROM periodo_de_pago 
		WHERE estado = 1";

		return ejecutarConsulta($sql); 		
	}

	public function insertarAdelantoEnRetiros($fecha,$detalle,$id_proyecto,$cantidad_usd,$tasa,$cambio_cop){
		$sql = "INSERT INTO retiros(fecha,detalle,id_proyecto,cantidad_usd,tasa,cambio_cop)
		VALUES('$fecha','$detalle','$id_proyecto','$cantidad_usd','$tasa','$cambio_cop')";

		return ejecutarConsulta($sql);
	}

	public function eliminarAdelantoEnRetiros($id_proyecto){
		$sql = "DELETE FROM retiros WHERE id_proyecto = '$id_proyecto'";
		return ejecutarConsulta($sql);
	}

	public function totalesRetiro($campo){		
		$sql = "SELECT SUM($campo) AS total FROM retiros";
		return ejecutarConsultaSimpleFila($sql);
	}
}