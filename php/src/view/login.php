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
	<title>Inicio de Session</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!--link href="css/toastr.css" rel="stylesheet" /-->
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4" style="height: 100vh"></div>
			<div class="col-md-4" style="height: 100vh">
				<form id="form" style="margin-top: 20vh">
					<center>
						<h2 class="form-signin-heading">Body Master Gym</h2>
					</center>
					<br>
					<center>
						<h4 class="form-signin-heading">Iniciar Sesión</h4>
					</center>
					<br>
					<label for="inputEmail" class="sr-only">Usuario</label>
					<input class="form-control" placeholder="Usuario" maxlength="15" name="usuario" required id="usuario" type="text" autofocus="">
					<br>
					<label for="inputPassword" class="sr-only">Contraseña</label>
					<input class="form-control" placeholder="Contraseña" maxlength="15" name="clave" required id="clave" type="password" value="">
					<br>
					<center><button id="login" name="iniciarsesion" class="btn btn-lg btn-primary btn-block" type="button" style="width: 50%">Iniciar</button></center>
					<br><br>
					<center>
						<input id="salida" style="border: 0; font-size: 17px; width: 50%; font-weight:bold;">
					</center>


				</form>

			</div>
			<div class="col-md-4" style="height: 100vh"></div>
		</div>
	</div>



    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<!--script src="js/toastr.js"></script-->
	<script>
		$('#clave').keypress(function (e) {
  			if (e.which == 13) {
    			$('#login').click();
  		}
		});
		$(document).ready(function() {
			/*
			toastr.options.timeOut = 1500; //1.5s
			toastr.options.closeButton = true;
			toastr.info('Debes iniciar sesión');
			*/
			limpiar();
			$('#login').click(function() {
				var username = $.trim($("#usuario").val());
				var password = $.trim($("#clave").val());
				var dataString = 'usuario=' + username + '&clave=' + password;
				$.ajax({
					type: "POST",
					url: "../controller/loginController.php",
					data: dataString,
					beforeSend: function() {
						$("#login").val('Validando...');
					},
					success: function(response) {
						$("#login").val('Iniciar');
						var datos = JSON.parse(response);

						/*
						toastr.options.timeOut = 1500; //1.5s
						toastr.options.closeButton = true;
						*/

						if (datos.success === '1') {
							$("#salida").css("color", "#27ae60");
							$("#salida").val('Logeo Correcto');
							byeNotify()
							/*
							toastr.success('Logeo Correcto');
							*/
							window.location.href = "index.php";

						} else if (datos.success === '2') {
							$("#salida").css("color", "#c0392b");
							$("#salida").val('Contraseña incorrecta');
							byeNotify()
							/*toastr.remove();
							toastr.error('Contraseña incorrecta');*/
						} else if (datos.success === '3') {
							$("#salida").css("color", "#c0392b");
							$("#salida").val('Usuario incorrecto');
							byeNotify()
							/*toastr.remove();
							toastr.error('Usuario incorrecto');*/
						} else if (datos.success === '4') {

							$("#salida").css("color", "#f1c40f");
							$("#salida").val('Campos vacios');
							byeNotify()
							/*toastr.remove();
							toastr.warning('Campos vacios');*/
							limpiar();

						}

					}
				});

			});

		});

		function limpiar() {
			$("#usuario").val('');
			$("#clave").val('');
		}

		function byeNotify() {
			setTimeout(function() {
				$("#salida").val('');
			}, 1500);

		}
	</script>
</body>

</html>