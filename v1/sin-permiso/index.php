<?php 
ob_start();
session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include_once "../../estructura/estructura-top.php"; ?>
	<!-- Link's propios de la vista -->
</head>
<body>
	<div class="loader"></div>
	<?php include_once "../../estructura/nav-menu.php";?>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12"></div>
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<h1 style="color: gray;">Opsss !!!</h1>
				<br>	
				<img src="../../public/img/lock.png" alt="Sin Permiso" width="200px">
				<br>	
				<br>	
				<b><p style="color: red; text-align: right;">Al parecer no tienes acceso a esta sección.</p></b>
				<p>Si consideras que es un error por favor contácta a servicio técnico.</p>
				<br>	
				<div onclick="window.history.back();" class="text-center"><p style="cursor: pointer;">Volver</p></div>
			</div>

			<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12"></div>
			
		</div>
	</div>
	<?php 
	include_once "../../estructura/estructura-button.php"; 
	?>
	<!-- Script's propios de la vista -->
</body>
</html>
<?php  
ob_end_flush();
?>