<?php 
// session_start();
include '../models/NuevoProyecto.php';
$mdl_nuevoProyecto = new NuevoProyecto();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$hora = date('G:i:s');
$fecha_hora = date('Y-m-d G:i:s');


$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']) : "" ;
$id_moneda = isset($_POST['id_moneda'])? limpiarCadena($_POST['id_moneda']) : "" ;
$nivel = isset($_POST['nivelProyecto'])? limpiarCadena($_POST['nivelProyecto']) : "" ;
$valor_proyecto = isset($_POST['valor_proyecto'])? limpiarCadena($_POST['valor_proyecto']) : "" ;
$id_cliente = isset($_POST['id_cliente'])? limpiarCadena($_POST['id_cliente']) : "" ;
$fecha_inicio = isset($_POST['fecha_inicio'])? limpiarCadena($_POST['fecha_inicio']) : "" ;
$fecha_posible_fin = isset($_POST['fecha_posible_fin'])? limpiarCadena($_POST['fecha_posible_fin']) : "" ;
$valor_tip = isset($_POST['valor_tip'])? limpiarCadena($_POST['valor_tip']) : "" ;
$valor_pago_eps = isset($_POST['valor_pago_eps'])? limpiarCadena($_POST['valor_pago_eps']) : "" ;
$valor_pago_retencion = isset($_POST['valor_pago_retencion'])? limpiarCadena($_POST['valor_pago_retencion']) : "" ;
$detalle = isset($_POST['detalle'])? limpiarCadena($_POST['detalle']) : "" ;
// $nivel_arte_animacion = isset($_POST['nivel_arte_animacion'])? limpiarCadena($_POST['nivel_arte_animacion']) : "" ;
$valor_extra_arte = isset($_POST['valor_extra_arte'])? limpiarCadena($_POST['valor_extra_arte']) : "" ;
$valor_extra_animacion = isset($_POST['valor_extra_animacion'])? limpiarCadena($_POST['valor_extra_animacion']) : "" ;
// $valor_avance = isset($_POST['valor_avance'])? limpiarCadena($_POST['valor_avance']) : "" ;
// $valor_avance_tasa = isset($_POST['valor_avance_tasa'])? limpiarCadena($_POST['valor_avance_tasa']) : "" ;
$valor_extra_sonido = isset($_POST['valor_extra_sonido'])? limpiarCadena($_POST['valor_extra_sonido']) : "" ;
$check_arte = isset($_POST['check_arte'])? limpiarCadena($_POST['check_arte']) : "" ;
$check_animacion = isset($_POST['check_animacion'])? limpiarCadena($_POST['check_animacion']) : "" ;


$id_usuario = 1;


switch ($_GET['op']) {
	case 'nuevoProyecto':
		$cliente = $mdl_nuevoProyecto->verFilaPorID('cliente', $id_cliente);
		// $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');

		// $divisa = $mdl_nuevoProyecto->verFilaPorID('divisa', $id_moneda);
		$data_nivel = $mdl_nuevoProyecto->verNivelPorID($nivel);

		$valor_proyecto_comision = ($valor_proyecto * $cliente['porcentaje_comision'])/100;
		$valor_proyecto_menos_comision = $valor_proyecto - $valor_proyecto_comision;
		$porcentaje_administrativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_administrativo');
		$porcentaje_operativo = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_operativo');
		$valor_adminstrativo = ($valor_proyecto_menos_comision * $porcentaje_administrativo['valor'])/100;
		$valor_operativo = $valor_proyecto_menos_comision - $valor_adminstrativo;

		// Valida si se selecciona arte, animación o los dos y distribuye el porcentaje
		if ($check_arte == 1 && $check_animacion == 1) {
			$porcentaje_arte = $data_nivel['arte'];
			$porcenteje_animacion = $data_nivel['animacion'];
		}elseif ($check_arte == 1 && $check_animacion != 1){
			$porcentaje_arte = 100;
			$porcenteje_animacion = 0;
		}elseif ($check_arte != 1 && $check_animacion == 1) {
			$porcentaje_arte = 0;
			$porcenteje_animacion = 100;
		}

		// Se almacenna el valor de arte y animación dependiendo de los porcentajes anteriores
		$valor_arte = ($valor_operativo * $porcentaje_arte)/100;
		$valor_animacion = ($valor_operativo * $porcenteje_animacion)/100;

		// =======================================================
		// CALCULOS EXTRA ARTE
		// =======================================================
		if ($valor_extra_arte) {
			$porcentaje_extra_arte_forja = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_extra_arte_forja');
			$porcentaje_extra_arte_forja = $porcentaje_extra_arte_forja['valor'];
			$valor_extra_arte_comision = ($valor_extra_arte * $cliente['porcentaje_comision'])/100;
			$valor_extra_arte_menos_comision =  $valor_extra_arte - $valor_extra_arte_comision;
			$valor_extra_arte_forja = ($valor_extra_arte_menos_comision * $porcentaje_extra_arte_forja)/100;		
		}else{
			$porcentaje_extra_arte_forja = 0;
			$valor_extra_arte_comision = 0;
			$valor_extra_arte_menos_comision = 0; 
			$valor_extra_arte_forja = 0;
		}
		
		// =======================================================
		// CALCULOS EXTRA ANIMACIÓN
		// =======================================================
		if ($valor_extra_animacion) {
			$porcentaje_extra_animacion_forja = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_extra_animacion_forja');
			$porcentaje_extra_animacion_forja = $porcentaje_extra_animacion_forja['valor'];
			$valor_extra_animacion_comision = ($valor_extra_animacion * $cliente['porcentaje_comision'])/100;
			$valor_extra_animacion_menos_comision = $valor_extra_animacion - $valor_extra_animacion_comision;
			$valor_extra_animacion_forja = ($valor_extra_animacion_menos_comision * $porcentaje_extra_animacion_forja)/100;
		}else{
			$porcentaje_extra_animacion_forja = 0;
			$valor_extra_animacion_comision = 0;
			$valor_extra_animacion_menos_comision = 0;
			$valor_extra_animacion_forja = 0;
		}

		// =======================================================
		// CALCULOS EXTRA SONIDO
		// =======================================================
		if ($valor_extra_sonido) {
			$porcentaje_extra_sonido_forja = $mdl_nuevoProyecto->verParametrosConfiguracion('porcentaje_extra_sonido_forja');
			$porcentaje_extra_sonido_forja = $porcentaje_extra_sonido_forja['valor'];
			$valor_extra_sonido_comision = ($valor_extra_sonido * $cliente['porcentaje_comision'])/100;
			$valor_extra_sonido_menos_comision = $valor_extra_sonido - $valor_extra_sonido_comision;
			
		}else{
			$porcentaje_extra_sonido_forja = 0;
			$valor_extra_sonido_comision = 0;
			$valor_extra_sonido_menos_comision = 0;
			$valor_extra_sonido = 0;
		}	

		// =======================================================
		// CALCULOS TIP
		// =======================================================
		$valor_tip_base_calculo = $valor_arte + $valor_animacion + $valor_extra_sonido_menos_comision;


		if ($valor_tip != '') {
			$valor_tip_comision = ($valor_tip * $cliente['porcentaje_comision'])/100;
			$valor_tip_menos_comision = $valor_tip - $valor_tip_comision;

			$porcentaje_tip_arte = ($valor_arte / $valor_tip_base_calculo)*100;
			$porcentaje_tip_animacion = ($valor_animacion / $valor_tip_base_calculo)*100;
			$porcentaje_tip_sonido = ($valor_extra_sonido_menos_comision / $valor_tip_base_calculo)*100;

			$valor_tip_arte = ($valor_tip_menos_comision * $porcentaje_tip_arte)/100;
			$valor_tip_animacion = ($valor_tip_menos_comision * $porcentaje_tip_animacion)/100;
			$valor_tip_sonido = ($valor_tip_menos_comision * $porcentaje_tip_sonido)/100;
		}else{
			$valor_tip_comision = 0;
			$valor_tip_menos_comision = 0;

			$porcentaje_tip_arte = 0;
			$porcentaje_tip_animacion = 0;
			$porcentaje_tip_sonido = 0;

			$valor_tip_arte = 0;
			$valor_tip_animacion = 0;
			$valor_tip_sonido = 0;
		}

		if ($valor_extra_sonido) {
			$valor_extra_sonido_forja = (($valor_extra_sonido_menos_comision+$valor_tip_sonido) * $porcentaje_extra_sonido_forja)/100;
		}else{
			$valor_extra_sonido_forja = 0;
		}

		

		if ($fecha_inicio == '') {

			$fecha_inicio = '1900-01-01';
		}
		if ($fecha_posible_fin == '') {
			$fecha_posible_fin = '1900-01-01';
		}
		

		$porcentaje_comision = $cliente['porcentaje_comision'];
		$porcentaje_administrativo = $porcentaje_administrativo['valor'];
		$porcentaje_operativo = $porcentaje_operativo['valor'];
		$valor_final_proyecto = $valor_proyecto_menos_comision;
		$valor_arte_final = $valor_arte+$valor_tip_arte;
		$valor_animacion_final = $valor_animacion+$valor_tip_animacion;
		$valor_extra_arte_final = $valor_extra_arte_menos_comision;
		$valor_extra_animacion_final = $valor_extra_animacion_menos_comision;
		$valor_extra_sonido_final = $valor_extra_sonido_menos_comision+$valor_tip_sonido;

		$valor_tip_final = $valor_tip_menos_comision;
		

		$respuesta = $mdl_nuevoProyecto->nuevoProyecto(
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
			$fecha_hora,
			$valor_extra_arte_forja,
			$valor_extra_animacion_forja, 
			$valor_extra_sonido_forja,
			$valor_tip_final,
			$id_usuario
		);	




		$datos = array(
			'00-nombre' => $nombre,
			'01-id_cliente' => $id_cliente,
			'02-id_moneda' => $id_moneda,
			'03-nivel' => $nivel,
			'04-valor_proyecto' => $valor_proyecto,
			'05-porcentaje_comision' => $cliente['porcentaje_comision'],
			'06-valor_proyecto_comision' => $valor_proyecto_comision,
			'07-valor_proyecto_menos_comision' => $valor_proyecto_menos_comision,
			'08-adelanto' => 'No aplica',
			'09-valor_avance_comision' => 'No aplica',
			'09-valor_final_proyecto' => $valor_proyecto_menos_comision,
			'10-porcentaje_administrativo' => $porcentaje_administrativo,
			'11-porcentaje_operativo' => $porcentaje_operativo,
			'12-valor_adminstrativo' => $valor_adminstrativo,
			'13-valor_operativo' => $valor_operativo,
			'14-porcentaje_arte' => $porcentaje_arte,
			'15-valor_arte' => $valor_arte,
			'16-valor_tip_arte' => $valor_tip_arte,
			'17-valor_arte_final' => $valor_arte+$valor_tip_arte,
			'18-porcenteje_animacion' => $porcenteje_animacion,
			'19-valor_animacion' => $valor_animacion,
			'20-valor_tip_animacion' => $valor_tip_animacion,
			'21-valor_animacion_final' => $valor_animacion+$valor_tip_animacion,
			'22-valor_extra_arte' => $valor_extra_arte,
			'23-valor_extra_arte_comision' => $valor_extra_arte_comision,
			'24-valor_extra_arte_menos_comision' => $valor_extra_arte_menos_comision,
			'25-valor_extra_arte_comision_adelanto' => 'No aplica',
			'26-valor_extra_arte_final' => $valor_extra_arte_menos_comision,
			'27-valor_extra_animacion' => $valor_extra_animacion,
			'28-valor_extra_animacion_comision' => $valor_extra_animacion_comision,
			'29-valor_extra_animacion_menos_comision' => $valor_extra_animacion_menos_comision,
			'30-valor_extra_animacion_comision_adelanto' => 'No aplica',
			'31-valor_extra_animacion_final' => $valor_extra_animacion_menos_comision,
			'32-valor_extra_sonido' => $valor_extra_sonido,
			'33-valor_extra_sonido_comision' => $valor_extra_sonido_comision,
			'34-valor_extra_sonido_menos_comision' => $valor_extra_sonido_menos_comision,
			'35-valor_extra_sonido_adelanto' => 'No aplica',
			'36-valor_tip_sonido' => $valor_tip_sonido,
			'37-valor_extra_sonido_final' => $valor_extra_sonido_menos_comision+$valor_tip_sonido,
			'38-valor_tip' => $valor_tip,
			'39-valor_tip_comision' => $valor_tip_comision,
			'40-valor_tip_menos_comision' => $valor_tip_menos_comision,
			'41-valor_tip_base_calculo' => $valor_tip_base_calculo,
			'42-porcentaje_tip_arte' => $porcentaje_tip_arte,
			'43-porcentaje_tip_animacion' => $porcentaje_tip_animacion,
			'44-porcentaje_tip_sonido' => $porcentaje_tip_sonido,
			'45-valor_pago_eps' => $valor_pago_eps,
			'46-valor_pago_retencion' => $valor_pago_retencion,
			'47-porcentaje_descuento_avance' => $cliente['porcentaje_anticipo'],
			'48-fecha_inicio' => $fecha_inicio,
			'49-fecha_posible_fin' => $fecha_posible_fin,
			'50-fecha_registro' => $fecha_hora,
			'51-valor_extra_sonido_forja' => $valor_extra_sonido_forja,
			'52-valor_extra_sonido_menos_comision' => $valor_extra_sonido_menos_comision,
			'53-valor_tip_sonido' => $valor_tip_sonido,
			'51-id_usuario' => 1,
		);

		


		if($respuesta){
			$crearUsuarioForjaEnUsuarioProyecto = $mdl_nuevoProyecto->crearUsuarioForjaEnUsuarioProyecto($respuesta);
			// $insertarValoresForjaExtraSonido = $mdl_nuevoProyecto->insertarValoresForjaExtraSonido($respuesta,$valor_extra_sonido_forja);

			if ($valor_extra_sonido) {
				$insertarValoresForjaExtraSonido = $mdl_nuevoProyecto->insertarValoresUsuarioProyecto($respuesta,1,10,30,$valor_extra_sonido_forja);
			}else{
				$insertarValoresForjaExtraSonido = 'Sin extra de sonido';
			}
			if ($valor_extra_arte) {
				$insertarValoresForjaExtraArte = $mdl_nuevoProyecto->insertarValoresUsuarioProyecto($respuesta,1,8,30,$valor_extra_arte_forja);
			}else{
				$insertarValoresForjaExtraArte = 'Sin extra de árte';
			}
			if ($valor_extra_animacion) {
				$insertarValoresForjaExtraAnimacion = $mdl_nuevoProyecto->insertarValoresUsuarioProyecto($respuesta,1,9,30,$valor_extra_animacion_forja);
			}else{
				$insertarValoresForjaExtraAnimacion = 'Sin extra de animación';
			}


			$mensaje_respuesta = array(
				"estado"=>1,
				"icon"=>'success',
				"title"=>'Proyecto creado!',
				"text"=>'El proyecto ha sido creado con exito',
				"mensaje"=>$datos,
				"crearUsuarioForjaEnUsuarioProyecto"=>$crearUsuarioForjaEnUsuarioProyecto,
				"insertarValoresForjaExtraSonido"=>$insertarValoresForjaExtraSonido
			);
		}else{
			$mensaje_respuesta = array(
				"estado"=>0,
				"icon"=>'error',
				"title"=>'!Error',
				"text"=>'No ha sido posible crear el proyecto',
				"mensaje"=>$datos,
			);
		}
		echo json_encode($mensaje_respuesta);
		// echo json_encode($datos);

		break;
	case 'listarClientes':
		$respuesta = $mdl_nuevoProyecto->listarClientes();
		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			$data[] = array(
				"0"=>$row->id,
				"1"=>$row->nombre,
				"2"=>$row->porcentaje_comision,
				"3"=>$row->porcentaje_anticipo,
				"4"=>$row->estado,
				"5"=>'Opciones'				
			);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($results);
		break;
	case 'verNivelPorID':
		$respuesta = $mdl_nuevoProyecto->verNivelPorID(1);
		echo json_encode($respuesta);
		break;
	default:
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}