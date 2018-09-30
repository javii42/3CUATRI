<?php
include_once "../Entidades/Fabrica.php";

$empleado = new Empleado($_REQUEST["nombre"],$_REQUEST["apellido"],$_REQUEST["dni"],$_REQUEST["sexo"],$_REQUEST["legajo"],$_REQUEST["sueldo"],$_REQUEST["turno"]);

$fabrica = new Fabrica("Fabrica");
$fabrica->SetCantidadMaxima(7);
$fabrica->TraerDeArchivo("empleados.txt");
if($fabrica->AgregarEmpleado($empleado)){
    $fabrica->GuardarEnArchivo("empleados.txt");
    echo "Empleado cargado: ". $_REQUEST["nombre"]. "-". $_REQUEST["apellido"]. $_REQUEST["dni"]. "-". $_REQUEST["sexo"]. "-". $_REQUEST["legajo"]. "-". $_REQUEST["sueldo"]. "-". $_REQUEST["turno"];
}else{
    echo "error";
}
//echo $fabrica->ToString();
//$archivo = fopen("../archivos/empleados.txt","a+"); 
//$escribio = fwrite($archivo,$empleado->ToString()."\r\n");
//fclose($archivo);     