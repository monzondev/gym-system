<html>

<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Inicio de Session</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' media='screen' href='Style/css/reset.css'>
	<link rel='stylesheet' type='text/css' media='screen' href='Style/css/simple-grid.css'>
	<link href="Style/toastr/toastr.css" rel="stylesheet" />

</head>

<body>
	<br><br><br><br><br><br>



	<center>
		<div id="box">
			<form name="form-login" id="loginform" method="post" action="" style="width:30%;">
				<fieldset>
					<h2>Inicio de sesion</h2>
					<br><br>
					<div class="form-group">
						<input class="form-control" placeholder="Usuario" maxlength="15" name="usuario" required id="usuario" type="text" autofocus="" style="width: 70%;">
					</div>
					<br>
					<div class="form-group">
						<input class="form-control" placeholder="Clave" maxlength="15" name="clave" required id="clave" type="password" value="" style="width: 70%;">
					</div>
					<br>

					<br><br>
					<input type="button" name="iniciarsesion" id="login" class="btn btn-twitter btn-block btn-flat" style="width: 30%" value="Iniciar"> </input>
					<br>
					<div id="error"></div>
				</fieldset>
			</form>
		</div>
	</center>

	<script src="Scripts/jQuery/jQuery-2.2.0.min.js"></script>
	<script src="Scripts/Toast/toastr.js"></script>
	<script>
		$(document).ready(function() {
			limpiar();
			$('#login').click(function() {
				var username = $.trim($("#usuario").val());
				var password = $.trim($("#clave").val());
				var dataString = 'usuario=' + username + '&clave=' + password;
				$.ajax({
					type: "POST",
					url: "../Controller/loginController.php",
					data: dataString,
					beforeSend: function() {
						$("#login").val('Validando...');
					},
					success: function(response) {
						$("#login").val('Iniciar');
						var datos = JSON.parse(response);

						toastr.options.timeOut = 1500; //1.5s
						toastr.options.closeButton = true;

						if (datos.success === '1') {
							toastr.clear()
							toastr.success('Logeo Correcto');
							window.location.href = "index.php";
						} else if (datos.success === '2') {
							toastr.clear()
							toastr.error('Contraseña incorrecta');
						} else if (datos.success === '3') {
							toastr.clear()
							toastr.error('Usuario incorrecto');
						} else if (datos.success === '4') {
							toastr.clear()
							toastr.warning('Campos vacios');
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
	</script>
</body>

</html>