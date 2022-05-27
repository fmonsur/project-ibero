<?php 
// session_start();
include '../models/GestionarProyectos.php';
$mdl_gestionarProyectos = new GestionarProyectos();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$hora = date('G:i:s');
$fecha_hora = date('Y-m-d G:i:s');

$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']) : "" ;
$id_proyecto = isset($_POST['id_proyecto'])? limpiarCadena($_POST['id_proyecto']) : "" ;

switch ($_GET['op']) {
	case 'listarProyectos':
		$respuesta = $mdl_gestionarProyectos->listarProyectos();
		$data = Array();
		while ($row = $respuesta->fetch_object()) {

			if ($row->fecha_posible_fin == "1900-01-01") {
				$dateDifference = 'Sin fecha';	
				$estilo_caja = '<span class="border border-secondary" style="padding:3px; border-radius: 5px;">'.$dateDifference.'</span>';
			}else{
				$target = new DateTime($row->fecha_posible_fin);
				$origin = new DateTime($fecha);
				$date_diff = $origin->diff($target);
				$dateDifference = $date_diff->format('%R%a');

				$positivo_negativo = strval($date_diff->format('%R'));
				if ($positivo_negativo == '+') {
					$estilo_caja = '<span class="border border-success" style="padding:3px; border-radius: 5px;">'.$dateDifference.'</span>';
				}else{
					$estilo_caja = '<span class="border border-danger" style="padding:3px; border-radius: 5px;">'.$dateDifference.'</span>';
				}
			}


			if ($row->fecha_inicio == "1900-01-01") {
				$fecha_inicio = 'Sin fecha';
			}else{
				$fecha_inicio = $row->fecha_inicio;
			}

			if ($row->fecha_posible_fin == "1900-01-01") {
				$fecha_posible_fin = 'Sin fecha';
			}else{
				$fecha_posible_fin = $row->fecha_posible_fin;
			}


			if ($row->adelanto_check == 0) {
				$avance = '<span class="badge badge-success">No</span>';
			}else{
				$avance = '<span class="badge badge-warning">Si</span>';
			}

			if ($row->estado == 1) {
				$estado = '<span class="badge badge-primary">Activo</span>';
				$opcion = '<i class="fa fa-trash text-danger" style="cursor:pointer;" onclick="eliminarProyecto('.$row->id.')"></i>';
			}elseif($row->estado == 2){
				$estado = '<span class="badge badge-warning">Terminado</span>';
				$opcion = '<i class="fa fa-times-circle text-secondary"></i>';
			}elseif($row->estado == 3){
				$estado = '<span class="badge badge-success">Pago</span>';
				$opcion = '<i class="fa fa-times-circle text-secondary"></i>';

			}


			$data[] = array(
				"0"=>$row->id,
				"1"=>'<a href="../nuevo-proyecto-fiverr/?id_proyecto='.$row->id.'" title="">'.$row->nombre.'</a>',
				"2"=>$row->nivel,
				"3"=>'$ '.$row->valor_proyecto,
				"4"=>$avance,
				"5"=>$row->nombre_cliente,			
				"6"=>$fecha_inicio,		
				"7"=>$fecha_posible_fin,			
				"8"=>$estilo_caja,
				"9"=>$estado,	
				"10"=>$opcion

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
			$respuesta = $mdl_gestionarProyectos->listarActivos();
			while ($row = $respuesta->fetch_object()) {
				echo '<option value='.$row->id.'>'.$row->nombre.'</option>';
			}
		break;
	case 'eliminarProyecto':
		$eliminarUsuarioProyectoPorID = $mdl_gestionarProyectos->eliminarUsuarioProyectoPorID($id_proyecto);
		if ($eliminarUsuarioProyectoPorID) {
			$eliminarProyectoPorID = $mdl_gestionarProyectos->eliminarProyectoPorID($id_proyecto);	

			if ($eliminarProyectoPorID) {
				$mensaje_respuesta = array(
					"estado"=>1,
					"icon"=>'success',
					"title"=>'Proyecto eliminado!',
					"text"=>'El proyecto ha sido eliminado con exito'
				);
			}else{
				$mensaje_respuesta = array(
					"estado"=>0,
					"icon"=>'error',
					"title"=>'Error al eliminar!',
					"text"=>'No ha sido posible eliminar el proyecto'
				);
			}
		}else{
			$mensaje_respuesta = array(
				"estado"=>0,
				"icon"=>'error',
				"title"=>'Error al eliminar!',
				"text"=>'No ha sido posible eliminar el proyecto'
			);
		}
		echo json_encode($mensaje_respuesta);
		break;
	default:
		// session_destroy();
		// session_unset();
		// header("Location: ../../");
		break;
}