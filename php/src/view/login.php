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
	<link href="css/toastr.css" rel="stylesheet" />
	<style>
        .error {
            font-size: 15px;
        }
    </style>
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
					<input class="form-control" placeholder="Usuario" autocomplete="off" maxlength="15" name="usuario" id="usuario" type="text" autofocus="">
					<p id="error1" class="text-danger error"> </p>
					<br>
					<label for="inputPassword" class="sr-only">Contraseña</label>
					<input class="form-control" placeholder="Contraseña" maxlength="15" autocomplete="off" name="clave"  id="clave" type="password" value="">
					<p id="error2" class="text-danger error"> </p>
					<br>
					<center><button id="login" name="iniciarsesion" class="btn btn-lg btn-primary btn-block" type="button" style="width: 50%">Iniciar</button></center>
				</form>

			</div>
			<div class="col-md-4" style="height: 100vh"></div>
		</div>
	</div>



	<script src="js/jQuery-3-4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/toastr.js"></script>
	<script>
		$('#clave').keypress(function(e) {
			if (e.which == 13) {
				$('#login').click();
			}
		});

		$(document).ready(function() {
			limpiar();
			$('#login').click(function() {

				//ESTADOS PARA LAS VALIDACIONES
				var status1 = false;
				var status2 = false;

				//MENSAJES PARA LAS VALIDACIONES
				var requerido = "<img src='img/errorr.png'width='22' >     Este campo es requerido";
				var espacios = "<img src='img/errorr.png'width='22' >     Espacios vacios no permitidos";

				//CAMPOS A VALIDAR
				var user = document.getElementById("usuario");
				var pass = document.getElementById("clave");

				//REFERENCIA A ERRORES
				var error1 = document.getElementById("error1");
				var error2 = document.getElementById("error2");

				//VALIDACIONES

				if (pass.value == "") {
					pass.focus();
					error2.innerHTML = requerido;
				} else if (pass.value.trim() == "") {
					pass.focus();
					error2.innerHTML = espacios;
					pass.value = ""
				} else {
					error2.innerHTML = "";
					status2 = true;
				}

				if (user.value == "") {
					user.focus();
					error1.innerHTML = requerido;
				} else if (user.value.trim() == "") {
					user.focus();
					error1.innerHTML = espacios;
					user.value = ""
				} else {
					error1.innerHTML = "";
					status1 = true;
				}




				if (status1 && status2) {
					var username = $.trim($("#usuario").val());
					var clave = $.trim($("#clave").val());
					var dataString = 'usuario=' + username + '&clave=' + clave;
					$.ajax({
						type: "POST",
						url: "../controller/loginController.php",
						data: dataString,
						beforeSend: function() {
							$("#login").val('Validando...');
						},
						success: function(response) {
							console.log(response);
							$("#login").val('Iniciar');
							var datos = JSON.parse(response);

							toastr.options.timeOut = 1500; //1.5s
							toastr.options.closeButton = true;

							if (datos.success === '1') {
								toastr.success('Logeo Correcto');
								window.location.href = "index.php";

							} else if (datos.success === '2') {

								toastr.remove();
								toastr.error('Contraseña incorrecta');
								pass.focus();
							} else if (datos.success === '3') {

								toastr.remove();
								toastr.error('Usuario incorrecto');
								user.focus();

						}
					}
					});
				}


			});

		});

		function limpiar() {
			$("#usuario").val('');
			$("#clave").val('');
		}
	</script>
</body>

</html>