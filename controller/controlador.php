<?php 
session_start();
include '../models/Modelo.php';
$nombreClase = new NombreClase();

$cliente = isset($_POST['cliente'])? limpiarCadena($_POST['cliente']) : "" ;

switch ($_GET['op']) {
	case 'NombreOperacion':
		$respuesta = $nombreClase->NombreOperacion();
		while ($row = $respuesta->fetch_object()) {
			print_r($row);
		}

		break;
	
	default:
		session_destroy();
		session_unset();
		header("Location: ../../");
		break;
}