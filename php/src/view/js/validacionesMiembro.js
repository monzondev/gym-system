$(document).ready(function () {

    $('#registrarM').click(function () {

        //ESTADOS PARA LAS VALIDACIONES
        var status1 = false;
        var status3 = false;
        var status4 = false;
        var status5 = false;
        var status6 = false;
        var status7 = false;
        var status8 = false;
        var status9 = false;
        var status10 = false;
        var status11 = false;
        var status12 = false;
        var status13 = false;


        //MENSAJES PARA LAS VALIDACIONES
        var requerido = "<img src='img/errorr.png'width='22' >     Este campo es requerido";
        var espacios = "<img src='img/errorr.png'width='22' >     Espacios vacios no permitidos";
        var notEmail = "<img src='img/errorr.png'width='22' >     Formato de correo no permitido";
        var image = "<img src='img/errorr.png'width='22' >     Solo imagenes jpg permitidas";
        var fecha = "<img src='img/errorr.png'width='22' >    La fecha es muy reciente";

        //CAMPOS A VALIDAR
        var name1 = document.getElementById("nombre1");
        var name2 = document.getElementById("nombre2");
        var lastName1 = document.getElementById("apellido1");
        var lastName2 = document.getElementById("apellido2");
        var user = document.getElementById("usuario");
        var email = document.getElementById("email");
        var tel = document.getElementById("telefono");
        var foto = document.getElementById("foto");
        var generoM = document.getElementById("R1M");
        var altura = document.getElementById("altura");
        var peso = document.getElementById("peso");
        var date = document.getElementById("fecha");
        var type = document.getElementById("tipomembresia");




        //REFERENCIA A LOS ERRORES POR CAMPO
        var error1 = document.getElementById("error1");
        var error2 = document.getElementById("error2");
        var error3 = document.getElementById("error3");
        var error4 = document.getElementById("error4");
        var error5 = document.getElementById("error5");
        var error6 = document.getElementById("error6");
        var error7 = document.getElementById("error7");
        var error8 = document.getElementById("error8");
        var error9 = document.getElementById("error9");
        var error10 = document.getElementById("error10");
        var error11 = document.getElementById("error11");
        var error12 = document.getElementById("error12");
        var error13 = document.getElementById("error13");

        //VALIDACION TIPO DE MEMBRESIA
        if (type.value == 0) {
            type.focus();
            error13.innerHTML = requerido;
        } else {
            error13.innerHTML = "";
            status13 = true;
        }

        //VALIDACION FECHA DE NACIMIENTO
        n = new Date();
        fechaL = n.getFullYear() - 6 + "-" + (n.getMonth() + 1) + "-" + n.getDate();
        if (date.value == null || date.value == 0) {
            date.focus();
            error12.innerHTML = requerido;
        } else if (date.value > fechaL) {
            date.focus();
            error12.innerHTML = fecha;
        } else {
            error12.innerHTML = "";
            status12 = true;
        }

        //VALIDACION PESO
        if (peso.value.length > 0) {
            if (peso.value.trim() == "") {
                peso.focus();
                error11.innerHTML = espacios;
            }else {
                error11.innerHTML = "";
                status11 = true;
            }
        } else {
            error11.innerHTML = "";
            status11 = true;
        }

        //VALIDACION ALTURA
        if (altura.value.length > 0) {
            if (altura.value.trim() == "") {
                altura.focus();
                error10.innerHTML = espacios;
            }else {
                error10.innerHTML = "";
                status10 = true;
            }
        } else {
            error10.innerHTML = "";
            status10 = true;
        }

        //VALIDACION GENERO
        if (!document.querySelector('input[name="genero"]:checked')) {
            generoM.focus();
            error9.innerHTML = requerido;
        } else {
            error9.innerHTML = "";
            status9 = true;
        }

        var extension = foto.value.split('.').pop().toLowerCase();
        //VALIDACION FOTOGRAFIA
        if (foto.files.length == 0) {
            foto.focus();
            error8.innerHTML = requerido;
        } else if (extension !== 'jpg') {
            foto.focus();
            error8.innerHTML = image;
        } else {
            error8.innerHTML = "";
            status8 = true;
        }


        //VALIDACION NUMERO DE TELEFONO
        if (tel.value == "") {
            tel.focus();
            error7.innerHTML = requerido;
        } else {
            error7.innerHTML = "";
            status7 = true;
        }


        //VALIDACION CORREO ELECTRONICO
        if (email.value.length > 0) {
            if (!(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email.value))) {
                email.focus();
                error6.innerHTML = notEmail;
            }else {
                error6.innerHTML = "";
                status6 = true;
            }
        } else {
            error6.innerHTML = "";
            status6 = true;
        }

        //VALIDACION USUARIO
        if (user.value == "") {
            user.focus();
            error5.innerHTML = requerido;
        } else if (user.value.trim() == "") {
            user.focus();
            error5.innerHTML = espacios;
        } else {
            error5.innerHTML = "";
            status5 = true;
        }
        //VALIDACION APELLIDO2
        if (lastName2.value == "") {
            lastName2.focus();
            error4.innerHTML = requerido;
        } else if (lastName2.value.trim() == "") {
            lastName2.focus();
            error4.innerHTML = espacios;
        } else {
            error4.innerHTML = "";
            status4 = true;
        }


        //VALIDACION APELLIDO1
        if (lastName1.value == "") {
            lastName1.focus();
            error3.innerHTML = requerido;
        } else if (lastName1.value.trim() == "") {
            lastName1.focus();
            error3.innerHTML = espacios;
        } else {
            error3.innerHTML = "";
            status3 = true;
        }

       /* //VALIDACION NOMBRE2
        if (name2.value == "") {
            name2.focus();
            error2.innerHTML = requerido;
        } else if (name2.value.trim() == "") {
            name2.focus();
            error2.innerHTML = espacios;
        } else {
            error2.innerHTML = "";
            status2 = true;
        }*/



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
        if (status1 && status4 && status3  && status5 && status6 && status7 && status8 && status9 && status10 && status11 && status12 && status13) {

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
                        document.getElementById("form").submit();
                    } else if (datos.success === '2') {
                        toastr.remove();
                        toastr.error('El usuario ya existe, prueba con otro!');
                        user.focus();
                    } else if (datos.success === '3') {
                        toastr.remove();
                        toastr.error('Debe ingresar un nombre de usuario');
                    }

                }
            });

        }
    });
});