function AdministrarModificar(dni:number):void{
    var form = <HTMLFormElement>document.getElementById("frmModificar");

    var input = <HTMLInputElement>document.getElementById("modificar");
    input.value = dni.toString();
    
    form.submit();
}