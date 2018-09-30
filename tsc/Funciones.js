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
            AdministrarSpanError(camposIn[i].id, false);
            console.log("input: " + camposIn[i].id + "-" + camposIn[i].value);
            if (!ValidarCamposVacios(camposIn[i].value)) {
                console.log("Campo " + camposIn[i].name + " vacio");
                AdministrarSpanError(camposIn[i].id, true);
                camposVacios = true;
            }
            switch (camposIn[i].name) {
                case "txtNombre":
                    nombre = (camposIn[i].value);
                    break;
                case "txtApellido":
                    apellido = (camposIn[i].value);
                    break;
                case "rbTurnoM":
                    if (camposIn[i].checked)
                        turno = (camposIn[i].value);
                    break;
                case "rbTurnoT":
                    if (camposIn[i].checked)
                        turno = (camposIn[i].value);
                    break;
                case "rbTurnoN":
                    if (camposIn[i].checked)
                        turno = (camposIn[i].value);
                    break;
                case "txtDni":
                    dni = Number(camposIn[i].value);
                    if (!ValidarRangoNumerico(Number(camposIn[i].value), 1000000, 55000000)) {
                        console.log("Rango DNI invalido");
                        AdministrarSpanError(camposIn[i].id, true);
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtLegajo":
                    legajo = Number(camposIn[i].value);
                    if (!ValidarRangoNumerico(Number(camposIn[i].value), 100, 550)) {
                        console.log("Rango Legajo invalido");
                        AdministrarSpanError(camposIn[i].id, true);
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtSueldo":
                    sueldo = Number(camposIn[i].value);
                    if (!ValidarRangoNumerico(Number(camposIn[i].value), 8000, ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()))) {
                        console.log("Rango Sueldo invalido");
                        AdministrarSpanError(camposIn[i].id, true);
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
            AdministrarSpanError(camposIn[i].id, true);
            comboNoSeleccionado = true;
        }
        if (comboNoSeleccionado || camposVacios || camposFueraDeRango) {
            alert("Verificar errores de carga");
        }
        else {
            var formData = new FormData(formulario);
            formData.forEach(function (value, key) {
                console.log("elemento: " + key + "-" + value);
            });
            //FORM OK
            //METODO; URL; ASINCRONICO?
            xhttp.open("POST", "../Controladores/administracion.php", true);
            //SETEO EL ENCABEZADO DE LA PETICION	
            // xhttp.setRequestHeader("content-type","application/form-data");
            // xhttp.setRequestHeader("enctype", "multipart/form-data");
            //ENVIO DE LA PETICION CON LOS PARAMETROS
            xhttp.send(formData);
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
function AdministrarSpanError(id, error) {
    var elemento = document.getElementById(id);
    if (error) {
        if (elemento != null)
            elemento.style.borderColor = "red";
    }
    else {
        if (elemento != null)
            elemento.style.borderColor = "white";
    }
}
function VerificarValidacionesLogin() {
    var retorno = false;
    return retorno;
}
function AdministrarValidacionesLogin() {
    var dni = 0;
    var apellido = "";
    var camposVacios = false;
    var camposFueraDeRango = false;
    var formulario = document.getElementById("frmLogin");
    console.log("form: " + formulario);
    if (formulario != null) {
        var camposIn = formulario.getElementsByTagName("input");
        console.log("Cantidad de inputs: " + camposIn.length);
        for (var i = 0; i < camposIn.length; i++) {
            AdministrarSpanError(camposIn[i].id, false);
            console.log("input: " + camposIn[i].id + "-" + camposIn[i].value);
            if (!ValidarCamposVacios(camposIn[i].value)) {
                console.log("Campo " + camposIn[i].name + " vacio");
                AdministrarSpanError(camposIn[i].id, true);
                camposVacios = true;
            }
            switch (camposIn[i].name) {
                case "txtDni":
                    dni = Number(camposIn[i].value);
                    if (!ValidarRangoNumerico(Number(camposIn[i].value), 1000000, 55000000)) {
                        console.log("Rango DNI invalido");
                        AdministrarSpanError(camposIn[i].id, true);
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtApellido":
                    apellido = (camposIn[i].value);
                    break;
            }
        }
        if (camposVacios || camposFueraDeRango) {
            alert("Errores de carga");
            return false;
        }
        else {
            return true;
        }
    }
}
