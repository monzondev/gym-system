<?php
session_start();
include_once '../boundary/empleado.php';
$login = new empleado();
$login->ValidateSessionLogin();
?>
<!DOCTYPE html>
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

		#viewP:hover {
			cursor: pointer;
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
			<div class="col-md-4 " style="height: 100vh">
				<form id="form" class="justify-content-center align-items-center " style="margin-top: 20vh; background-color: rgba(0, 0, 0, 0.05); border-radius: 4px;">
					<br>

					<h2 class="form-signin-heading text-center">Body Master Gym</h2>
					<br>

					<h4 class="form-signin-heading text-center">Iniciar Sesión</h4>
					<br>

					<label for="inputEmail" class="sr-only ">Usuario</label>
					<input class="form-control " placeholder="Usuario" autocomplete="off" style="width: 90%; margin-left: 16px" maxlength="15" name="usuario" id="usuario" type="text" autofocus="">
					<p id="error1" class="text-danger error text-center"> </p>
					<br>

					<label for="inputPassword" class="sr-only">Contraseña</label>
					<input class="form-control" placeholder="Contraseña" onkeypress="capLock(event)" maxlength="15" style="width: 90%; margin-left: 16px" autocomplete="off" name="clave" id="clave" type="password" value="">
					<div class="text-center">
						<img src='img/viewP.png' width='28' title="Ver contraseña" onclick="mostrar();" id="viewP" style="padding-top: 10px; position: relative; top: -35px; right: -120px;" alt='Ver'>
					</div>
					<p id="error2" class="text-danger error text-center"> </p>
					<p id="error3" class="text-warning error text-center"> </p>
					<br>
					<button id="login" name="iniciarsesion" class="btn btn-lg btn-dark btn-block display:inline" type="button" style="width: 50%;  margin-left: 82px">Ingresar</button>
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