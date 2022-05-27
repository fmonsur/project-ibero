<?php 
// session_start();
include '../models/GestionarCambios.php';
$mdl_gestionarCambios = new GestionarCambios();

date_default_timezone_set('America/Bogota');
$fecha_registro = date('Y-m-d G:i:s');

$fecha = isset($_POST['fecha'])? limpiarCadena($_POST['fecha']) : "" ;
$detalle = isset($_POST['detalle'])? limpiarCadena($_POST['detalle']) : "" ;
$cantidad_usd = isset($_POST['cantidad_usd'])? limpiarCadena($_POST['cantidad_usd']) : "" ;
$cambio_cop = isset($_POST['cambio_cop'])? limpiarCadena($_POST['cambio_cop']) : "" ;
$id_usuario = 1;

switch ($_GET['op']) {
	case 'nuevoCambio':
		if ($cantidad_usd != 0) {
			$tasa = $cambio_cop / $cantidad_usd; 
		}else{
			$tasa = '';
		}
			
		$respuesta = $mdl_gestionarCambios->nuevoCambio($fecha,$detalle,$cantidad_usd,$tasa,$cambio_cop,$fecha_registro,$id_usuario);
		if($respuesta){
			$mensaje_respuesta = array(
				"estado"=>1,
				"icon"=>'success',
				"title"=>'Registro almacenado!',
				"text"=>'El registro ha sido creado con exito',
				"mensaje"=>$respuesta);
		}else{
			$mensaje_respuesta = array(
				"estado"=>0,
				"icon"=>'error',
				"title"=>'!Error',
				"text"=>'No ha sido posible crear almacenar el registro',
				"mensaje"=>$respuesta);
		}
		echo json_encode($mensaje_respuesta);
		break;
	case 'totalesRetiro':
		$cantidad_usd = $mdl_gestionarCambios->totalesRetiro('cantidad_usd');
		$cambio_cop = $mdl_gestionarCambios->totalesRetiro('cambio_cop');
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
	case 'listarCanjes':
		$respuesta = $mdl_gestionarCambios->listarCanjes();
		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			if ($row->retiro_no == 0) {
				$retiro_no = '<i class="fa fa-times-circle text-secondary"></i>';
				$opciones = '<i class="fa fa-times-circle text-secondary"></i>';
			}else{
				$retiro_no = $row->retiro_no;
				$opciones = '<i class="fa fa-trash text-danger" style="cursor:pointer;" onclick=""></i>';
			}

			if ($row->detalle != 'Proyecto') {
				$detalle = '<span class="badge badge-light">Retiro</span>';
			}else{
				$detalle = '<span class="badge badge-primary" style="cursor:pointer;" onclick="verProyecto('.$row->id_proyecto.')">Proy-'.$row->id_proyecto.'</span>';
			}

			$data[] = array(
				"0"=>$row->id,
				"1"=>$retiro_no,
				"2"=>$detalle,
				"3"=>'$ '.number_format($row->cantidad_usd),
				"4"=>'$ '.number_format($row->cambio_cop),
				"5"=>'$ '.number_format($row->tasa),
				"6"=>$row->fecha,
				"7"=>$opciones
			);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($results);
		break;
	default:
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}