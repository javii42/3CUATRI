function ValidarCamposVacios(valor:string):boolean{
    let retorno:boolean = false;
    if(valor.length != 0){
        retorno = true;
    }
    return retorno;
}

function ValidarRangoNumerico(num:number,min:number,max:number):boolean{
    let retorno:boolean = true;
    if(num > max || num < min){
        retorno = false;
    }
    return retorno;
}

function ValidarCombo(val1:string,val2:string):boolean{
    let retorno:boolean = true;
    if(val1 == val2){
        retorno = false;
    }
    return retorno;
}

function ObtenerTurnoSeleccionado():string{
    let retorno:string = "";
    retorno = (<HTMLInputElement>document.getElementById("rbTurno")).value;
    return retorno;
}

function ObtenerSueldoMaximo(val:string):number{
    let retorno:number = 0;
    if(val== 'M'){
        retorno = 20000;        
    }else if(val == 'T'){
        retorno = 18500;   
    }else if(val == 'N'){
        retorno = 24000; 
    }    
    return retorno;
}

function AdministrarSpanError(id:string,error:boolean):void{
    var elemento= document.getElementById(id);
    if(error){
        if(elemento!=null) elemento.style.borderColor = "red";
    }else{
        if(elemento!=null) elemento.style.borderColor = "white";
    }
}

function VerificarValidacionesLogin():boolean{
    var retorno:boolean = false;
    return retorno;
}