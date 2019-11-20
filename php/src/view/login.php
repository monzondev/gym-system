<?php
session_start();
include_once '../boundary/empleado.php';
$login = new empleado();
$login->ValidateSessionLogin();
?>
<html>

<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Inicio de Sesión</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="css/toastr.css" rel="stylesheet" />
	<link rel="icon" type="image/png" href="img/favicon.png">
	<style>
		.error {
			font-size: 15px;
		}

		body {
			background: url(img/fondoGym.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;

		}
	</style>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4" style="height: 100vh"></div>
			<div class="col-md-4" style="height: 100vh">
				<form id="form" style="margin-top: 20vh; background-color: rgba(0, 0, 0, 0.05); border-radius: 4px;">
					<br>

					<center>
						<h2 class="form-signin-heading">Body Master Gym</h2>
					</center>
					<br>
					<center>
						<h4 class="form-signin-heading">Iniciar Sesión</h4>
					</center>
					<br>
					<label for="inputEmail" class="sr-only">Usuario</label>
					<center>
						<input class="form-control" placeholder="Usuario" autocomplete="off" style="width: 90%" maxlength="15" name="usuario" id="usuario" type="text" autofocus="">
						<p id="error1" class="text-danger error"> </p>
					</center>

					<br>
					<label for="inputPassword" class="sr-only">Contraseña</label>
					<center>
						<input class="form-control" placeholder="Contraseña" onkeypress="capLock(event)" maxlength="15" style="width: 90%" autocomplete="off" name="clave" id="clave" type="password" value="">
						<p id="error2" class="text-danger error"> </p>
						<p id="error3" class="text-warning error"> </p>
					</center>
					<br>
					<center><button id="login" name="iniciarsesion" class="btn btn-lg btn-dark btn-block" type="button" style="width: 50%">Ingresar</button></center>
					<br>
				</form>

			</div>
			<div class="col-md-4" style="height: 100vh"></div>
		</div>
	</div>



	<script src="js/jQuery-3-4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/toastr.js"></script>
	<script src="js/validacionesLogin.js"></script>
</body>

</html>