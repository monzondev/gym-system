function validar() {

    //ESTADOS PARA LAS VALIDACIONES
    var status1 = false;
    var status2 = false;
    var status3 = false;
    var status4 = false;
    var status5 = false;
    var status6 = false;
    var status7 = false;
    var status8 = false;
    var status9 = false;

    //MENSAJES PARA LAS VALIDACIONES
    var requerido = "<img src='img/errorr.png'width='22' >     Este campo es requerido";
    var espacios = "<img src='img/errorr.png'width='22' >     Espacios vacios no permitidos";
    var notEmail =  "<img src='img/errorr.png'width='22' >     Formato de correo no permitido";

    //CAMPOS A VALIDAR
    var names = document.getElementById("nombres");
    var lastNames = document.getElementById("apellidos");
    var user = document.getElementById("usuario");
    var password = document.getElementById("password");
    var email = document.getElementById("email");
    var tel = document.getElementById("telefono");
    var date = document.getElementById("fecha");
    var type = document.getElementById("tipoempleado");
    var generoM = document.getElementById("R1M");
    var generoF = document.getElementById("R1F");


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

    //VALIDACION TIPO DE GENERO
    if (!document.querySelector('input[name="genero"]:checked')) {
        generoM.focus();
        error9.innerHTML = requerido;
    } else {
        error9.innerHTML = "";
        status9 = true;
    }


    //VALIDACION TIPO DE EMPLEADO
    if (type.value ==0) {
        tel.focus();
        error8.innerHTML = requerido;
    } else {
        error8.innerHTML = "";
        status8 = true;
    }

    //VALIDACION FECHA DE NACIMIENTO
    if (date.value ==null || date.value ==0) {
        tel.focus();
        error7.innerHTML = requerido;
    } else {
        error7.innerHTML = "";
        status7 = true;
    }


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
    }else{
        error5.innerHTML = "";
        status5 = true;
    }


    //VALIDACION CONTRASEÑA
    if (password.value == "") {
        password.focus();
        error4.innerHTML = requerido;
    } else if (password.value.trim() == "") {
        password.focus();
        error4.innerHTML = espacios;
    } else {
        error4.innerHTML = "";
        status4 = true;
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


    //VALIDACION APELLIDOS
    if (lastNames.value == "") {
        lastNames.focus();
        error2.innerHTML = requerido;
    } else if (lastNames.value.trim() == "") {
        lastNames.focus();
        error2.innerHTML = espacios;
    } else {
        error2.innerHTML = "";
        status2 = true;
    }


    //VALIDACION NOMBRES
    if (names.value == "") {
        names.focus();
        error1.innerHTML = requerido;
    } else if (names.value.trim() == "") {
        names.focus();
        error1.innerHTML = espacios;
    } else {
        error1.innerHTML = "";
        status1 = true;
    }


    //VALIDACION DE ESTADOS DE LOS CAMPOS
    if (status1 && status2 && status3 && status4 && status5 && status6 && status7 && status8 && status9) {
        document.getElementById("form").submit();
    }

}