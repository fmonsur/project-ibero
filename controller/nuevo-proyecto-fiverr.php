<?php 
// session_start();
include '../models/NuevoProyectoFiverr.php';
$mdl_nuevoProyectoFiverr = new NuevoProyectoFiverr();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$hora = date('G:i:s');
$fecha_registro = date('Y-m-d G:i:s');


$id_proyecto = isset($_POST['id_proyecto'])? limpiarCadena($_POST['id_proyecto']) : "" ;
$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']): "";
$nivel = isset($_POST['nivel'])? limpiarCadena($_POST['nivel']): "";
$valor_proyecto = isset($_POST['valor_proyecto'])? limpiarCadena($_POST['valor_proyecto']): "";
$arte_check = isset($_POST['arte_check'])? limpiarCadena($_POST['arte_check']): "";
$animacion_check = isset($_POST['animacion_check'])? limpiarCadena($_POST['animacion_check']): "";
$subdireccioin_arte = isset($_POST['subdireccioin_arte'])? limpiarCadena($_POST['subdireccioin_arte']): "";
$subdireccioin_animacion = isset($_POST['subdireccioin_animacion'])? limpiarCadena($_POST['subdireccioin_animacion']): "";
$adelanto_check = isset($_POST['adelanto_check'])? limpiarCadena($_POST['adelanto_check']): "";
$valor_extra_arte = isset($_POST['valor_extra_arte'])? limpiarCadena($_POST['valor_extra_arte']): "";
$valor_extra_animacion = isset($_POST['valor_extra_animacion'])? limpiarCadena($_POST['valor_extra_animacion']): "";
$valor_extra_sonido = isset($_POST['valor_extra_sonido'])? limpiarCadena($_POST['valor_extra_sonido']): "";
$valor_tip = isset($_POST['valor_tip'])? limpiarCadena($_POST['valor_tip']): "";
$id_usuario_proyecto = isset($_POST['id_usuario_proyecto'])? limpiarCadena($_POST['id_usuario_proyecto']): "";
$id_perfil = isset($_POST['id_perfil'])? limpiarCadena($_POST['id_perfil']): "";
$valor_extra_sonido_forja = isset($_POST['valor_extra_sonido_forja'])? limpiarCadena($_POST['valor_extra_sonido_forja']): "";

$valor_administrativo_para_forja = isset($_POST['valor_administrativo_para_forja'])? limpiarCadena($_POST['valor_administrativo_para_forja']) : "" ;


$id_usuario = 1;


switch ($_GET['op']) {
	case 'insertarProyecto':
		$cliente = $mdl_nuevoProyectoFiverr->verFilaPorID('cliente', 1);
		$data_nivel = $mdl_nuevoProyectoFiverr->verNivelPorID($nivel);

		$valor_proyecto_comision = ($valor_proyecto*$cliente['porcentaje_comision'])/100;
		$valor_proyecto_menos_comision = $valor_proyecto - $valor_proyecto_comision;

		$porcentaje_comision = $cliente['porcentaje_comision'];
		$porcentaje_administrativo = $mdl_nuevoProyectoFiverr->verParametrosConfiguracion('porcentaje_administrativo');
		$porcentaje_administrativo = $porcentaje_administrativo['valor'];
		$porcentaje_operativo = $mdl_nuevoProyectoFiverr->verParametrosConfiguracion('porcentaje_operativo');
		$porcentaje_operativo = $porcentaje_operativo['valor'];

		// ======================================
		// ADELANTO
		// ======================================
		if ($adelanto_check == '1') {
			$porcentaje_descuento_delanto = $cliente['porcentaje_anticipo'];
			$adelanto_valor_comision = ($valor_proyecto_menos_comision*$cliente['porcentaje_anticipo'])/100;
		}else{
			$adelanto_valor_comision = 0;
			$porcentaje_descuento_delanto = 0;
		}


		$valor_final_proyecto = $valor_proyecto_menos_comision - $adelanto_valor_comision;
		$valor_adminstrativo = ($valor_final_proyecto*$porcentaje_administrativo)/100;
		$valor_operativo = ($valor_final_proyecto*$porcentaje_operativo)/100;



		// ======================================
		// CALCULOS - VALOR ARTE Y ANIMACIO
		// ======================================
		if ($arte_check == '1' && $animacion_check == '1') {
			$porcentaje_arte = $data_nivel['arte'];
			$porcenteje_animacion = $data_nivel['animacion'];
		}elseif ($arte_check == '1' && $animacion_check == '') {
			$porcentaje_arte = 100;
			$porcenteje_animacion = 0;
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,3);
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,6);
		}elseif ($arte_check == '' && $animacion_check == '1') {
			$porcentaje_arte = 0;
			$porcenteje_animacion = 100;
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,2);
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,5);
		}

		$valor_arte = ($valor_operativo*$porcentaje_arte)/100;
		$valor_animacion = ($valor_operativo*$porcenteje_animacion)/100;

		// ======================================
		// EXTRA SONIDO
		// ======================================
		if ($valor_extra_sonido) {
			$valor_extra_sonido_comision = ($valor_extra_sonido*$cliente['porcentaje_comision'])/100;
			$valor_extra_sonido_menos_comision = $valor_extra_sonido - $valor_extra_sonido_comision;
			if ($adelanto_check == '1') {
				$valor_extra_sonido_adelanto = ($valor_extra_sonido_menos_comision*$cliente['porcentaje_anticipo'])/100;
			}else{
				$valor_extra_sonido_adelanto = 0;
			}
		}else{
			$valor_extra_sonido = 0;
			$valor_extra_sonido_comision = 0;
			$valor_extra_sonido_menos_comision = 0;
			$valor_extra_sonido_adelanto = 0;
		}

		$valor_extra_sonido_final = $valor_extra_sonido_menos_comision - $valor_extra_sonido_adelanto;

		if ($valor_extra_sonido_final != 0) {
			$porcentaje_extra_sonido_forja = $mdl_nuevoProyectoFiverr->verParametrosConfiguracion('porcentaje_extra_sonido_forja');
			$porcentaje_extra_sonido_forja = $porcentaje_extra_sonido_forja['valor'];
			$valor_extra_sonido_forja = ($valor_extra_sonido_final*$porcentaje_extra_sonido_forja)/100; 
		}else{
			$porcentaje_extra_sonido_forja = 0;
			$valor_extra_sonido_forja = 0;
		}

		// ======================================
		// EXTRA ARTE
		// ======================================
		if ($valor_extra_arte) {
			$valor_extra_arte_comision = ($valor_extra_arte * $cliente['porcentaje_comision'])/100;
			$valor_extra_arte_menos_comision = $valor_extra_arte - $valor_extra_arte_comision; 
			if ($adelanto_check == '1') {
				$valor_extra_arte_comision_adelanto = ($valor_extra_arte_menos_comision*$porcentaje_descuento_delanto)/100;
			}else{
				$valor_extra_arte_comision_adelanto = 0;
			}
		}else{
			$valor_extra_arte_comision = 0;
			$valor_extra_arte_comision_adelanto = 0; 
			$valor_extra_arte_menos_comision = 0; 
			$valor_extra_arte_final = 0; 
			$valor_extra_arte_forja = 0; 
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,8);
		}
		
		$valor_extra_arte_final = $valor_extra_arte_menos_comision - $valor_extra_arte_comision_adelanto;
		if ($valor_extra_arte_final != 0) {
			$porcentaje_extra_arte_forja = $mdl_nuevoProyectoFiverr->verParametrosConfiguracion('porcentaje_extra_arte_forja');
			$porcentaje_extra_arte_forja = $porcentaje_extra_arte_forja['valor'];
			$valor_extra_arte_forja = ($valor_extra_arte_final*$porcentaje_extra_arte_forja)/100;

			$validar_usuario = $mdl_nuevoProyectoFiverr->validarUsuForjaEnUsuarioProyectoPerfil($id_proyecto,8);
			if (!$validar_usuario) {
				$mdl_nuevoProyectoFiverr->insertarValorAdminstrativoForja(
					$id_proyecto,
					1,
					8,
					$porcentaje_extra_arte_forja,
					$valor_extra_arte_forja);
			}
				
		}else{
			$porcentaje_extra_arte_forja = 0;
			$valor_extra_arte_forja = 0;
		}

		// ======================================
		// EXTRA ANIMACIÓN
		// ======================================
		if ($valor_extra_animacion) {
			$valor_extra_animacion_comision = ($valor_extra_animacion * $cliente['porcentaje_comision'])/100;
			$valor_extra_animacion_menos_comision = $valor_extra_animacion - $valor_extra_animacion_comision; 
			if ($adelanto_check == '1') {
				$valor_extra_animacion_comision_adelanto = ($valor_extra_animacion_menos_comision*$porcentaje_descuento_delanto)/100;
			}else{
				$valor_extra_animacion_comision_adelanto = 0;
			}
		}else{
			$valor_extra_animacion_comision = 0;
			$valor_extra_animacion_comision_adelanto = 0; 
			$valor_extra_animacion_menos_comision = 0; 
			$valor_extra_animacion_final = 0; 
			$valor_extra_animacion_forja = 0; 
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,9);
		}
		
		$valor_extra_animacion_final = $valor_extra_animacion_menos_comision - $valor_extra_animacion_comision_adelanto;
		if ($valor_extra_animacion_final != 0) {
			$porcentaje_extra_animacion_forja = $mdl_nuevoProyectoFiverr->verParametrosConfiguracion('porcentaje_extra_animacion_forja');
			$porcentaje_extra_animacion_forja = $porcentaje_extra_animacion_forja['valor'];
			$valor_extra_animacion_forja = ($valor_extra_animacion_final*$porcentaje_extra_animacion_forja)/100;

			$validar_usuario = $mdl_nuevoProyectoFiverr->validarUsuForjaEnUsuarioProyectoPerfil($id_proyecto,9);
			if ($validar_usuario) {
			}else{
				$mdl_nuevoProyectoFiverr->insertarValorAdminstrativoForja(
					$id_proyecto,
					1,
					9,
					$porcentaje_extra_animacion_forja,
					$valor_extra_animacion_forja);

			}

		}else{
			$porcentaje_extra_animacion_forja = 0;
			$valor_extra_animacion_forja = 0;
		}

		// ======================================
		// TIP
		// ======================================
		if($valor_tip){
			$valor_tip_comision = ($valor_tip*$cliente['porcentaje_comision'])/100;
			$valor_tip_menos_comision = $valor_tip-$valor_tip_comision;
			if ($adelanto_check == '1') {
				$valor_tip_comision_adelanto = ($valor_tip_menos_comision*$cliente['porcentaje_anticipo'])/100;
			}else{
				$valor_tip_comision_adelanto = 0;
			}
		}else{
			$valor_tip = 0;
			$valor_tip_comision = 0;
			$valor_tip_menos_comision = 0;
			$valor_tip_comision_adelanto = 0;
		}

		$valor_tip_final = $valor_tip_menos_comision - $valor_tip_comision_adelanto;
		$valor_tip_base_calculo = $valor_arte+$valor_animacion+$valor_extra_sonido_final;
		$porcentaje_tip_arte = ($valor_arte/$valor_tip_base_calculo)*100;
		$porcentaje_tip_animacion = ($valor_animacion/$valor_tip_base_calculo)*100;
		$porcentaje_tip_sonido = ($valor_extra_sonido_final/$valor_tip_base_calculo)*100;
		$valor_tip_arte = ($valor_tip_final*$porcentaje_tip_arte)/100;
		$valor_tip_animacion = ($valor_tip_final*$porcentaje_tip_animacion)/100;
		$valor_tip_sonido = ($valor_tip_final*$porcentaje_tip_sonido)/100;

		$valor_arte_final = $valor_arte + $valor_tip_arte;
		$valor_animacion_final = $valor_animacion + $valor_tip_animacion;

		// ======================================
		// VALOR ADMINISTRATIVO FORJA
		// ======================================
		if ($subdireccioin_arte == '1' && $subdireccioin_animacion == '1') {
			$valor_administrativo_para_forja = $valor_adminstrativo * 0.5;
		}elseif ($subdireccioin_arte == '1' && $subdireccioin_animacion == '') {
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoPerfil($id_proyecto,3);
			$valor_administrativo_para_forja = $valor_adminstrativo * 0.75;
		}elseif ($subdireccioin_arte == '' && $subdireccioin_animacion == '1') {
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoPerfil($id_proyecto,2);
			$valor_administrativo_para_forja = $valor_adminstrativo * 0.75;
		}else{
			$valor_administrativo_para_forja = $valor_adminstrativo;
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoPerfil($id_proyecto,2);
			$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoPerfil($id_proyecto,3);
		}


		$data = array(
			// '00-id_proyecto'=>$respuesta,

			'01-nombre'=>$nombre,
			'01a-valor_proyecto'=>$valor_proyecto,
			'01b-porcentaje_comision'=>$porcentaje_comision,
			'03-valor_proyecto_comision'=>$valor_proyecto_comision,
			'04-valor_proyecto_menos_comision'=>$valor_proyecto_menos_comision, 
			'04a-adelanto_check'=>$adelanto_check, 
			'04b-adelanto_valor_comision'=>$adelanto_valor_comision, 
			'04b-porcentaje_descuento_delanto'=>$porcentaje_descuento_delanto, 
			'04c-valor_final_proyecto'=>$valor_final_proyecto, 
			'05-nivel'=>$nivel,
			'06-arte_check'=>$arte_check,
			'07-animacion_check'=>$animacion_check,
			'08-valor_adminstrativo'=>$valor_adminstrativo,
			'08a-valor_administrativo_para_forja'=>$valor_administrativo_para_forja,
			'09-valor_operativo'=>$valor_operativo,
			'10-porcentaje_administrativo'=>$porcentaje_administrativo,
			'11-porcentaje_operativo'=>$porcentaje_operativo,
			'12-porcentaje_arte'=>$porcentaje_arte,
			'13-porcenteje_animacion'=>$porcenteje_animacion,
			'100-ar00 Arte'=>'============================',
			'100-ar01-valor_arte'=>$valor_arte,
			'100-ar02-valor_tip_arte'=>$valor_tip_arte,
			'100-ar03-valor_arte_final'=>$valor_arte_final,
			'100-ar04-subdireccioin_arte'=>$subdireccioin_arte,
			'200-an00 Animacion'=>'============================',
			'200-an01-valor_animacion'=>$valor_animacion,
			'200-an02-valor_tip_animacion'=>$valor_tip_animacion,
			'200-an03-valor_animacion_final'=>$valor_animacion_final,
			'200-an04-subdireccioin_animacion'=>$subdireccioin_animacion,
			'400-ar00-Extra Arte'=>'============================',
			'400-ar01-valor_extra_arte'=>$valor_extra_arte,
			'400-ar02-valor_extra_arte_comision'=>$valor_extra_arte_comision,
			'400-ar03-valor_extra_arte_menos_comision'=>$valor_extra_arte_menos_comision,
			'400-ar04-valor_extra_arte_comision_adelanto'=>$valor_extra_arte_comision_adelanto,
			'400-ar05-valor_extra_arte_final'=>$valor_extra_arte_final,
			'400-ar06-valor_extra_arte_forja'=>$valor_extra_arte_forja,
			'400-ar06-porcentaje_extra_arte_forja'=>$porcentaje_extra_arte_forja,
			'500-ani00-Extra Animacion'=>'============================',
			'500-ani01-valor_extra_animacion'=>$valor_extra_animacion,
			'500-ani02-valor_extra_animacion_comision'=>$valor_extra_animacion_comision,
			'500-ani03-valor_extra_animacion_menos_comision'=>$valor_extra_animacion_menos_comision,
			'500-ani04-valor_extra_animacion_comision_adelanto'=>$valor_extra_animacion_comision_adelanto,
			'500-ani05-valor_extra_animacion_final'=>$valor_extra_animacion_final,
			'500-ani06-valor_extra_animacion_forja'=>$valor_extra_animacion_forja,
			'500-ani07-porcentaje_extra_animacion_forja'=>$porcentaje_extra_animacion_forja,
			'600-s00-Sonido'=>'============================',
			'600-s01-valor_extra_sonido'=>$valor_extra_sonido,
			'600-s02-valor_extra_sonido_comision'=>$valor_extra_sonido_comision,
			'600-s02-valor_extra_sonido_menos_comision'=>$valor_extra_sonido_menos_comision,
			'600-s03-valor_extra_sonido_adelanto'=>$valor_extra_sonido_adelanto,
			'600-s04-valor_tip_sonido'=>$valor_tip_sonido,
			'600-s05-valor_extra_sonido_final'=>$valor_extra_sonido_final,
			'600-s06-valor_extra_sonido_forja'=>$valor_extra_sonido_forja,
			'600-s07-porcentaje_extra_sonido_forja'=>$porcentaje_extra_sonido_forja,
			'700-t00-Tip'=>'============================',
			'700-t01-valor_tip'=>$valor_tip,
			'700-t02-valor_tip_comision'=>$valor_tip_comision,
			'700-t03-valor_tip_menos_comision'=>$valor_tip_menos_comision,
			'700-t04-valor_tip_comision_adelanto'=>$valor_tip_comision_adelanto,
			'700-t05-valor_tip_final'=>$valor_tip_final,
			'700-t06-valor_tip_base_calculo'=>$valor_tip_base_calculo,
			'700-t07-porcentaje_tip_arte'=>$porcentaje_tip_arte,
			'700-t08-porcentaje_tip_animacion'=>$porcentaje_tip_animacion,
			'700-t09-porcentaje_tip_sonido'=>$porcentaje_tip_sonido
			
		); 

		if ($id_proyecto) {
			 $respuesta = $mdl_nuevoProyectoFiverr->actualizarProyecto(
			 	$id_proyecto,
				$nombre,
				'Nuevo proyecto', // $detalle,
				1, //id_moneda
				1, //id_cliente
				$id_usuario,
				1, // $id_periodo_de_pago,
				$nivel,
				$valor_proyecto,
				$valor_proyecto_comision,
				$valor_proyecto_menos_comision,
				$valor_final_proyecto,
				0, // $valor_proyecto_cop,
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
				0, //$adelanto_valor_tasa,
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
				0,//$valor_pago_eps,
				0,//$valor_pago_retencion,
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
				'2022-01-01',//$fecha_inicio,
				'2022-01-01',//$fecha_posible_fin,
				'2022-01-01',//$fecha_fin,
				$fecha_registro);
		
		}else{
			$respuesta = $mdl_nuevoProyectoFiverr->insertarProyecto(
				$nombre,
				'Nuevo proyecto', // $detalle,
				1, //id_moneda
				1, //id_cliente
				$id_usuario,
				1, // $id_periodo_de_pago,
				$nivel,
				$valor_proyecto,
				$valor_proyecto_comision,
				$valor_proyecto_menos_comision,
				$valor_final_proyecto,
				0, // $valor_proyecto_cop,
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
				0, //$adelanto_valor_tasa,
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
				0,//$valor_pago_eps,
				0,//$valor_pago_retencion,
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
				'2022-01-01',//$fecha_inicio,
				'2022-01-01',//$fecha_posible_fin,
				'2022-01-01',//$fecha_fin,
				$fecha_registro);

			$id_proyecto = $respuesta;
		}
		

		if ($respuesta) {




			// ======================================================
			// ELIMINAR VALOR ARTE Y ANIMACIO DEPENDIENDO DEL CHECK
			// ======================================================
			// if ($arte_check == '0' && $animacion_check == '0') {




				// $mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,1);
				// $mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,3);
				// $mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,6);
				// $mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,2);
				// $mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,5);

				
			// }elseif ($arte_check == '1' && $animacion_check == '') {
			// 	$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,3);
			// 	$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,6);
			// }elseif ($arte_check == '' && $animacion_check == '1') {
			// 	$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,2);
			// 	$mdl_nuevoProyectoFiverr->eliminarUsuarioProyectoPorIdProyectoRol($id_proyecto,5);
			// }





			$mensaje_respuesta = array(
				"estado"=>1,
				"icon"=>'success',
				"title"=>'Proyecto creado!',
				"text"=>'El proyecto ha sido creado con exito',
				"id_proyecto"=>$id_proyecto,
				"eliminarUsuarioProyectoPorIdProyectoRol"=>$mdl_nuevoProyectoFiverr,
				// "insertarValoresForjaExtraSonido"=>$insertarValoresForjaExtraSonido
			);
			// $mdl_nuevoProyectoFiverr->eliminarRegistrosUsuarioProyectoPorIdProyecto($id_proyecto);
		}else{
			$mensaje_respuesta = array(
				"estado"=>0,
				"icon"=>'error',
				"title"=>'!Error',
				"text"=>'No ha sido posible crear el proyecto',
				// "mensaje"=>$datos,
			);
			// echo json_encode('No guardo');
		}

		echo json_encode($mensaje_respuesta);

		break;
	case 'verProyectoPorId':
		$respuesta = $mdl_nuevoProyectoFiverr->verProyectoPorId($id_proyecto);
		echo json_encode($respuesta);
		break;
	case 'insertarValorAdminstrativoForja':
		$validar_usuario = $mdl_nuevoProyectoFiverr->validarUsuForjaEnUsuarioProyectoPerfil($id_proyecto,1);
		
		if ($subdireccioin_arte == '0' && $subdireccioin_animacion == '0') {
			$porcentaje = 100; 
		}elseif($subdireccioin_arte == '1' && $subdireccioin_animacion == '0'){
			$porcentaje = 75; 
		}elseif($subdireccioin_arte == '0' && $subdireccioin_animacion == '1'){
			$porcentaje = 75; 
		}elseif($subdireccioin_arte == '1' && $subdireccioin_animacion == '1'){
			$porcentaje = 50; 
		}

		if ($validar_usuario) {
			$mensaje_respuesta = 'Valor administrativo Forja existente';
			$mdl_nuevoProyectoFiverr->ActualizarValoresForjaUsuarioProyecto($validar_usuario['id'],$porcentaje,$valor_administrativo_para_forja);
		}else{

			$respuesta = $mdl_nuevoProyectoFiverr->insertarValorAdminstrativoForja(
				$id_proyecto,
				1,
				1,
				$porcentaje,
				$valor_administrativo_para_forja);

			if ($respuesta) {
				$mensaje_respuesta = 'Valor administrativo Forja almacenado con exito';
			}else{
				$mensaje_respuesta = 'Error al almacenar valor administrativo Forja';
			}
		}

		echo json_encode($mensaje_respuesta);
		// echo json_encode($validar_usuario);
		break;
	case 'insertarValorDireccionSonidoForja':
		$validar_usuario = $mdl_nuevoProyectoFiverr->validarUsuForjaEnUsuarioProyectoPerfil($id_proyecto,4); 
		if ($validar_usuario) {
			$mensaje_respuesta = 'Valor administrativo Forja existente';
			// $mdl_nuevoProyectoFiverr->ActualizarValoresForjaUsuarioProyecto($validar_usuario['id'],$porcentaje,$valor_administrativo_para_forja);
		}else{

			$respuesta = $mdl_nuevoProyectoFiverr->insertarValorAdminstrativoForja(
				$id_proyecto,
				1,
				4,
				100,
				$valor_extra_sonido_forja);

			if ($respuesta) {
				$mensaje_respuesta = 'Valor dirección sonido Forja almacenado con exito';
			}else{
				$mensaje_respuesta = 'Error al almacenar valor administrativo Forja';
			}
		}

		echo json_encode($mensaje_respuesta);

		break;
	case 'verValorAdministrativoForjaIdProyecto':
		$respuesta = $mdl_nuevoProyectoFiverr->verValorAdministrativoForjaIdProyecto($id_proyecto);
		echo json_encode($respuesta);
		break;
	case 'verDirectoresPorIdProyecto':
		$respuesta = $mdl_nuevoProyectoFiverr->verDirectoresPorIdProyecto($id_proyecto);
		// $respuesta = $mdl_nuevoProyectoFiverr->verDirectoresPorIdProyecto(16);

		// foreach ($respuesta as $key => $value) {
		// 	print_r($value);
		// }


		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			// if ($row->es_direccion == 1) {
			// 	$perfil = '<span class="badge badge-pill badge-primary">Director</span>';
			// }else{
			// 	$perfil = '<span class="badge badge-pill badge-secondary">'.$row->perfil.'</span>';

			// }

			if ($row->id_usuario == 1) {
				$btn_eliminar = '<i class="fa fa-times-circle text-secondary" aria-hidden="true"></i>';
			}else{
				$btn_eliminar = '<i class="text-danger fa fa-trash" onclick="eliminarUsuarioProyecto('.$row->id.')"></i>';
			}


			$data[] = array(
				"0"=>$row->nombre_perfil,
				"1"=>$row->nombre." ".$row->apellido.' <small>(Id '.$row->id_usuario.')</small>',			
				"2"=>'<button type="button" class="btn btn-sm btn-outline-info" onclick="modalAgregarPorcentaje('.$row->id.')">'.$row->porcentaje.' %</button>',
				"3"=>'$ '.$row->valor_ganado,
				"4"=>$btn_eliminar
			);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($results);



		break;
	case 'insertarUsuarioProyecto':
		$data_proyecto = $mdl_nuevoProyectoFiverr->verProyectoPorId($id_proyecto);
		$validarProyectoUsuarioPerfil = $mdl_nuevoProyectoFiverr->validarProyectoUsuarioPerfil($id_proyecto,$id_usuario_proyecto,$id_perfil);


		// $usuario_forja =  $mdl_nuevoProyectoFiverr->validarUsuForjaEnUsuarioProyecto($id_proyecto);
		$cant_usuarios = $mdl_nuevoProyectoFiverr->cantidadUsuariosPorPerfilProyecto($id_proyecto,$id_perfil);
		$porcentaje_usuarios = $mdl_nuevoProyectoFiverr->porcentajeUsuariosPorPerfilProyecto($id_proyecto,$id_perfil);


		// $usuario_forja =  $mdl_nuevoProyectoFiverr->validarUsuForjaEnUsuarioProyecto(16);
		// $cant_usuarios = $mdl_nuevoProyectoFiverr->cantidadUsuariosPorPerfilProyecto(16,2);
		// $porcentaje_usuarios = $mdl_nuevoProyectoFiverr->porcentajeUsuariosPorPerfilProyecto(16,2);




		// if ($cant_usuarios['cantidad'] == 0) {
		// 	// code...
		// }





		if ($validarProyectoUsuarioPerfil) {
			$mensaje_respuesta = array(
				"estado"=>3,
				"mensaje"=>'Reasignación de usuario');
		}else{
			if ($id_perfil == 2 || $id_perfil == 3) {
				if ($cant_usuarios['cantidad'] == 0) {
					$porcentaje = 25;	
					$valor_ganado = ($data_proyecto['valor_adminstrativo'] * $porcentaje)/100;		
				}else{
					$total_usuarios = $cant_usuarios['cantidad'] + 1;
					$porcentaje = 25 / $total_usuarios;
					$valor_ganado = ($data_proyecto['valor_adminstrativo'] * $porcentaje)/100;
					$update_usuarios = $mdl_nuevoProyectoFiverr->obtenerUsuariosProyectoPorIdProyectoPerfil($id_proyecto,$id_perfil);
					foreach ($update_usuarios as $key => $value) {
						$mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$porcentaje,$valor_ganado);
					}
				}
				// $respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,$id_perfil,$porcentaje,$valor_ganado); 
			}elseif ($id_perfil == 5) { //INSERTAR ARTISTA 
				if ($cant_usuarios['cantidad'] == 0) {
					$porcentaje = 100;
					$valor_ganado = $data_proyecto['valor_arte_final'];
				}else{
					$total_usuarios = $cant_usuarios['cantidad'] + 1;
					$porcentaje = 100 / $total_usuarios;
					$valor_ganado = ($data_proyecto['valor_arte_final'] * $porcentaje)/100;
					$update_usuarios = $mdl_nuevoProyectoFiverr->obtenerUsuariosProyectoPorIdProyectoPerfil($id_proyecto,$id_perfil);
					foreach ($update_usuarios as $key => $value) {
						$mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$porcentaje,$valor_ganado);
					}
				}
				$validar_usuario = $mdl_nuevoProyectoFiverr->validarUsuarioEnUsuarioProyectoPerfil($id_proyecto,$id_usuario_proyecto,8);
				if (!$validar_usuario) {
					$respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,8,0,0);
				}
			}elseif ($id_perfil == 6) { //INSERTAR ANIMADOR
				if ($cant_usuarios['cantidad'] == 0) {
					$porcentaje = 100;
					$valor_ganado = $data_proyecto['valor_animacion_final'];
				}else{
					$total_usuarios = $cant_usuarios['cantidad'] + 1;
					$porcentaje = 100 / $total_usuarios;
					$valor_ganado = ($data_proyecto['valor_animacion_final'] * $porcentaje)/100;
					$update_usuarios = $mdl_nuevoProyectoFiverr->obtenerUsuariosProyectoPorIdProyectoPerfil($id_proyecto,$id_perfil);
					foreach ($update_usuarios as $key => $value) {
						$mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$porcentaje,$valor_ganado);
					}
				}
				$validar_usuario = $mdl_nuevoProyectoFiverr->validarUsuarioEnUsuarioProyectoPerfil($id_proyecto,$id_usuario_proyecto,9);;
				if (!$validar_usuario) {
					$respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,9,0,0);
				}
					
			}elseif ($id_perfil == 4) {
				if ($cant_usuarios['cantidad'] == 0) {
					$porcentaje = 100;
					$valor_ganado = $data_proyecto['valor_extra_sonido_forja'];
				}else{
					$total_usuarios = $cant_usuarios['cantidad'] + 1;
					$porcentaje = 100 / $total_usuarios;
					$valor_ganado = ($data_proyecto['valor_extra_sonido_forja'] * $porcentaje)/100;
					$update_usuarios = $mdl_nuevoProyectoFiverr->obtenerUsuariosProyectoPorIdProyectoPerfil($id_proyecto,$id_perfil);
					foreach ($update_usuarios as $key => $value) {
						$mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$porcentaje,$valor_ganado);
					}
				}
				// $respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,$id_perfil,$porcentaje,$valor_ganado);
			}elseif ($id_perfil == 7) {
				if ($cant_usuarios['cantidad'] == 0) {
					$porcentaje = 100;
					$valor_ganado = $data_proyecto['valor_extra_sonido_final']-$data_proyecto['valor_extra_sonido_forja'];
				}else{
					$total_usuarios = $cant_usuarios['cantidad'] + 1;
					$porcentaje = 100 / $total_usuarios;
					$valor_ganado = (($data_proyecto['valor_extra_sonido_final']-$data_proyecto['valor_extra_sonido_forja']) * $porcentaje)/100;
					$update_usuarios = $mdl_nuevoProyectoFiverr->obtenerUsuariosProyectoPorIdProyectoPerfil($id_proyecto,$id_perfil);
					foreach ($update_usuarios as $key => $value) {
						$mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$porcentaje,$valor_ganado);
					}
				}
				// $respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,$id_perfil,$porcentaje,$valor_ganado);
			}

				$respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,$id_perfil,$porcentaje,$valor_ganado);



			// $respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario,$id_perfil,$porcentaje,$valor_ganado); 
			// $respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,$id_perfil); 



		// 	if ($id_perfil == 2 || $id_perfil == 5 && $data_proyecto['valor_extra_arte'] != 0) {
		// 		$validarProyectoUsuarioPerfil = $mdl_nuevoProyectoFiverr->validarProyectoUsuarioPerfil($id_proyecto,$id_usuario_proyecto,8);
		// 		if ($validarProyectoUsuarioPerfil) {
		// 			$mensaje_respuesta = array(
		// 				"estado"=>3,
		// 				"mensaje"=>'Reasignación de usuario extra árte');
		// 		}else{
		// 			$respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,8); 
		// 		}
		// 	}
		// 	if ($id_perfil == 3 || $id_perfil == 6 && $data_proyecto['valor_extra_arte'] != 0) {
		// 		$validarProyectoUsuarioPerfil = $mdl_nuevoProyectoFiverr->validarProyectoUsuarioPerfil($id_proyecto,$id_usuario_proyecto,9);
		// 		if ($validarProyectoUsuarioPerfil) {
		// 			$mensaje_respuesta = array(
		// 				"estado"=>3,
		// 				"mensaje"=>'Reasignación de usuario extra animación');
		// 		}else{
		// 			$respuesta = $mdl_nuevoProyectoFiverr->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,9); 
		// 		}
		// 	}

		// 	if($respuesta){
		// 		$mensaje_respuesta = array(
		// 			"estado"=>1,
		// 			"mensaje"=>'Usuario asignado correctamente');
		// 	}else{
		// 		$mensaje_respuesta = array(
		// 			"estado"=>0,
		// 			"mensaje"=>'Error en la asignación');
		// 	}
		}

		// echo json_encode($mensaje_respuesta);
		// echo json_encode($usuario_forja);
		break;
	case 'cargarTablaProyectoPerfil':
		$respuesta = $mdl_nuevoProyectoFiverr->cargarTablaProyectoPerfil($id_proyecto,$id_perfil);
		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			if ($row->es_direccion == 1) {
				$perfil = '<span class="badge badge-pill badge-primary">Director</span>';
			}else{
				$perfil = '<span class="badge badge-pill badge-secondary">'.$row->perfil.'</span>';
			}
			if ($row->id_usuario == 1) {
				$btn_eliminar = '<i class="fa fa-times-circle text-secondary" aria-hidden="true"></i>';
			}else{
				$btn_eliminar = '<i class="text-danger fa fa-trash" onclick="eliminarUsuarioProyecto('.$row->id.')"></i>';
			}

			$data[] = array(
				"0"=>$perfil,
				"1"=>$row->usuario_nombre." ".$row->usuario_apellidos.' <small>(Id '.$row->id_usuario.')</small>',			
				"2"=>'<button type="button" class="btn btn-sm btn-outline-info" onclick="modalAgregarPorcentaje('.$row->id.','.$row->id_perfil.','.$row->id_usuario.','.$row->es_direccion.')">'.$row->porcentaje.' %</button>',
				"3"=>'$ '.$row->valor_ganado,
				"4"=>$btn_eliminar
			);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($results);
		break;
	case 'cargarTablaProyectoPerfilSonido':
		$respuesta = $mdl_nuevoProyectoFiverr->cargarTablaProyectoPerfilSonido($id_proyecto);
		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			if ($row->es_direccion == 1) {
				$perfil = '<span class="badge badge-pill badge-primary">Director</span>';
			}else{
				$perfil = '<span class="badge badge-pill badge-secondary">'.$row->perfil.'</span>';
			}
			if ($row->id_usuario == 1) {
				$btn_eliminar = '<i class="fa fa-times-circle text-secondary" aria-hidden="true"></i>';
			}else{
				$btn_eliminar = '<i class="text-danger fa fa-trash" onclick="eliminarUsuarioProyecto('.$row->id.')"></i>';
			}

			$data[] = array(
				"0"=>$perfil,
				"1"=>$row->usuario_nombre." ".$row->usuario_apellidos.' <small>(Id '.$row->id_usuario.')</small>',			
				"2"=>'<button type="button" class="btn btn-sm btn-outline-info" onclick="modalAgregarPorcentaje('.$row->id.','.$row->id_perfil.','.$row->id_usuario.','.$row->es_direccion.')">'.$row->porcentaje.' %</button>',
				"3"=>'$ '.$row->valor_ganado,
				"4"=>$btn_eliminar
			);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($results);
		break;
	case 'recalcularPorcentajes':
		// $id_proyecto = 22; 

		$data_proyecto = $mdl_nuevoProyectoFiverr->verProyectoPorId($id_proyecto);

		$valor_direccion_arte = $data_proyecto['valor_adminstrativo'] - $data_proyecto['valor_administrativo_para_forja'];


		$id_usuario_proyecto = $mdl_nuevoProyectoFiverr->verTodosUsuarioProyecto($id_proyecto);
		$results = array();
		foreach ($id_usuario_proyecto as $key => $value) {
			switch ($value['id_perfil']) {
				case '2':
					// echo "Director de arte - ";
					// echo ($data_proyecto['valor_adminstrativo'] * $value['porcentaje'])/100;
					$valor_ganado = ($data_proyecto['valor_adminstrativo'] * $value['porcentaje'])/100;
					$actualizado = $mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$value['porcentaje'],$valor_ganado);
					$results[$value['id']] = $actualizado;
					// echo "<br>";
					break;
				case '3':
					// echo "Director de animación - 	";
					// echo ($data_proyecto['valor_adminstrativo'] * $value['porcentaje'])/100;
					$valor_ganado = ($data_proyecto['valor_adminstrativo'] * $value['porcentaje'])/100;
					$actualizado = $mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$value['porcentaje'],$valor_ganado);
					$results[$value['id']] = $actualizado;
					// echo "<br>";
					break;	
				case '4':
					// echo "Director de sonido - ";
					// echo ($data_proyecto['valor_extra_sonido_forja'] * $value['porcentaje'])/100;
					$valor_ganado = ($data_proyecto['valor_extra_sonido_forja'] * $value['porcentaje'])/100;
					$actualizado = $mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$value['porcentaje'],$valor_ganado);
					$results[$value['id']] = $actualizado;
					// echo "<br>";
					break;	
				case '5':
					// echo "Artista - ";
					// echo ($data_proyecto['valor_arte_final'] * $value['porcentaje'])/100;
					$valor_ganado = ($data_proyecto['valor_arte_final'] * $value['porcentaje'])/100;
					$actualizado = $mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$value['porcentaje'],$valor_ganado);
					$results[$value['id']] = $actualizado;
					// echo "<br>";
					break;	
				case '6':
					// echo "Animador - ";
					// echo ($data_proyecto['valor_animacion_final'] * $value['porcentaje'])/100;
					$valor_ganado = ($data_proyecto['valor_animacion_final'] * $value['porcentaje'])/100;
					$actualizado = $mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$value['porcentaje'],$valor_ganado);
					$results[$value['id']] = $actualizado;
					// echo "<br>";
					break;	
				case '7':
					// echo "Sonido - ";
					// echo (($data_proyecto['valor_extra_sonido_final'] - $data_proyecto['valor_extra_sonido_forja']) * $value['porcentaje'])/100;
					$valor_ganado = (($data_proyecto['valor_extra_sonido_final'] - $data_proyecto['valor_extra_sonido_forja']) * $value['porcentaje'])/100;
					$actualizado = $mdl_nuevoProyectoFiverr->actualizarUsuarioProyectoPorId($value['id'],$value['porcentaje'],$valor_ganado);
					$results[$value['id']] = $actualizado;
					// echo "<br>";
					break;	
				default:
					// code...
					break;
			}
			// print_r($value);
			
		}
			// print_r($results);
		echo json_encode($results);

		break;
	// case 'nuevoProyecto':
	// 	$cliente = $mdl_nuevoProyecto->verFilaPorID('cliente', $id_cliente);
	// 	// $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');

	// 	// $divisa = $mdl_nuevoProyecto->verFilaPorID('divisa', $id_moneda);
	// 	$data_nivel = $mdl_nuevoProyecto->verNivelPorID($nivel);

	// 	$valor_proyecto_comision = ($valor_proyecto * $cliente['porcentaje_comision'])/100;
	// 	$valor_proyecto_menos_comision = $valor_proyecto - $valor_proyecto_comision;
	// 	$porcentaje_administrativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');
	// 	$porcentaje_operativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_operativo');
	// 	$valor_adminstrativo = ($valor_proyecto_menos_comision * $porcentaje_administrativo['valor'])/100;
	// 	$valor_operativo = $valor_proyecto_menos_comision - $valor_adminstrativo;

	// 	// Valida si se selecciona arte, animación o los dos y distribuye el porcentaje
	// 	if ($check_arte == 1 && $check_animacion == 1) {
	// 		$porcentaje_arte = $data_nivel['arte'];
	// 		$porcenteje_animacion = $data_nivel['animacion'];
	// 	}elseif ($check_arte == 1 && $check_animacion != 1){
	// 		$porcentaje_arte = 100;
	// 		$porcenteje_animacion = 0;
	// 	}elseif ($check_arte != 1 && $check_animacion == 1) {
	// 		$porcentaje_arte = 0;
	// 		$porcenteje_animacion = 100;
	// 	}

	// 	// Se almacenna el valor de arte y animación dependiendo de los porcentajes anteriores
	// 	$valor_arte = ($valor_operativo * $porcentaje_arte)/100;
	// 	$valor_animacion = ($valor_operativo * $porcenteje_animacion)/100;

	// 	// =======================================================
	// 	// CALCULOS EXTRA ARTE
	// 	// =======================================================
	// 	if ($valor_extra_arte) {
	// 		$porcentaje_extra_arte_forja = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_extra_arte_forja');
	// 		$porcentaje_extra_arte_forja = $porcentaje_extra_arte_forja['valor'];
	// 		$valor_extra_arte_comision = ($valor_extra_arte * $cliente['porcentaje_comision'])/100;
	// 		$valor_extra_arte_menos_comision =  $valor_extra_arte - $valor_extra_arte_comision;
	// 		$valor_extra_arte_forja = ($valor_extra_arte_menos_comision * $porcentaje_extra_arte_forja)/100;		
	// 	}else{
	// 		$porcentaje_extra_arte_forja = 0;
	// 		$valor_extra_arte_comision = 0;
	// 		$valor_extra_arte_menos_comision = 0; 
	// 		$valor_extra_arte_forja = 0;
	// 	}
		
	// 	// =======================================================
	// 	// CALCULOS EXTRA ANIMACIÓN
	// 	// =======================================================
	// 	if ($valor_extra_animacion) {
	// 		$porcentaje_extra_animacion_forja = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_extra_animacion_forja');
	// 		$porcentaje_extra_animacion_forja = $porcentaje_extra_animacion_forja['valor'];
	// 		$valor_extra_animacion_comision = ($valor_extra_animacion * $cliente['porcentaje_comision'])/100;
	// 		$valor_extra_animacion_menos_comision = $valor_extra_animacion - $valor_extra_animacion_comision;
	// 		$valor_extra_animacion_forja = ($valor_extra_animacion_menos_comision * $porcentaje_extra_animacion_forja)/100;
	// 	}else{
	// 		$porcentaje_extra_animacion_forja = 0;
	// 		$valor_extra_animacion_comision = 0;
	// 		$valor_extra_animacion_menos_comision = 0;
	// 		$valor_extra_animacion_forja = 0;
	// 	}

	// 	// =======================================================
	// 	// CALCULOS EXTRA SONIDO
	// 	// =======================================================
	// 	if ($valor_extra_sonido) {
	// 		$porcentaje_extra_sonido_forja = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_extra_sonido_forja');
	// 		$porcentaje_extra_sonido_forja = $porcentaje_extra_sonido_forja['valor'];
	// 		$valor_extra_sonido_comision = ($valor_extra_sonido * $cliente['porcentaje_comision'])/100;
	// 		$valor_extra_sonido_menos_comision = $valor_extra_sonido - $valor_extra_sonido_comision;
			
	// 	}else{
	// 		$porcentaje_extra_sonido_forja = 0;
	// 		$valor_extra_sonido_comision = 0;
	// 		$valor_extra_sonido_menos_comision = 0;
	// 		$valor_extra_sonido = 0;
	// 	}	

	// 	// =======================================================
	// 	// CALCULOS TIP
	// 	// =======================================================
	// 	$valor_tip_base_calculo = $valor_arte + $valor_animacion + $valor_extra_sonido_menos_comision;


	// 	if ($valor_tip != '') {
	// 		$valor_tip_comision = ($valor_tip * $cliente['porcentaje_comision'])/100;
	// 		$valor_tip_menos_comision = $valor_tip - $valor_tip_comision;

	// 		$porcentaje_tip_arte = ($valor_arte / $valor_tip_base_calculo)*100;
	// 		$porcentaje_tip_animacion = ($valor_animacion / $valor_tip_base_calculo)*100;
	// 		$porcentaje_tip_sonido = ($valor_extra_sonido_menos_comision / $valor_tip_base_calculo)*100;

	// 		$valor_tip_arte = ($valor_tip_menos_comision * $porcentaje_tip_arte)/100;
	// 		$valor_tip_animacion = ($valor_tip_menos_comision * $porcentaje_tip_animacion)/100;
	// 		$valor_tip_sonido = ($valor_tip_menos_comision * $porcentaje_tip_sonido)/100;
	// 	}else{
	// 		$valor_tip_comision = 0;
	// 		$valor_tip_menos_comision = 0;

	// 		$porcentaje_tip_arte = 0;
	// 		$porcentaje_tip_animacion = 0;
	// 		$porcentaje_tip_sonido = 0;

	// 		$valor_tip_arte = 0;
	// 		$valor_tip_animacion = 0;
	// 		$valor_tip_sonido = 0;
	// 	}

	// 	if ($valor_extra_sonido) {
	// 		$valor_extra_sonido_forja = (($valor_extra_sonido_menos_comision+$valor_tip_sonido) * $porcentaje_extra_sonido_forja)/100;
	// 	}else{
	// 		$valor_extra_sonido_forja = 0;
	// 	}

		

	// 	if ($fecha_inicio == '') {

	// 		$fecha_inicio = '1900-01-01';
	// 	}
	// 	if ($fecha_posible_fin == '') {
	// 		$fecha_posible_fin = '1900-01-01';
	// 	}
		

	// 	$porcentaje_comision = $cliente['porcentaje_comision'];
	// 	$porcentaje_administrativo = $porcentaje_administrativo['valor'];
	// 	$porcentaje_operativo = $porcentaje_operativo['valor'];
	// 	$valor_final_proyecto = $valor_proyecto_menos_comision;
	// 	$valor_arte_final = $valor_arte+$valor_tip_arte;
	// 	$valor_animacion_final = $valor_animacion+$valor_tip_animacion;
	// 	$valor_extra_arte_final = $valor_extra_arte_menos_comision;
	// 	$valor_extra_animacion_final = $valor_extra_animacion_menos_comision;
	// 	$valor_extra_sonido_final = $valor_extra_sonido_menos_comision+$valor_tip_sonido;

	// 	$valor_tip_final = $valor_tip_menos_comision;
		

	// 	$respuesta = $mdl_nuevoProyecto->nuevoProyecto(
	// 		$nombre,
	// 		$detalle,
	// 		$id_cliente,
	// 		$id_moneda,
	// 		$nivel,
	// 		$valor_proyecto,
	// 		$porcentaje_comision,
	// 		$valor_proyecto_comision,
	// 		$valor_proyecto_menos_comision,
	// 		$valor_final_proyecto,
	// 		$porcentaje_administrativo,
	// 		$porcentaje_operativo,
	// 		$valor_adminstrativo,
	// 		$valor_operativo,
	// 		$porcentaje_arte,
	// 		$valor_arte,
	// 		$valor_tip_arte,
	// 		$valor_arte_final,
	// 		$porcenteje_animacion,
	// 		$valor_animacion,
	// 		$valor_tip_animacion,
	// 		$valor_animacion_final,
	// 		$valor_extra_arte,
	// 		$valor_extra_arte_comision,
	// 		$valor_extra_arte_menos_comision,
	// 		$valor_extra_arte_final,
	// 		$valor_extra_animacion,
	// 		$valor_extra_animacion_comision,
	// 		$valor_extra_animacion_menos_comision,
	// 		$valor_extra_animacion_final,
	// 		$valor_extra_sonido,
	// 		$valor_extra_sonido_comision,
	// 		$valor_extra_sonido_menos_comision,
	// 		$valor_tip_sonido,
	// 		$valor_extra_sonido_final,
	// 		$valor_tip,
	// 		$valor_tip_comision,
	// 		$valor_tip_menos_comision,
	// 		$valor_tip_base_calculo,
	// 		$porcentaje_tip_arte,
	// 		$porcentaje_tip_animacion,
	// 		$porcentaje_tip_sonido,
	// 		$valor_pago_eps,
	// 		$valor_pago_retencion,
	// 		$fecha_inicio,
	// 		$fecha_posible_fin,
	// 		$fecha_hora,
	// 		$valor_extra_arte_forja,
	// 		$valor_extra_animacion_forja, 
	// 		$valor_extra_sonido_forja,
	// 		$valor_tip_final,
	// 		$id_usuario
	// 	);	




	// 	$datos = array(
	// 		'00-nombre' => $nombre,
	// 		'01-id_cliente' => $id_cliente,
	// 		'02-id_moneda' => $id_moneda,
	// 		'03-nivel' => $nivel,
	// 		'04-valor_proyecto' => $valor_proyecto,
	// 		'05-porcentaje_comision' => $cliente['porcentaje_comision'],
	// 		'06-valor_proyecto_comision' => $valor_proyecto_comision,
	// 		'07-valor_proyecto_menos_comision' => $valor_proyecto_menos_comision,
	// 		'08-adelanto' => 'No aplica',
	// 		'09-valor_avance_comision' => 'No aplica',
	// 		'09-valor_final_proyecto' => $valor_proyecto_menos_comision,
	// 		'10-porcentaje_administrativo' => $porcentaje_administrativo,
	// 		'11-porcentaje_operativo' => $porcentaje_operativo,
	// 		'12-valor_adminstrativo' => $valor_adminstrativo,
	// 		'13-valor_operativo' => $valor_operativo,
	// 		'14-porcentaje_arte' => $porcentaje_arte,
	// 		'15-valor_arte' => $valor_arte,
	// 		'16-valor_tip_arte' => $valor_tip_arte,
	// 		'17-valor_arte_final' => $valor_arte+$valor_tip_arte,
	// 		'18-porcenteje_animacion' => $porcenteje_animacion,
	// 		'19-valor_animacion' => $valor_animacion,
	// 		'20-valor_tip_animacion' => $valor_tip_animacion,
	// 		'21-valor_animacion_final' => $valor_animacion+$valor_tip_animacion,
	// 		'22-valor_extra_arte' => $valor_extra_arte,
	// 		'23-valor_extra_arte_comision' => $valor_extra_arte_comision,
	// 		'24-valor_extra_arte_menos_comision' => $valor_extra_arte_menos_comision,
	// 		'25-valor_extra_arte_comision_adelanto' => 'No aplica',
	// 		'26-valor_extra_arte_final' => $valor_extra_arte_menos_comision,
	// 		'27-valor_extra_animacion' => $valor_extra_animacion,
	// 		'28-valor_extra_animacion_comision' => $valor_extra_animacion_comision,
	// 		'29-valor_extra_animacion_menos_comision' => $valor_extra_animacion_menos_comision,
	// 		'30-valor_extra_animacion_comision_adelanto' => 'No aplica',
	// 		'31-valor_extra_animacion_final' => $valor_extra_animacion_menos_comision,
	// 		'32-valor_extra_sonido' => $valor_extra_sonido,
	// 		'33-valor_extra_sonido_comision' => $valor_extra_sonido_comision,
	// 		'34-valor_extra_sonido_menos_comision' => $valor_extra_sonido_menos_comision,
	// 		'35-valor_extra_sonido_adelanto' => 'No aplica',
	// 		'36-valor_tip_sonido' => $valor_tip_sonido,
	// 		'37-valor_extra_sonido_final' => $valor_extra_sonido_menos_comision+$valor_tip_sonido,
	// 		'38-valor_tip' => $valor_tip,
	// 		'39-valor_tip_comision' => $valor_tip_comision,
	// 		'40-valor_tip_menos_comision' => $valor_tip_menos_comision,
	// 		'41-valor_tip_base_calculo' => $valor_tip_base_calculo,
	// 		'42-porcentaje_tip_arte' => $porcentaje_tip_arte,
	// 		'43-porcentaje_tip_animacion' => $porcentaje_tip_animacion,
	// 		'44-porcentaje_tip_sonido' => $porcentaje_tip_sonido,
	// 		'45-valor_pago_eps' => $valor_pago_eps,
	// 		'46-valor_pago_retencion' => $valor_pago_retencion,
	// 		'47-porcentaje_descuento_avance' => $cliente['porcentaje_anticipo'],
	// 		'48-fecha_inicio' => $fecha_inicio,
	// 		'49-fecha_posible_fin' => $fecha_posible_fin,
	// 		'50-fecha_registro' => $fecha_hora,
	// 		'51-valor_extra_sonido_forja' => $valor_extra_sonido_forja,
	// 		'52-valor_extra_sonido_menos_comision' => $valor_extra_sonido_menos_comision,
	// 		'53-valor_tip_sonido' => $valor_tip_sonido,
	// 		'51-id_usuario' => 1,
	// 	);

		


	// 	if($respuesta){
	// 		$crearUsuarioForjaEnUsuarioProyecto = $mdl_nuevoProyecto->crearUsuarioForjaEnUsuarioProyecto($respuesta);
	// 		// $insertarValoresForjaExtraSonido = $mdl_nuevoProyecto->insertarValoresForjaExtraSonido($respuesta,$valor_extra_sonido_forja);

	// 		if ($valor_extra_sonido) {
	// 			$insertarValoresForjaExtraSonido = $mdl_nuevoProyecto->insertarValoresUsuarioProyecto($respuesta,1,10,30,$valor_extra_sonido_forja);
	// 		}else{
	// 			$insertarValoresForjaExtraSonido = 'Sin extra de sonido';
	// 		}
	// 		if ($valor_extra_arte) {
	// 			$insertarValoresForjaExtraArte = $mdl_nuevoProyecto->insertarValoresUsuarioProyecto($respuesta,1,8,30,$valor_extra_arte_forja);
	// 		}else{
	// 			$insertarValoresForjaExtraArte = 'Sin extra de árte';
	// 		}
	// 		if ($valor_extra_animacion) {
	// 			$insertarValoresForjaExtraAnimacion = $mdl_nuevoProyecto->insertarValoresUsuarioProyecto($respuesta,1,9,30,$valor_extra_animacion_forja);
	// 		}else{
	// 			$insertarValoresForjaExtraAnimacion = 'Sin extra de animación';
	// 		}


	// 		$mensaje_respuesta = array(
	// 			"estado"=>1,
	// 			"icon"=>'success',
	// 			"title"=>'Proyecto creado!',
	// 			"text"=>'El proyecto ha sido creado con exito',
	// 			"mensaje"=>$datos,
	// 			"crearUsuarioForjaEnUsuarioProyecto"=>$crearUsuarioForjaEnUsuarioProyecto,
	// 			"insertarValoresForjaExtraSonido"=>$insertarValoresForjaExtraSonido
	// 		);
	// 	}else{
	// 		$mensaje_respuesta = array(
	// 			"estado"=>0,
	// 			"icon"=>'error',
	// 			"title"=>'!Error',
	// 			"text"=>'No ha sido posible crear el proyecto',
	// 			"mensaje"=>$datos,
	// 		);
	// 	}
	// 	echo json_encode($mensaje_respuesta);
	// 	// echo json_encode($datos);

	// 	break;
	// case 'listarClientes':
	// 	$respuesta = $mdl_nuevoProyecto->listarClientes();
	// 	$data = Array();
	// 	while ($row = $respuesta->fetch_object()) {
	// 		$data[] = array(
	// 			"0"=>$row->id,
	// 			"1"=>$row->nombre,
	// 			"2"=>$row->porcentaje_comision,
	// 			"3"=>$row->porcentaje_anticipo,
	// 			"4"=>$row->estado,
	// 			"5"=>'Opciones'				
	// 		);
	// 	}
	// 	$results = array(
	// 		"sEcho"=>1,
	// 		"iTotalRecords"=>count($data),
	// 		"iTotalDisplayRecords"=>count($data),
	// 		"aaData"=>$data);
	// 	echo json_encode($results);
	// 	break;
	// case 'verNivelPorID':
	// 	$respuesta = $mdl_nuevoProyecto->verNivelPorID(1);
	// 	echo json_encode($respuesta);
	// 	break;
	case 'variable':
		// $respuesta = $mdl_proyecto->cargarTablaProyectoEspecialidad($id_proyecto,$id_especialidad);
		
		break;
	default:
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}


