<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" href="../../public/css/registro.css">
</head>
<body>
	<div class="container">
		<br>
		<br>
		<form id="frm_registro" method="post">
			
			<div class="row">

				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="form-group text-center">
						<br>
						<img src="../../public/img/logos/logo-forja.png" alt="Forja Group">
					</div>
				</div>


				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Nombre</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Apellido</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">No de docuemento</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Lugar de expedicion</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Correo</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Celular / Móvil</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">País</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>
<!-- 
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Perfil</label>
						<select id="id_cliente" name="id_cliente" class="selectpicker" title="Seleccione cliente" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary" required>
							<option>lkjlkj</option>
									</select>
					</div>
				</div>

 -->
			</div>
			<br>
			<div class="row" style="padding-top: 20px;">

				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Contraseña</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Repetir contraseña</label>
						<input type="email" class="form-control" id="" name="" >
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<br>
						<br>
						<div class="checkbox">
							<label>
								<input id="terminos" type="checkbox" value="">
								<a href="">
									Acepto términos y condiciones 									
								</a>
							</label><br>
							<span style="color: red;" id="acept_terminos">Debes aceptar los términos y condiciones</span>
						</div>
					</div>
				</div>



				<div class="col-lg-12 col-md-6 col-sm-12 text-center">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
					</div>	
				</div>

			</div>
		</form>
	</div>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="../../public/js/registro.js"></script>
</body>
</html>