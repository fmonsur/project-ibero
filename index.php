<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" href="public/css/index.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-2 col-sm-12"></div>
			<div class="col-lg-6 col-md-8 col-sm-12">
				<div class="card">
					<div class="box" id="box_login">
						<form>
							<br>
							<img src="public/img/logos/logo-forja.png" alt="Forja Group">
							<br>
							<br>
							<p class="text-white"> Ingrese su correo y contraseña!</p> 
							<input type="email" name="" placeholder="Correo"> 
							<input type="password" name="" placeholder="Contraseña"> 
							<a class="forgot" href="#" onclick="verInputRecuperacion()">Olvide mi contraseña</a> 
							<input name="" value="Ingresar" class="boton" onclick="ingresar()">

						</form>
						<div>
							<p class="cod-acceso" onclick="verInputCode()">
								Tengo un código de acceso 
							</p>
						</div>
					</div>

					<div class="box" id="box_code">
						<br>
						<br>
						<br>
						<img src="public/img/logos/logo-forja.png" alt="Forja Group">
						<br>
						<br>
						<p class="text-white"> Registro de código de acceso</p>
						<input type="email" name="" placeholder="Código de acceso">
						<input type="submit" name="" value="Registrarse" class="boton" onclick="verFormRegistro()">
						<br>
						<p class="cod-acceso" onclick="verFormLogin()">Volver</p>
						<br>
						<br>
					</div>

					<div class="box" id="box_recuperacion">
						<br>
						<br>
						<br>
						<img src="public/img/logos/logo-forja.png" alt="Forja Group">
						<br>
						<br>
						<p class="text-white"> Recuperación de contraseña</p>
						<input type="email" name="" placeholder="Correo electrónico">
						<input type="submit" name="" value="Recuperar" class="boton" onclick="recuperarContrasena()">
						<br>
						<p class="cod-acceso" onclick="verFormLogin()">Volver</p>
						<br>
						<br>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-2 col-sm-12"></div>
		</div>
	</div>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="public/js/login.js"></script>
</body>
</html>