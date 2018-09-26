<?php
include_once "../Entidades/Fabrica.php";

$empleado = new Empleado($_POST["nombre"],$_POST["apellido"],$_POST["dni"],$_POST["sexo"],$_POST["legajo"],$_POST["sueldo"],$_POST["turno"]);

$fabrica = new Fabrica("Fabrica");
$fabrica->SetCantidadMaxima(7);
//$fabrica->TraerDeArchivo("empleados.txt");
/*if($fabrica->AgregarEmpleado($empleado)){
    $fabrica->GuardarEnArchivo("empleados.txt");
    echo "Empleado cargado: ". $_POST["nombre"]. " ". $_POST["apellido"];
}else{
    echo "error";
}
*/
//$archivo = fopen("../archivos/empleados.txt","a+"); 
//$escribio = fwrite($archivo,$empleado->ToString()."\r\n");
//fclose($archivo); 