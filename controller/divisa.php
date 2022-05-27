<?php 
// session_start();
include '../models/Divisa.php';
$mdl_divisa = new Divisa();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$hora = date('G:i:s');
$fecha_hora = date('Y-m-d G:i:s');

$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']) : "" ;


switch ($_GET['op']) {
	case 'listarDivisa':
		$respuesta = $mdl_divisa->listarDivisa();
		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			$data[] = array(
				"0"=>$row->id,
				"1"=>$row->nombre,
				"2"=>$row->iso_divisa,
				"3"=>($row->estado)?'<button type="button" class="btn btn-success btn-sm">Activo</button>':'<button type="button" class="btn btn-outline-danger btn-sm">Inactivo</button>',
				"4"=>'<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>',
			);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($results);
		break;
	case 'cargarSelectDivisa':
		$respuesta = $mdl_divisa->listarActivos();
		while ($row = $respuesta->fetch_object()) {
			echo '<option value='.$row->id.'>'.$row->iso_divisa.'</option>';
		}
		break;
	default:
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}
