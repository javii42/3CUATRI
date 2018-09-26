"use strict";
function AdministrarValidaciones() {
    console.log("Formulario Enviado");
    var xhttp = new XMLHttpRequest();
    var dni = 0;
    var nombre = "";
    var apellido = "";
    var sexo = "";
    var legajo = 0;
    var sueldo = 0;
    var turno = "";
    var camposVacios = false;
    var camposFueraDeRango = false;
    var comboNoSeleccionado = false;
    var formulario = document.getElementById("frmAlta");
    console.log("form: " + formulario);
    if (formulario != null) {
        var camposIn = formulario.getElementsByTagName("input");
        console.log("Cantidad de inputs: " + camposIn.length);
        for (var i = 0; i < camposIn.length; i++) {
            camposIn[i].style.borderColor = "white";
            console.log("input: " + camposIn[i].id + "-" + camposIn[i].value);
            if (!ValidarCamposVacios(camposIn[i].value)) {
                console.log("Campo " + camposIn[i].name + " vacio");
                camposIn[i].style.borderColor = "red";
                camposVacios = true;
            }
            switch (camposIn[i].name) {
                case "txtNombre":
                    nombre = (camposIn[i].value);
                    break;
                case "txtApellido":
                    apellido = (camposIn[i].value);
                    break;
                case "rbTurno":
                    turno = (camposIn[i].value);
                    break;
                case "txtDni":
                    dni = Number(camposIn[i].value);
                    if (!ValidarRangoNumerico(Number(camposIn[i].value), 1000000, 55000000)) {
                        console.log("Rango DNI invalido");
                        camposIn[i].style.borderColor = "red";
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtLegajo":
                    legajo = Number(camposIn[i].value);
                    if (!ValidarRangoNumerico(Number(camposIn[i].value), 100, 550)) {
                        console.log("Rango Legajo invalido");
                        camposIn[i].style.borderColor = "red";
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtSueldo":
                    sueldo = Number(camposIn[i].value);
                    if (!ValidarRangoNumerico(Number(camposIn[i].value), 8000, ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()))) {
                        console.log("Rango Sueldo invalido");
                        camposIn[i].style.borderColor = "red";
                        camposFueraDeRango = true;
                    }
                    break;
                default:
                    break;
            }
        }
        var combo = document.getElementById("CbSexo");
        sexo = combo.value;
        combo.style.borderColor = "grey";
        console.log("input: " + combo.id + "-" + combo.value);
        if (!ValidarCombo(combo.value, "s")) {
            console.log("Combo de sexo no seleccionado");
            combo.style.borderColor = "red";
            comboNoSeleccionado = true;
        }
        if (comboNoSeleccionado || camposVacios || camposFueraDeRango) {
            alert("Verificar errores de carga");
        }
        else {
            //FORM OK
            //METODO; URL; ASINCRONICO?
            xhttp.open("POST", "../Controladores/administracion.php", true);
            //SETEO EL ENCABEZADO DE LA PETICION	
            xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            //ENVIO DE LA PETICION CON LOS PARAMETROS
            xhttp.send("nombre=" + nombre + "&apellido=" + apellido + "&dni=" + dni + "&sexo=" + sexo + "&legajo=" + legajo
                + "&sueldo=" + sueldo + "&turno=" + turno);
            //FUNCION CALLBACK
            var link_1 = document.getElementById("volver");
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    if (xhttp.responseText != "error") {
                        alert(xhttp.responseText);
                        link_1.setAttribute("href", "../Vistas/mostrar.php");
                        link_1.hidden = false;
                    }
                    else {
                        link_1.setAttribute("href", "../index.php");
                        alert("No se pudo cargar el empleado");
                        link_1.hidden = false;
                    }
                }
                else {
                    link_1.setAttribute("href", "../index.php");
                    link_1.hidden = false;
                }
            };
        }
    }
}
function ValidarCamposVacios(valor) {
    var retorno = false;
    if (valor.length != 0) {
        retorno = true;
    }
    return retorno;
}
function ValidarRangoNumerico(num, min, max) {
    var retorno = true;
    if (num > max || num < min) {
        retorno = false;
    }
    return retorno;
}
function ValidarCombo(val1, val2) {
    var retorno = true;
    if (val1 == val2) {
        retorno = false;
    }
    return retorno;
}
function ObtenerTurnoSeleccionado() {
    var retorno = "";
    retorno = document.getElementById("rbTurno").value;
    return retorno;
}
function ObtenerSueldoMaximo(val) {
    var retorno = 0;
    if (val == 'M') {
        retorno = 20000;
    }
    else if (val == 'T') {
        retorno = 18500;
    }
    else if (val == 'N') {
        retorno = 24000;
    }
    return retorno;
}
