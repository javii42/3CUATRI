function AdministrarValidacionesLogin(){
    let dni:number = 0;
    let apellido:string = "";

    let camposVacios:boolean = false;
    let camposFueraDeRango:boolean = false;
    let formulario = document.getElementById("frmLogin");

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
                case "txtDni":
                    dni = Number(camposIn[i].value);
                    if(!ValidarRangoNumerico(Number(camposIn[i].value),1000000,55000000)){
                        console.log("Rango DNI invalido");
                        AdministrarSpanError(camposIn[i].id,true);
                        camposFueraDeRango = true;
                    }
                    break;
                case "txtApellido":
                    apellido = (camposIn[i].value);
                    break;
            }
        }

        if(camposVacios || camposFueraDeRango){
            alert("Errores de carga");
        }
    }
}