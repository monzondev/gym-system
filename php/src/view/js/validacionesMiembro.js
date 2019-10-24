$(document).ready(function () {

    $('#registrarE').click(function () {

        //ESTADOS PARA LAS VALIDACIONES
        var status1 = false;
        var status2 = false;
        var status3 = false;
        var status5 = false;
        var status6 = false;
        var status10 = false;
        var status11 = false;

        //MENSAJES PARA LAS VALIDACIONES
        var requerido = "<img src='img/errorr.png'width='22' >     Este campo es requerido";
        var espacios = "<img src='img/errorr.png'width='22' >     Espacios vacios no permitidos";
        var notEmail = "<img src='img/errorr.png'width='22' >     Formato de correo no permitido";

        //CAMPOS A VALIDAR
        var name1 = document.getElementById("nombre1");
        var name2 = document.getElementById("nombre2");
        var lastName1 = document.getElementById("apellido1");
        var lastName2 = document.getElementById("apellido2");
        var user = document.getElementById("usuario");
        var email = document.getElementById("email");
        var tel = document.getElementById("telefono");
       


        //REFERENCIA A LOS ERRORES POR CAMPO
        var error1 = document.getElementById("error1");
        var error2 = document.getElementById("error2");
        var error3 = document.getElementById("error3");
        var error5 = document.getElementById("error5");
        var error6 = document.getElementById("error6");
        var error10 = document.getElementById("error10");
        var error11 = document.getElementById("error11");

           //VALIDACION NUMERO DE TELEFONO
           if (tel.value == "") {
            tel.focus();
            error6.innerHTML = requerido;
        } else {
            error6.innerHTML = "";
            status6 = true;
        }


        //VALIDACION CORREO ELECTRONICO
        if (email.value == "") {
            email.focus();
            error5.innerHTML = requerido;
        } else if (email.value.trim() == "") {
            email.focus();
            error5.innerHTML = espacios;
        } else if (!(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email.value))) {
            email.focus();
            error5.innerHTML = notEmail;
        } else {
            error5.innerHTML = "";
            status5 = true;
        }

        //VALIDACION USUARIO
        if (user.value == "") {
            user.focus();
            error3.innerHTML = requerido;
        } else if (user.value.trim() == "") {
            user.focus();
            error3.innerHTML = espacios;
        } else {
            error3.innerHTML = "";
            status3 = true;
        }
         //VALIDACION APELLIDO2
         if (lastName2.value == "") {
            lastName2.focus();
            error11.innerHTML = requerido;
        } else if (lastName2.value.trim() == "") {
            lastName2.focus();
            error11.innerHTML = espacios;
        } else {
            error11.innerHTML = "";
            status11 = true;
        }


        //VALIDACION APELLIDO1
        if (lastName1.value == "") {
            lastName1.focus();
            error2.innerHTML = requerido;
        } else if (lastName1.value.trim() == "") {
            lastName1.focus();
            error2.innerHTML = espacios;
        } else {
            error2.innerHTML = "";
            status2 = true;
        }

         //VALIDACION NOMBRE2
         if (name2.value == "") {
            name2.focus();
            error10.innerHTML = requerido;
        } else if (name2.value.trim() == "") {
            name2.focus();
            error10.innerHTML = espacios;
        } else {
            error10.innerHTML = "";
            status10 = true;
        }



        //VALIDACION NOMBRE1
        if (name1.value == "") {
            name1.focus();
            error1.innerHTML = requerido;
        } else if (name1.value.trim() == "") {
            name1.focus();
            error1.innerHTML = espacios;
        } else {
            error1.innerHTML = "";
            status1 = true;
        }


        //VALIDACION DE ESTADOS DE LOS CAMPOS
        if (status1 && status2 && status3 && status5 && status6 && status10 && status11) {

            var username = $.trim($("#usuario").val());

            var dataString = 'usuario=' + username + '&userValidate=1';
            $.ajax({
                type: "POST",
                url: "../controller/miembroController.php",
                data: dataString,
                beforeSend: function () {
                    $("#registrarE").val('Validando...');
                },
                success: function (response) {
                    $("#registrarE").val('Registrar');
                    var datos = JSON.parse(response);
                    console.log(datos);
                     toastr.options.timeOut = 1500; //1.5s
                     toastr.options.closeButton = true;
                     if (datos.success === '1') {
                         //document.getElementById("form").submit();
                     } else if (datos.success === '2') {
                        toastr.remove();
                         toastr.error('El usuario ya existe, prueba con otro!');
                         user.focus();
                     }else if (datos.success === '3') {
                        toastr.remove();
                        toastr.error('Debe ingresar un nombre de usuario');
                    }

                 }
            });

        }
    });
});