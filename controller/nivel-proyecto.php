<?php 
// session_start();
include '../models/NivelProyecto.php';
$mdl_nievelProyecto = new NivelProyecto();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$hora = date('G:i:s');
$fecha_hora = date('Y-m-d G:i:s');

$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']) : "" ;
$porcentaje_comision = isset($_POST['porcentaje_comision'])? limpiarCadena($_POST['porcentaje_comision']) : "" ;
$porcentaje_anticipo = isset($_POST['porcentaje_anticipo'])? limpiarCadena($_POST['porcentaje_anticipo']) : "" ;
$id = isset($_POST['id'])? limpiarCadena($_POST['id']) : "" ;

switch ($_GET['op']) {
	case 'listarNivelesProyecto':
		$respuesta = $mdl_nievelProyecto->listarNivelesProyecto();
		$data = Array();
		while ($row = $respuesta->fetch_object()) {
			$data[] = array(
				"0"=>$row->id,
				"1"=>$row->nombre,
				"2"=>'$ '.$row->valor_nivel,
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
		case 'cargarSelectNivelesProyecto':
		$respuesta = $mdl_nievelProyecto->listarActivos();
		while ($row = $respuesta->fetch_object()) {
			echo '<option value='.$row->id.'>'.$row->nombre.' - Arte '.$row->arte.'% / Anim '.$row->animacion.'%</option>';
		}
		break;
	case 'nivelPorID':
		$respuesta = $mdl_nievelProyecto->nivelPorID($id);
		echo json_encode($respuesta);
		break;
	default:
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}