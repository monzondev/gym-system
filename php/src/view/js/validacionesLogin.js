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

function capLock(e) {
    var notificacion = document.getElementById("error3");
    var mayuscula = "<img src='img/warning.png'width='22' >     Mayuscula activada";

    kc = e.keyCode ? e.keyCode : e.which;
    sk = e.shiftKey ? e.shiftKey : ((kc == 16) ? true : false);
    if (((kc >= 65 && kc <= 90) && !sk) || ((kc >= 97 && kc <= 122) && sk)){
        notificacion.innerHTML = mayuscula;
    }else{
        notificacion.innerHTML = '';
    }
}

function mostrar(){
    var pass = document.getElementById("clave");
    estado = pass.getAttribute('type');
    if(estado == 'text'){
        pass.setAttribute('type','password');
    } if (estado =='password') {
        pass.setAttribute('type','text');
    }
   
}