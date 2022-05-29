<?php 
// session_start();
include '../models/Proyecto.php';
include '../models/NuevoProyecto.php';
$mdl_proyecto = new Proyecto();
$mdl_nuevoProyecto = new NuevoProyecto();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$hora = date('G:i:s');
$fecha_hora = date('Y-m-d G:i:s');


$id_proyecto = isset($_POST['id_proyecto'])? limpiarCadena($_POST['id_proyecto']) : "" ;
$id_moneda = isset($_POST['id_moneda'])? limpiarCadena($_POST['id_moneda']) : "" ;
$id_perfil = isset($_POST['id_perfil'])? limpiarCadena($_POST['id_perfil']) : "" ;
// $id_proyecto = 2;
// ********* VARIABLES PARA CALCULOS *********
$id_cliente = isset($_POST['id_cliente'])? limpiarCadena($_POST['id_cliente']) : "" ;
$nivel = isset($_POST['nivel'])? limpiarCadena($_POST['nivel']) : "" ;
$valor_proyecto = isset($_POST['valor_proyecto'])? limpiarCadena($_POST['valor_proyecto']) : "" ;
$check_anticipo = isset($_POST['check_anticipo'])? limpiarCadena($_POST['check_anticipo']) : "" ;

$usuario = isset($_POST['usuario'])? limpiarCadena($_POST['usuario']) : "" ;
$check_anticipo = isset($_POST['check_anticipo'])? limpiarCadena($_POST['check_anticipo']) : "" ;
$id_usuario_proyecto = isset($_POST['id_usuario_proyecto'])? limpiarCadena($_POST['id_usuario_proyecto']) : "" ;
$id_especialidad = isset($_POST['id_especialidad'])? limpiarCadena($_POST['id_especialidad']) : "" ;
$porcentaje = isset($_POST['porcentaje'])? limpiarCadena($_POST['porcentaje']) : "" ;
$valor_ganado = isset($_POST['valor_ganado'])? limpiarCadena($_POST['valor_ganado']) : "" ;
$es_direccion = isset($_POST['es_direccion'])? limpiarCadena($_POST['es_direccion']) : "" ;




$id_usuario = 1;

switch ($_GET['op']) {
	case 'verProyectoPorId':
		$respuesta = $mdl_proyecto->verProyectoPorId($id_proyecto);
		echo json_encode($respuesta);
		break;
	case 'nombreDivisa':
		$respuesta = $mdl_proyecto->verFilaPorID('divisa',$id_moneda);
		echo json_encode($respuesta['iso_divisa']);
		break;
	case 'nombreCliente':
		$respuesta = $mdl_proyecto->verFilaPorID('cliente',$id_cliente);
		echo json_encode($respuesta['nombre']);
		break;
	case 'selectUsuarioPorPerfil':
		$respuesta = $mdl_proyecto->selectUsuarioPorPerfil($id_perfil);
		while ($row = $respuesta->fetch_object()) {
			echo '<option value='.$row->id.'>'.$row->nombre.' '.$row->apellido.'</option>';
		}
		break;
	case 'calcularProyecto':
		$porcentaje_anticipo_global = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_anticipo_global');
		

		$cliente = $mdl_nuevoProyecto->verFilaPorID('cliente', $id_cliente);
		$data_nivel = $mdl_nuevoProyecto->verNivelPorID($nivel);

		$valor_proyecto_comision = ($valor_proyecto * $cliente['porcentaje_comision'])/100;
		$valor_proyecto_menos_comision = $valor_proyecto - $valor_proyecto_comision;

		// VALIDA SI LA COMISION DEL ANTICIPO SE APLICA AL SALDO TOTAL O AL PORCENTAJE ADMINSTRATIVO
		// 1 - Aplica al global 
		// 0 - Aplica al administrativo
		if ($porcentaje_anticipo_global['valor'] == 1) {

			if ($check_anticipo == 1) {
				$porcentaje_anticipo = $cliente['porcentaje_anticipo'];
				$valor_avance_comision = ($valor_proyecto_menos_comision * $porcentaje_anticipo)/100;
				$valor_proyecto_menos_comision = $valor_proyecto_menos_comision - $valor_avance_comision;

			}else{
				$porcentaje_anticipo = 0;
				$valor_avance_comision = 0;
			}


			$porcentaje_administrativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');
			$porcentaje_operativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_operativo');
			$valor_adminstrativo = ($valor_proyecto_menos_comision * $porcentaje_administrativo['valor'])/100;
			$valor_operativo = $valor_proyecto_menos_comision - $valor_adminstrativo;


			$recalcular_porcentaje_admin = $mdl_proyecto->obtenerUsuariosPorTipoProyecto($id_proyecto,1);
			foreach ($recalcular_porcentaje_admin as $key => $value) {
				$recalculoValorGanado = ($value['porcentaje']*$valor_adminstrativo)/100;
				$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
			}


			$recalcular_porcentaje_oper = $mdl_proyecto->obtenerUsuariosPorTipoProyecto($id_proyecto,0);
			foreach ($recalcular_porcentaje_oper as $key => $value) {
				$recalculoValorGanado = ($value['porcentaje']*$valor_adminstrativo)/100;
				$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
			}
			
		}else{
			if ($check_anticipo == 1) {
				$porcentaje_anticipo = $cliente['porcentaje_anticipo'];
				$valor_avance_comision = ($valor_proyecto_menos_comision * $porcentaje_anticipo)/100;
			}else{
				$porcentaje_anticipo = 0;
				$valor_avance_comision = 0;
			}

			$porcentaje_administrativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');
			$porcentaje_operativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_operativo');
			$valor_adminstrativo = (($valor_proyecto_menos_comision * $porcentaje_administrativo['valor'])/100)-$valor_avance_comision;
			$valor_operativo = $valor_proyecto_menos_comision - $valor_adminstrativo - $valor_avance_comision;
			
			$recalcular_porcentaje_admin = $mdl_proyecto->obtenerUsuariosPorTipoProyecto($id_proyecto,1);
			foreach ($recalcular_porcentaje_admin as $key => $value) {
				$recalculoValorGanado = ($value['porcentaje']*$valor_adminstrativo)/100;
				$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
			}
		}



		$respuesta = $mdl_proyecto->actualizarProyecto(
			$id_proyecto,
			$check_anticipo,
			$valor_proyecto_comision,
			$valor_proyecto_menos_comision,
			$porcentaje_anticipo,
			$valor_avance_comision,
			$valor_adminstrativo,
			$valor_operativo);

		if($respuesta){

			$mensaje_respuesta = array(
				"estado"=>1,
				"icon"=>'success',
				"title"=>'Proyecto actualizado!',
				"text"=>'El proyecto ha sido actualizado con exito',
				"mensaje"=>$respuesta);
		}else{
			$mensaje_respuesta = array(
				"estado"=>0,
				"icon"=>'error',
				"title"=>'!Error',
				"text"=>'No ha sido posible actualizar el proyecto',
				"mensaje"=>$respuesta);
		}
		echo json_encode($mensaje_respuesta);
		break;


// ====================================================================================
	// case 'calcularProyectoV2':
	// 	//ESTE CALCULO APLICA EL DESCUENTO DEL ANTICIPO AL VALOR OPERTATIVO Y ADMINISTRATIVO 
	// 	$cliente = $mdl_nuevoProyecto->verFilaPorID('cliente', $id_cliente);
	// 	$data_proyecto = $mdl_proyecto->verProyectoPorId($id_proyecto);



	// 	$porcentaje_administrativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');
	// 	$porcentaje_operativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_operativo');



	// 	$usuario_forja_extra_arte = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,8);
	// 	$usuario_forja_extra_animacion = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,9);
	// 	$usuario_forja_extra_sonido = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,10);
	// 	$usuario_forja_adminstrativo = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,1);


	// 	// ASIGNACIÓN DE PORCENTAJE DE COMISION POR ADELANTO POR CLIENTE
	// 	if ($check_anticipo == 1) {
	// 		$valor_avance = 1; //4
	// 		$valor_avance_comision = ($data_proyecto['valor_proyecto_menos_comision'] * $cliente['porcentaje_anticipo'])/100; //5
	// 		$valor_tip_sonido = ($data_proyecto['valor_tip_menos_comision']*$porcentaje_tip_sonido)/100;

	// 		// =============================== EXTRA ARTE ===============================
	// 		if ($data_proyecto['valor_extra_arte'] != 0) {
	// 			$valor_extra_arte_comision_adelanto = ($data_proyecto['valor_extra_arte_final'] * $cliente['porcentaje_anticipo'])/100; //6
	// 			$valor_extra_arte_final = $data_proyecto['valor_extra_arte_menos_comision'] - $valor_extra_arte_comision_adelanto; //7
	// 		}else{
	// 			$valor_extra_arte_comision_adelanto = 0; //6
	// 			$valor_extra_arte_final = $data_proyecto['valor_extra_arte_menos_comision']; //7
	// 		}

	// 		// =============================== EXTRA ANIMACIÓN ===============================
	// 		if ($data_proyecto['valor_extra_animacion'] != 0) {
	// 			$valor_extra_animacion_comision_adelanto = ($data_proyecto['valor_extra_animacion_final'] * $cliente['porcentaje_anticipo'])/100; //9
	// 			$valor_extra_animacion_final = $data_proyecto['valor_extra_animacion_menos_comision']-$valor_extra_animacion_comision_adelanto; //10
	// 		}else{
	// 			$valor_extra_animacion_comision_adelanto = 0; //9
	// 			$valor_extra_animacion_final =  $data_proyecto['valor_extra_animacion_menos_comision']; //10
	// 		}

	// 		// =============================== EXTRA SONIDO ===============================
	// 		if ($data_proyecto['valor_extra_sonido'] != 0) {
	// 			$valor_extra_sonido_adelanto = ($data_proyecto['valor_extra_sonido_final'] * $cliente['porcentaje_anticipo'])/100; //12
	// 			$valor_extra_sonido_final = $data_proyecto['valor_extra_sonido_menos_comision'] - $valor_extra_sonido_adelanto + ; //13
	// 		}else{
	// 			$valor_extra_sonido_adelanto = 0; //12
	// 			$valor_extra_sonido_final = $data_proyecto['valor_extra_sonido_final']; //13
	// 		}

	// 		// =============================== TIP ===============================
	// 		if ($data_proyecto['valor_tip'] != 0) {
	// 			$valor_tip_comision_adelanto = ($data_proyecto['valor_tip_final'] * $cliente['porcentaje_anticipo'])/100; //15
	// 			$valor_tip_final = $data_proyecto['valor_tip_final'] - $valor_tip_comision_adelanto;//16
	// 		}else{
	// 			$valor_tip_comision_adelanto = 0; //15
	// 			$valor_tip_final = $data_proyecto['valor_tip_final'];//16
	// 		}
			
	// 		$porcentaje_descuento_avance = $cliente['porcentaje_anticipo']; //20
		
	// 	}else{
	// 		$valor_avance = 0; //4
	// 		$valor_avance_comision = 0; //5
	// 		$valor_extra_arte_comision_adelanto = 0; //6
	// 		$valor_extra_arte_final = $data_proyecto['valor_extra_arte_final']; //7
	// 		$valor_extra_animacion_comision_adelanto = 0; //9
	// 		$valor_extra_sonido_adelanto = 0; //12
	// 		$valor_tip_comision_adelanto = 0; //15
	// 		$porcentaje_descuento_avance = 0; //20
	// 		$valor_extra_animacion_final = $data_proyecto['valor_extra_animacion_final']; //10
	// 		$valor_extra_sonido_final = $data_proyecto['valor_extra_sonido_final']; //13
	// 		$valor_tip_final = $data_proyecto['valor_tip_final'];//16
	// 	}
		

		
	// 	$valor_final_proyecto = $data_proyecto['valor_proyecto_menos_comision'] - $valor_avance_comision;//1
	// 	$valor_adminstrativo = ($valor_final_proyecto * $porcentaje_administrativo['valor'])/100; //17
	// 	$valor_operativo = $valor_final_proyecto - $valor_adminstrativo; //19
	// 	$valor_arte = ($valor_operativo * $data_proyecto['porcentaje_arte'])/100; //2
	// 	$valor_animacion = ($valor_operativo*$data_proyecto['porcenteje_animacion'])/100; //3
	// 	$valor_extra_arte_forja = ($usuario_forja_extra_arte['porcentaje']*$valor_extra_arte_final)/100;//8
	// 	$valor_extra_animacion_forja = ($usuario_forja_extra_animacion['porcentaje']*$valor_extra_arte_final)/100;//11
	// 	$valor_extra_sonido_forja = ($usuario_forja_extra_sonido['porcentaje']*$valor_extra_arte_final)/100;//11
	// 	// =============================== VALOR ADMINISYTATIVO FORJA ===============================
	// 	if ($usuario_forja_adminstrativo['porcentaje'] != 0) {
	// 		$valor_administrativo_para_forja = ($valor_adminstrativo * $usuario_forja_adminstrativo['porcentaje'])/100; //18
	// 	}else{
	// 		$valor_administrativo_para_forja = 0; //18
	// 	}


	// 	$valor_extra_sonido_final = $data_proyecto['valor_extra_sonido_menos_comision'] - $valor_extra_sonido_adelanto;




		
	// 	$valor_animacion = ($valor_operativo*$data_proyecto['porcenteje_animacion'])/100;


	// 	$valor_extra_arte_menos_comision = $data_proyecto['valor_extra_arte_menos_comision'] - $valor_extra_arte_comision_adelanto;
	// 	$valor_extra_animacion_menos_comision = $data_proyecto['valor_extra_animacion_menos_comision'] - $valor_extra_animacion_comision_adelanto;



	// 	$valor_tip_menos_comision = $data_proyecto['valor_tip_menos_comision']-$valor_tip_comision_adelanto;

	// 	// *************************************************************************************

	// 	$valor_tip_base_calculo = $valor_arte + $valor_animacion + $data_proyecto['valor_extra_sonido_menos_comision'];

	// 	$valor_extra_sonido_adelanto

	// 	$porcentaje_tip_arte = ($valor_arte/$valor_tip_base_calculo)*100;
	// 	$porcentaje_tip_animacion = ($valor_animacion/$valor_tip_base_calculo)*100;
	// 	$porcentaje_tip_sonido = ($data_proyecto['valor_extra_sonido_menos_comision']/$valor_tip_base_calculo)*100;

	// 	$valor_tip_arte = ($data_proyecto['valor_tip_menos_comision']*$porcentaje_tip_arte)/100;
	// 	$valor_tip_animacion = ($data_proyecto['valor_tip_menos_comision']*$porcentaje_tip_animacion)/100;
		

	// 	$valor_arte_final = $valor_arte + $valor_tip_arte;
	// 	$valor_animacion_final = $valor_animacion + $valor_tip_animacion;
	// 	$valor_extra_sonido_final = $data_proyecto['valor_tip_menos_comision'] - $valor_extra_sonido_adelanto + $valor_tip_sonido;


	// 	// *************************************************************************************
	// 	// id = id_proyecto
	// 	// valor_avance = valor_avance
	// 	// porcentaje_descuento_avance = $porcentaje_descuento_avance
	// 	// valor_avance_comision = valor_comision_adelanto
	// 	// valor_final_proyecto = valor_final_proyecto
	// 	// valor_adminstrativo = valor_adminstrativo
	// 	// valor_operativo = valor_operativo
	// 	// valor_arte = valor_arte
	// 	// valor_animacion = valor_animacion

	// 	// $mensaje_respuesta = array(
	// 	// 	"00-"=>'========================================',
	// 	// 	"01-cliente"=>$cliente,
	// 	// 	"02-valor_proyecto"=>$valor_proyecto,
	// 	// 	"03-valor_proyecto_menos_comision"=>$data_proyecto['valor_proyecto_menos_comision'],
	// 	// 	"04-check_adelanto"=>$valor_avance,
	// 	// 	"05-porcentaje_descuento_avance"=>$porcentaje_descuento_avance,
	// 	// 	"06-valor_comision_adelanto"=>$valor_avance_comision,
	// 	// 	"07-valor_final_proyecto"=>$valor_final_proyecto,
	// 	// 	"08"=>'========================================',
	// 	// 	"09-valor_adminstrativo"=>$valor_adminstrativo,
	// 	// 	"10-valor_operativo"=>$valor_operativo,
	// 	// 	"11"=>'========================================',
	// 	// 	"12-valor_arte"=>($valor_operativo*$data_proyecto['porcentaje_arte'])/100,
	// 	// 	"13-valor_animacion"=>($valor_operativo*$data_proyecto['porcenteje_animacion'])/100,
	// 	// 	"14"=>'========================================',
	// 	// 	"15-valor_extra_sonido"=>$data_proyecto['valor_extra_sonido'],
	// 	// 	"16-valor_extra_sonido_menos_comision"=>$data_proyecto['valor_extra_sonido_menos_comision'],
	// 	// 	"17-valor_extra_sonido_adelanto"=>$valor_extra_sonido_adelanto,
	// 	// 	"17-valor_extra_sonido_final"=>$valor_extra_sonido_final,
	// 	// 	"19"=>'========================================',
	// 	// 	"20-valor_extra_arte"=>$data_proyecto['valor_extra_arte'],
	// 	// 	"21-valor_extra_arte_comision"=>$data_proyecto['valor_extra_arte_comision'],
	// 	// 	"-valor_extra_arte_comision_adelanto"=>$valor_extra_arte_comision_adelanto,
	// 	// 	"-valor_extra_arte_menos_comision"=>$valor_extra_arte_menos_comision,
	// 	// 	""=>'========================================',
	// 	// 	"-valor_extra_animacion"=>$data_proyecto['valor_extra_animacion'],
	// 	// 	"-valor_extra_animacion_comision"=>$data_proyecto['valor_extra_animacion_comision'],
	// 	// 	"-valor_extra_animacion_comision_adelanto"=>$valor_extra_animacion_comision_adelanto,
	// 	// 	"-valor_extra_animacion_menos_comision"=>$valor_extra_animacion_menos_comision,
	// 	// );


	// 	// $respuesta = $mdl_proyecto->actualizarProyecto(
	// 	// 	$id_proyecto,
	// 	// 	$valor_final_proyecto,
	// 	// 	$valor_arte,
	// 	// 	$valor_animacion,
	// 	// 	$valor_avance,
	// 	// 	$valor_avance_comision,
	// 	// 	$valor_extra_arte_comision_adelanto,
	// 	// 	$valor_extra_arte_final,
	// 	// 	$valor_extra_arte_forja,
	// 	// 	$valor_extra_animacion_comision_adelanto,
	// 	// 	$valor_extra_animacion_menos_comision,
	// 	// 	$valor_extra_animacion_forja,
	// 	// 	$valor_extra_sonido_adelanto,
	// 	// 	$valor_extra_sonido_final,
	// 	// 	$valor_extra_sonido_forja,
	// 	// 	$valor_tip_comision_adelanto,
	// 	// 	$valor_tip_menos_comision,
	// 	// 	$valor_adminstrativo,
	// 	// 	$valor_administrativo_para_forja,
	// 	// 	$valor_operativo,
	// 	// 	$porcentaje_descuento_avance
	// 	// );

	// 	if ($respuesta) {
	// 		$mensaje_respuesta = array(
	// 				"01-valor_avance"=>$valor_avance,
	// 				"02-valor_avance_comision"=>$valor_avance_comision,
	// 				"03-valor_final_proyecto"=>$valor_final_proyecto,
	// 				"04-valor_adminstrativo"=>$valor_adminstrativo,
	// 				"05-valor_operativo"=>$valor_operativo,
	// 				"06-valor_arte"=>$valor_arte,
	// 				"07-valor_tip_arte"=>$valor_tip_arte,
					


	// 				"08-valor_animacion"=>$valor_animacion,
	// 				"09-valor_tip_animacion"=>$valor_tip_animacion,
	// 				"10-valor_tip_sonido"=>$valor_tip_sonido,


	// 				"11-valor_tip_base_calculo"=>$valor_tip_base_calculo,
	// 				"12-porcentaje_tip_arte"=>$porcentaje_tip_arte,
	// 				"13-porcentaje_tip_animacion"=>$porcentaje_tip_animacion,
	// 				"14-porcentaje_tip_sonido"=>$porcentaje_tip_sonido,




	// 				"-valor_extra_arte_comision_adelanto"=>$valor_extra_arte_comision_adelanto,
	// 				"-valor_extra_arte_final"=>$valor_extra_arte_final,
	// 				"-valor_extra_arte_forja"=>$valor_extra_arte_forja,
	// 				"-valor_extra_animacion_comision_adelanto"=>$valor_extra_animacion_comision_adelanto,
	// 				"-valor_extra_animacion_menos_comision"=>$valor_extra_animacion_menos_comision,
	// 				"-valor_extra_animacion_forja"=>$valor_extra_animacion_forja,
	// 				"-valor_extra_sonido_adelanto"=>$valor_extra_sonido_adelanto,
	// 				"-valor_extra_sonido_final"=>$valor_extra_sonido_final,
	// 				"-valor_extra_sonido_forja"=>$valor_extra_sonido_forja,
	// 				"-valor_tip_comision_adelanto"=>$valor_tip_comision_adelanto,
	// 				"-valor_tip_menos_comision"=>$valor_tip_menos_comision,
	// 				"-valor_administrativo_para_forja"=>$valor_administrativo_para_forja,
	// 				"-porcentaje_descuento_avance"=>$porcentaje_descuento_avance,

	// 			);
			
	// 	}else{
	// 		$mensaje_respuesta = 'error';
						
	// 	}

	// 	echo json_encode($mensaje_respuesta);
	// 	break;
// ====================================================================================

	case 'calcularProyectoV2':
		$cliente = $mdl_nuevoProyecto->verFilaPorID('cliente', $id_cliente);
		$data_proyecto = $mdl_proyecto->verProyectoPorId($id_proyecto);
		$porcentaje_administrativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');
		$porcentaje_operativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_operativo');


		

		if ($check_anticipo == 1) {
			$valor_avance = 1;
			$valor_avance_comision = ($data_proyecto['valor_proyecto_menos_comision'] * $cliente['porcentaje_anticipo'])/100;
			$valor_tip_comision_adelanto = ($data_proyecto['valor_tip_menos_comision'] * $cliente['porcentaje_anticipo'])/100;
			$valor_extra_sonido_adelanto = ($data_proyecto['valor_extra_sonido_menos_comision'] * $cliente['porcentaje_anticipo'])/100;
			$valor_extra_arte_comision_adelanto = ($data_proyecto['valor_extra_arte_menos_comision'] * $cliente['porcentaje_anticipo'])/100;
			$valor_extra_animacion_comision_adelanto = ($data_proyecto['valor_extra_animacion_menos_comision'] * $cliente['porcentaje_anticipo'])/100;
		}else{
			$valor_avance = 0;
			$valor_avance_comision = 0;
			$valor_tip_comision_adelanto = 0;
			$valor_extra_sonido_adelanto = 0;
			$valor_extra_arte_comision_adelanto = 0;
			$valor_extra_animacion_comision_adelanto = 0;
		}

		$valor_final_proyecto = $data_proyecto['valor_proyecto_menos_comision'] - $valor_avance_comision;
		$valor_adminstrativo = ($valor_final_proyecto * $porcentaje_administrativo['valor'])/100;
		$valor_operativo = ($valor_final_proyecto * $porcentaje_operativo['valor'])/100;
		$valor_arte = ($valor_operativo * $data_proyecto['porcentaje_arte'])/100;
		$valor_animacion = ($valor_operativo*$data_proyecto['porcenteje_animacion'])/100;

		$valor_tip_final = $data_proyecto['valor_tip_menos_comision'] - $valor_tip_comision_adelanto;
		$valor_tip_base_calculo = $valor_arte + $valor_animacion + $data_proyecto['valor_extra_sonido_menos_comision'];

		$porcentaje_tip_arte = ($valor_arte / $valor_tip_base_calculo)*100;
		$porcentaje_tip_animacion = ($valor_animacion / $valor_tip_base_calculo)*100;
		$porcentaje_tip_sonido = ($data_proyecto['valor_extra_sonido_menos_comision'] / $valor_tip_base_calculo)*100;

		$valor_tip_arte = ($porcentaje_tip_arte * $valor_tip_final)/100;
		$valor_tip_animacion = ($porcentaje_tip_animacion * $valor_tip_final)/100;
		$valor_tip_sonido = ($porcentaje_tip_sonido * $valor_tip_final)/100;
		$valor_arte_final = $valor_arte + $valor_tip_arte;
		$valor_animacion_final = $valor_animacion + $valor_tip_animacion;
		$valor_extra_sonido_final = $data_proyecto['valor_extra_sonido_menos_comision'] + $valor_tip_sonido - $valor_extra_sonido_adelanto;

		$valor_extra_arte_final = $data_proyecto['valor_extra_arte_menos_comision'] - $valor_extra_arte_comision_adelanto;
		$valor_extra_animacion_final = $data_proyecto['valor_extra_animacion_menos_comision'] - $valor_extra_animacion_comision_adelanto;

		$usuario_forja_extra_arte = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,8);
		$usuario_forja_extra_animacion = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,9);
		$usuario_forja_extra_sonido = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,10);
		$usuario_forja_adminstrativo = $mdl_proyecto->obtenerFilaPorProyectoUsuarioPerfil($id_proyecto,1,1);

		if ($usuario_forja_extra_arte['porcentaje'] != 0) {
			$valor_extra_arte_forja = ($usuario_forja_extra_arte['porcentaje']*$valor_extra_arte_final)/100;
		}else{
			$valor_extra_arte_forja = 0;
		}

		if ($usuario_forja_extra_animacion['porcentaje'] != 0) {
			$valor_extra_animacion_forja = ($usuario_forja_extra_animacion['porcentaje']*$valor_extra_animacion_final)/100;//11
		}else{
			$valor_extra_animacion_forja = 0;
		}

		if ($usuario_forja_extra_sonido['porcentaje'] != 0) {
			$valor_extra_sonido_forja = ($usuario_forja_extra_sonido['porcentaje']*($data_proyecto['valor_extra_sonido_menos_comision']-$valor_extra_sonido_adelanto))/100;
		}else{
			$valor_extra_sonido_forja = 0;
		}
	
		if ($usuario_forja_adminstrativo['porcentaje'] != 0) {
			$valor_administrativo_para_forja = ($valor_adminstrativo * $usuario_forja_adminstrativo['porcentaje'])/100; //18
		}else{
			$valor_administrativo_para_forja = 0; 
		}

		$respuesta = $mdl_proyecto->actualizarProyecto(
			$id_proyecto,
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
		);


		
		
		// $mensaje_respuesta = array(
		// 	'01-valor_avance' => $valor_avance, //ok
		// 	'02-valor_avance_comision' => $valor_avance_comision,
		// 	'03-valor_final_proyecto' => $valor_final_proyecto,
		// 	'04-valor_adminstrativo' => $valor_adminstrativo,
		// 	'05-valor_operativo' => $valor_operativo,
		// 	'06-valor_arte' => $valor_arte,
		// 	'07-valor_tip_arte' => $valor_tip_arte,
		// 	'08-valor_arte_final' => $valor_arte_final,
		// 	'09-valor_animacion' => $valor_animacion,
		// 	'10-valor_tip_animacion' => $valor_tip_animacion,
		// 	'11-valor_animacion_final' => $valor_animacion_final,
		// 	'12-valor_extra_arte_comision_adelanto' => $valor_extra_arte_comision_adelanto,
		// 	'13-valor_extra_arte_final' => $valor_extra_arte_final,
		// 	'14-valor_extra_animacion_comision_adelanto' => $valor_extra_animacion_comision_adelanto,
		// 	'15-valor_extra_animacion_final' => $valor_extra_animacion_final,
		// 	'16-valor_extra_sonido_adelanto' => $valor_extra_sonido_adelanto,
		// 	'17-valor_tip_sonido' => $valor_tip_sonido,
		// 	'18-valor_extra_sonido_final' => $valor_extra_sonido_final,
		// 	'19-valor_tip_base_calculo' => $valor_tip_base_calculo,
		// 	'20-porcentaje_tip_arte' => $porcentaje_tip_arte,
		// 	'21-porcentaje_tip_animacion' => $porcentaje_tip_animacion,
		// 	'22-porcentaje_tip_sonido' => $porcentaje_tip_sonido,
		// 	'23-valor_extra_arte_forja' => $valor_extra_arte_forja,
		// 	'24-valor_extra_animacion_forja' => $valor_extra_animacion_forja,
		// 	'25-valor_extra_sonido_forja' => $valor_extra_sonido_forja,
		// 	'26-valor_administrativo_para_forja' => $valor_administrativo_para_forja,
		// 	'27-valor_tip_comision_adelanto' => $valor_tip_comision_adelanto,
		// 	'28-valor_tip_final' => $valor_tip_final,
		// );


		if ($respuesta) {
			$recalcular_porcentaje_admin = $mdl_proyecto->obtenerUsuariosPorTipoProyecto($id_proyecto,1);
			foreach ($recalcular_porcentaje_admin as $key => $value) {
				$recalculoValorGanado = ($value['porcentaje']*$valor_adminstrativo)/100;
				$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
			}

			$recalcular_porcentaje_arte = $mdl_proyecto->obtenerUsuariosPorProyectoPerfil($id_proyecto,5);
			if ($recalcular_porcentaje_arte) {
				foreach ($recalcular_porcentaje_arte as $key => $value) {
					$recalculoValorGanado = ($value['porcentaje']*$valor_arte_final)/100;
					$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
				}	
			}

			$recalcular_porcentaje_animacion = $mdl_proyecto->obtenerUsuariosPorProyectoPerfil($id_proyecto,6);
			if ($recalcular_porcentaje_animacion) {
				foreach ($recalcular_porcentaje_animacion as $key => $value) {
					$recalculoValorGanado = ($value['porcentaje']*$valor_animacion_final)/100;
					$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
				}	
			}

			$recalcular_porcentaje_extra_arte = $mdl_proyecto->obtenerUsuariosPorProyectoPerfil($id_proyecto,8);
			if ($recalcular_porcentaje_extra_arte) {
				foreach ($recalcular_porcentaje_extra_arte as $key => $value) {
					$recalculoValorGanado = ($value['porcentaje']*$valor_extra_arte_final)/100;
					$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
				}	
			}

			$recalcular_porcentaje_extra_animacion = $mdl_proyecto->obtenerUsuariosPorProyectoPerfil($id_proyecto,9);
			if ($recalcular_porcentaje_extra_animacion) {
				foreach ($recalcular_porcentaje_extra_animacion as $key => $value) {
					$recalculoValorGanado = ($value['porcentaje']*$valor_extra_animacion_final)/100;
					$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
				}	
			}

			$recalcular_porcentaje_extra_sonido = $mdl_proyecto->obtenerUsuariosPorProyectoPerfil($id_proyecto,10);
			if ($recalcular_porcentaje_extra_sonido) {
				foreach ($recalcular_porcentaje_extra_sonido as $key => $value) {
					$recalculoValorGanado = ($value['porcentaje']*$valor_extra_sonido_final)/100;
					$mdl_proyecto->recalcularValorGanado($value['id'], $recalculoValorGanado);
				}	
			}

			if ($check_anticipo == 1) {
				$cantidad_usd = $mdl_proyecto->totalesRetiro('cantidad_usd');
				$cambio_cop = $mdl_proyecto->totalesRetiro('cambio_cop');
				if ($cantidad_usd['total'] != 0) {
					$tasa_cambio = $cambio_cop['total'] / $cantidad_usd['total'];
				}else{
					$tasa_cambio = 0;
				}

				$cantidad = $valor_final_proyecto * -1;
				$cambio_cop = $cantidad * $tasa_cambio;

				$insertarAdelantoEnRetiros = $mdl_proyecto->insertarAdelantoEnRetiros($fecha,'Proyecto',$id_proyecto,$cantidad,$tasa_cambio,$cambio_cop);
			}else{
				$insertarAdelantoEnRetiros = $mdl_proyecto->eliminarAdelantoEnRetiros($id_proyecto);
			}


			$mensaje_respuesta = array(
				"estado"=>1,
				"icon"=>'success',
				"title"=>'Proyecto actualizado!',
				"text"=>'El proyecto ha sido actualizado con exito',
				"mensaje"=>$respuesta);
		}else{
			$mensaje_respuesta = array(
				"estado"=>0,
				"icon"=>'error',
				"title"=>'!Error',
				"text"=>'No ha sido posible actualizar el proyecto',
				"mensaje"=>$respuesta);
		}


		echo json_encode($mensaje_respuesta);
		break;

	
	case 'selectEstados':
		$respuesta = $mdl_proyecto->selectEstados();
		while ($row = $respuesta->fetch_object()) {
			echo '<option value='.$row->id.'>'.$row->nombre.'</option>';
		}
		break;
	case 'insertarUsuarioProyecto':
		$data_proyecto = $mdl_proyecto->verProyectoPorId($id_proyecto);
		$validarProyectoUsuarioPerfil = $mdl_proyecto->validarProyectoUsuarioPerfil($id_proyecto,$id_usuario_proyecto,$id_perfil);


		if ($validarProyectoUsuarioPerfil) {
			$mensaje_respuesta = array(
				"estado"=>3,
				"mensaje"=>'Reasignación de usuario');
		}else{
			$respuesta = $mdl_proyecto->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,$id_perfil); 
			if ($id_perfil == 2 || $id_perfil == 5 && $data_proyecto['valor_extra_arte'] != 0) {
				$validarProyectoUsuarioPerfil = $mdl_proyecto->validarProyectoUsuarioPerfil($id_proyecto,$id_usuario_proyecto,8);
				if ($validarProyectoUsuarioPerfil) {
					$mensaje_respuesta = array(
						"estado"=>3,
						"mensaje"=>'Reasignación de usuario estra árte');
				}else{
					$respuesta = $mdl_proyecto->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,8); 
				}
			}
			if ($id_perfil == 3 || $id_perfil == 6 && $data_proyecto['valor_extra_arte'] != 0) {
				$validarProyectoUsuarioPerfil = $mdl_proyecto->validarProyectoUsuarioPerfil($id_proyecto,$id_usuario_proyecto,9);
				if ($validarProyectoUsuarioPerfil) {
					$mensaje_respuesta = array(
						"estado"=>3,
						"mensaje"=>'Reasignación de usuario extra animación');
				}else{
					$respuesta = $mdl_proyecto->insertarUsuarioProyecto($id_proyecto,$id_usuario_proyecto,9); 
				}
			}

			if($respuesta){
				$mensaje_respuesta = array(
					"estado"=>1,
					"mensaje"=>'Usuario asignado correctamente');
			}else{
				$mensaje_respuesta = array(
					"estado"=>0,
					"mensaje"=>'Error en la asignación');
			}
		}

		echo json_encode($mensaje_respuesta);
		break;
	case 'listarUsuarioProyectoPerfil':
		$usuarioProyectoPerfil = array();
		$respuesta = $mdl_proyecto->listarUsuarioProyectoPerfil($id_proyecto,$id_perfil);
		foreach ($respuesta as $key => $value) {
			array_push($usuarioProyectoPerfil, $value);
		}
		echo json_encode($usuarioProyectoPerfil);
		break;
	case 'cargarTablaProyectoEspecialidad':
		$respuesta = $mdl_proyecto->cargarTablaProyectoEspecialidad($id_proyecto,$id_especialidad);
		// $respuesta = $mdl_proyecto->cargarTablaProyectoPerfil(15,1);
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
				"2"=>'<button type="button" class="btn btn-sm btn-outline-info" onclick="modalAgregarPorcentaje('.$row->id.','.$id_especialidad.','.$row->id_perfil.','.$row->id_usuario.','.$row->es_direccion.')">'.$row->porcentaje.' %</button>',
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
//**********************************************************************Cambiar para cargar tablas de extra 
	case 'cargarTablaProyectoPerfil':
		$respuesta = $mdl_proyecto->cargarTablaProyectoPerfil($id_proyecto,$id_perfil);
		// $respuesta = $mdl_proyecto->cargarTablaProyectoPerfil(19,8);
		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			if ($row->es_direccion == 1) {
				$perfil = '<span class="badge badge-pill badge-primary">Director</span>';
			}else{
				$perfil = '<span class="badge badge-pill badge-secondary">'.$row->perfil.'</span>';

			}

			$data[] = array(
				"0"=>$row->usuario_nombre." ".$row->usuario_apellidos.' <small>(Id '.$row->id_usuario.')</small>',			
				"1"=>'<button type="button" class="btn btn-sm btn-outline-info" onclick="modalAgregarPorcentaje('.$row->id.','.$id_especialidad.','.$row->id_perfil.','.$row->id_usuario.','.$row->es_direccion.')">'.$row->porcentaje.' %</button>',
				"2"=>'$ '.$row->valor_ganado
			);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($results);

		break;
//**********************************************************************
	case 'eliminarUsuarioProyecto':
		$respuesta = $mdl_proyecto->eliminarUsuarioProyecto($id_usuario_proyecto);
		echo json_encode($respuesta);
		break;
	case 'obtenerIdUsuarioProyectoForja':
		$respuesta = $mdl_proyecto->obtenerIdUsuarioProyectoForja($id_proyecto);
		echo $respuesta['id'];
		break;
	case 'distribucionPorcentajeAdministrativo':
		$porcentaje_forja = $mdl_proyecto->calcularTotalPorcentaje($id_proyecto,1);
		$porcentaje_arte = $mdl_proyecto->calcularTotalPorcentaje($id_proyecto,2);
		$porcentaje_animacion = $mdl_proyecto->calcularTotalPorcentaje($id_proyecto,3);

		$porcentajes_administrativos = array(
			'porcentaje_forja' => $porcentaje_forja['total_porcentaje'], 
			'porcentaje_arte' => $porcentaje_arte['total_porcentaje'], 
			'porcentaje_animacion' =>$porcentaje_animacion['total_porcentaje']);

		echo json_encode($porcentajes_administrativos);

		break;

	// ********************************************************************************
	
	case 'totalPorcentajePorProyectoDireccion':
		$respuesta = $mdl_proyecto->totalPorcentajePorProyectoDireccion(17, 1);
		print_r($respuesta);
		break;
	case 'totalValorGanadoPorProyectoDireccion':
		$respuesta = $mdl_proyecto->totalValorGanadoPorProyectoDireccion(17, 1);
		print_r($respuesta);
		break;
	case 'obtenerTodoPorIdUsuarioProyecto':
		$id_usuario_proyecto = 157;
		$respuesta = $mdl_proyecto->obtenerTodoPorIdUsuarioProyecto($id_usuario_proyecto);
		print_r($respuesta);
		break;

	// ********************************************************************************
	case 'editarPorcentaje':

		if ($es_direccion == 1) {
			$porcentaje_asignado = $mdl_proyecto->totalPorcentajePorProyectoDireccion($id_proyecto, $es_direccion);
			// $porcentaje_asignado = $porcentaje_asignado['total'];
		}else{
			$porcentaje_asignado = $mdl_proyecto->totalPorcentajePorProyectoDireccionPerfil($id_proyecto, $es_direccion, $id_perfil);
		}
			
			$porcentaje_asignado = $porcentaje_asignado['total'];
			




		$obtenerTodoPorIdUsuarioProyecto = $mdl_proyecto->obtenerTodoPorIdUsuarioProyecto($id_usuario_proyecto);
		$porcentaje_de_usuario = $obtenerTodoPorIdUsuarioProyecto['porcentaje'];
		



		$porcent_existente_mas_nuevo = $porcentaje_asignado+$porcentaje-$porcentaje_de_usuario;
		$porcentaje_disponible = (100 - $porcentaje_asignado) + $porcentaje_de_usuario;

		if ($porcent_existente_mas_nuevo > 100) {
			$mensaje_respuesta = array(
				"estado"=>0,
				"mensaje"=>'Este valor supera el 100% (Valor restante '.($porcentaje_disponible).'%)',
				"01 - Porcentaje_asignado"=>$porcentaje_asignado,
				"porcent_existente_mas_nuevo"=>$porcent_existente_mas_nuevo,
				"porcentaje_disponible" =>$porcentaje_disponible,
				"02 - porcentaje_de_usuario" =>$porcentaje_de_usuario
			);
		}else{
			$actualizar_porcentaje = $mdl_proyecto->actualizarUsuarioProyecto($id_usuario_proyecto,$porcentaje,$valor_ganado);
			if ($actualizar_porcentaje) {
				$mensaje_respuesta = array(
					"estado"=>1,
					"mensaje"=>'Valor actualizado correctamente',
					"01 - Porcentaje_asignado"=>$porcentaje_asignado,
					"porcent_existente_mas_nuevo"=>$porcent_existente_mas_nuevo,
					"porcentaje_disponible" =>$porcentaje_disponible,
					"02 - porcentaje_de_usuario" =>$porcentaje_de_usuario
				);	
			}else{
				$mensaje_respuesta = array(
					"estado"=>0,
					"mensaje"=>'Error al actualizar el porcentaje',
					"01 - Porcentaje_asignado"=>$porcentaje_asignado,
					"porcent_existente_mas_nuevo"=>$porcent_existente_mas_nuevo,
					"porcentaje_disponible" =>$porcentaje_disponible,
					"02 - porcentaje_de_usuario" =>$porcentaje_de_usuario
				);
			}
		}
		echo json_encode($mensaje_respuesta);
		break;

	case 'totalesRetiro':
		$cantidad_usd = $mdl_proyecto->totalesRetiro('cantidad_usd');
		$cambio_cop = $mdl_proyecto->totalesRetiro('cambio_cop');
		if ($cantidad_usd['total'] != 0) {
			$tasa_cambio = $cambio_cop['total'] / $cantidad_usd['total'];
		}else{
			$tasa_cambio = 0;
		}
		$totales = array(
			'cantidad_usd' => $cantidad_usd['total'],
			'cambio_cop' => $cambio_cop['total'],
			'tasa' => $tasa_cambio
		);
		echo json_encode($totales);
		break;

	case 'validarAdelanto':
		$cantidad_usd = $mdl_proyecto->totalesRetiro('cantidad_usd');
		echo $cantidad_usd['total'];
		break;
	default:	
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}