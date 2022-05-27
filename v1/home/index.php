<?php
ob_start(); 
session_start(); 
if (in_array(1,$_SESSION['apps']) && in_array(1001,$_SESSION['permisos'])) {
	?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<?php include_once "../../estructura/estructura-top.php"; ?>
		<!-- Link's propios de la vista -->
	</head>
	<body>
		<div class="loader"></div>
		<?php include '../../estructura/nav-menu.php'; 	?>

		<br>
		<div class="container">
			
			<div class="row">
				<div align="center">
					<div>
						<h1>Títulos</h1>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">a</div>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">a</div>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">a</div>

			</div>

		</div>


		<?php 
	}else{
		header('Location: ../sin-permiso');
	}
	include '../../estructura/estructura-button.php';
	?>
</body>
</html>
<?php  
ob_end_flush();
?>
