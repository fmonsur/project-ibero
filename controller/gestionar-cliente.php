<?php 
// session_start();
include '../models/GestionarCliente.php';
$mdl_gestionarCliente = new GestionarCliente();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$hora = date('G:i:s');
$fecha_hora = date('Y-m-d G:i:s');

$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']) : "" ;
$porcentaje_comision = isset($_POST['porcentaje_comision'])? limpiarCadena($_POST['porcentaje_comision']) : "" ;
$porcentaje_anticipo = isset($_POST['porcentaje_anticipo'])? limpiarCadena($_POST['porcentaje_anticipo']) : "" ;

switch ($_GET['op']) {
	case 'nuevoCliente':
		$respuesta = $mdl_gestionarCliente->nuevoCliente($nombre,$porcentaje_comision,$porcentaje_anticipo);
		if($respuesta){
			$mensaje_respuesta = array(
				"estado"=>1,
				"icon"=>'success',
				"title"=>'Cliente creado!',
				"text"=>'El cliente ha sido creado con exito',
				"mensaje"=>$respuesta);
		}else{
			$mensaje_respuesta = array(
				"estado"=>0,
				"icon"=>'error',
				"title"=>'!Error',
				"text"=>'No ha sido posible crear el cliente',
				"mensaje"=>$respuesta);
		}
		echo json_encode($mensaje_respuesta);
		break;
	case 'listarClientes':
		$respuesta = $mdl_gestionarCliente->listarClientes();
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
		case 'cargarSelectCliente':
		$respuesta = $mdl_gestionarCliente->listarActivos();
		while ($row = $respuesta->fetch_object()) {
			echo '<option value='.$row->id.'>'.$row->nombre.'</option>';
		}
		break;
	case 'verClientePorID':
		$respuesta = $mdl_gestionarCliente->verClientePorID(1);
		echo json_encode($respuesta);
		break;
	default:
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}