function AdministrarValidaciones(){
    console.log("Formulario Enviado");

    let xhttp : XMLHttpRequest = new XMLHttpRequest();

    let dni:number = 0;
    let nombre:string = "";
    let apellido:string = "";
    let sexo:string = "";
    let legajo:number = 0;
    let sueldo:number = 0;
    let turno:string = "";

    let camposVacios:boolean = false;
    let camposFueraDeRango:boolean = false;
    let comboNoSeleccionado:boolean = false;
    let formulario = document.getElementById("frmAlta");

    console.log("form: " + formulario);

    if(formulario != null){
        let camposIn = formulario.getElementsByTagName("input");
        console.log("Cantidad de inputs: " + camposIn.length);
        for(var i = 0; i<camposIn.length;i++){
            AdministrarSpanError(camposIn[i].id,false);
            console.log("input: " + camposIn[i].id + "-" + camposIn[i].value );
           if(!ValidarCamposVacios(camposIn[i].value)){
               console.log("Campo " + camposIn[i].name + " vacio");
               AdministrarSpanError(camposIn[i].id,true);
               camposVacios = true;
           }
           switch(camposIn[i].name){
               case "txtNombre":
                    nombre = (camposIn[i].value);
                    break;
                case "txtApellido":
                    apellido = (camposIn[i].value);
                    break;
                case "rbTurnoM":
                    if(camposIn[i].checked) turno = (camposIn[i].value);
                    break;
                case "rbTurnoT":
                    if(camposIn[i].checked) turno = (camposIn[i].value);
                    break;
                case "rbTurnoN":
                    if(camposIn[i].checked)turno = (camposIn[i].value);
                    break;
               case "txtDni":
                    dni = Number(camposIn[i].value);
                    if(!ValidarRangoNumerico(Number(camposIn[i].value),1000000,55000000)){
                        console.log("Rango DNI invalido");
                        AdministrarSpanError(camposIn[i].id,true);
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtLegajo":
                    legajo = Number(camposIn[i].value);
                    if(!ValidarRangoNumerico(Number(camposIn[i].value),100,550)){
                        console.log("Rango Legajo invalido");
                        AdministrarSpanError(camposIn[i].id,true);
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtSueldo":
                    sueldo = Number(camposIn[i].value);
                   if(!ValidarRangoNumerico(Number(camposIn[i].value),8000,ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()))){
                            console.log("Rango Sueldo invalido");
                            AdministrarSpanError(camposIn[i].id,true);
                            camposFueraDeRango = true;
                        }                
                    break;
                default:
                    break;
           }

        }
        let combo = <HTMLSelectElement>document.getElementById("CbSexo");
        sexo = combo.value;
        combo.style.borderColor = "grey";
        console.log("input: " + combo.id + "-" + combo.value );
        if(!ValidarCombo(combo.value,"s")){
            console.log("Combo de sexo no seleccionado");
            AdministrarSpanError(combo.id,true);
            comboNoSeleccionado = true;
        }

        if(comboNoSeleccionado || camposVacios || camposFueraDeRango){
            alert("Verificar errores de carga");
        }else{
            var formData = new FormData(<HTMLFormElement>formulario); 
            
            formData.forEach((value,key) => {
                console.log("elemento: "+ key+"-"+value)
          });
            //FORM OK
             //METODO; URL; ASINCRONICO?
            xhttp.open("POST", "./Controladores/administracion.php", true);

            //SETEO EL ENCABEZADO DE LA PETICION	
           // xhttp.setRequestHeader("content-type","application/form-data");
           // xhttp.setRequestHeader("enctype", "multipart/form-data");
            //ENVIO DE LA PETICION CON LOS PARAMETROS
            xhttp.send(formData);

            //FUNCION CALLBACK
            let  link = <HTMLElement>document.getElementById("volver");
            xhttp.onreadystatechange = () => {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    if(xhttp.responseText != "error"){
                        alert(xhttp.responseText);
                        link.setAttribute("href","./Vistas/mostrar.php");
                        link.hidden = false;
                    }else{
                        link.setAttribute("href","./index.php");
                        alert("No se pudo cargar el empleado");
                        link.hidden = false;
                    }
                    
                }else{  
                    link.setAttribute("href","./index.php");
                    link.hidden = false;
                }
            }
        }

}
}

