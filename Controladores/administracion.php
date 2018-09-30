<?php
include_once "../Entidades/Fabrica.php";
if(isset($_POST["rbTurnoM"])) $turno = "M";
if(isset($_POST["rbTurnoT"])) $turno = "T";
if(isset($_POST["rbTurnoN"])) $turno = "N";
$empleado = new Empleado($_REQUEST["txtNombre"],$_REQUEST["txtApellido"],$_REQUEST["txtDni"],$_REQUEST["CbSexo"],$_REQUEST["txtLegajo"],$_REQUEST["txtSueldo"],$turno);

if(move_uploaded_file($_FILES['archivo']['tmp_name'],"../img/".$_FILES['archivo']['name'])){
    echo "Archivo ". $_FILES['archivo']['name']. " Subido correctamente como: " . $_FILES['archivo']['name'];
}else{
    echo "ERROR Al subir la imagen ". $_FILES['archivo']['name'];
}

$empleado->SetPathFoto("../img/".$_FILES['archivo']['name']);

$fabrica = new Fabrica("Fabrica");
$fabrica->SetCantidadMaxima(7);
$fabrica->TraerDeArchivo("empleados.txt");
if($fabrica->AgregarEmpleado($empleado)){
    $fabrica->GuardarEnArchivo("empleados.txt");
    echo "Empleado cargado: ". $_REQUEST["txtNombre"]. "-". $_REQUEST["txtApellido"]. $_REQUEST["txtDni"]. "-". $_REQUEST["CbSexo"].
         "-". $_REQUEST["txtLegajo"]. "-". $_REQUEST["txtSueldo"]. "-". $turno."-"."../img/".$_FILES['archivo']['name'];
}else{
    echo "error";
}
//echo $fabrica->ToString();
//$archivo = fopen("../archivos/empleados.txt","a+"); 
//$escribio = fwrite($archivo,$empleado->ToString()."\r\n");
//fclose($archivo);     