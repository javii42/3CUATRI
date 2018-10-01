<?php
include_once "../Entidades/Fabrica.php";
if(isset($_POST["rbTurnoM"])) $turno = "M";
if(isset($_POST["rbTurnoT"])) $turno = "T";
if(isset($_POST["rbTurnoN"])) $turno = "N";
$empleado = new Empleado($_REQUEST["txtNombre"],$_REQUEST["txtApellido"],$_REQUEST["txtDni"],$_REQUEST["CbSexo"],$_REQUEST["txtLegajo"],$_REQUEST["txtSueldo"],$turno);
$archivos_disp_ar = array('jpg', 'jpeg', 'gif', 'png', 'bmp'); 
$ext = strtolower(pathinfo($_FILES['archivo']['name'],PATHINFO_EXTENSION));
$nombreFinal = "../img/".$_REQUEST["txtDni"]."_".$_REQUEST["txtApellido"].".".$ext;

if ($_FILES['archivo']["error"] > 0 || !in_array($ext,$archivos_disp_ar) || $_FILES['archivo']['size'] > 10000000 ){
    echo "ERROR Al subir la imagen ". $_FILES['archivo']['name'];
}else{
    if(!move_uploaded_file($_FILES['archivo']['tmp_name'],$nombreFinal)){       
        echo "ERROR Al subir la imagen ". $_FILES['archivo']['name'];
    }
}

$empleado->SetPathFoto($nombreFinal);

$fabrica = new Fabrica("Fabrica");
$fabrica->SetCantidadMaxima(7);
$fabrica->TraerDeArchivo("empleados.txt");
if($fabrica->AgregarEmpleado($empleado)){
    $fabrica->GuardarEnArchivo("empleados.txt");
    echo "Empleado cargado: ". $_REQUEST["txtNombre"]. "-". $_REQUEST["txtApellido"]. $_REQUEST["txtDni"]. "-". $_REQUEST["CbSexo"].
         "-". $_REQUEST["txtLegajo"]. "-". $_REQUEST["txtSueldo"]. "-". $turno."-".$nombreFinal;
}else{
    echo "error";
}
//echo $fabrica->ToString();
//$archivo = fopen("../archivos/empleados.txt","a+"); 
//$escribio = fwrite($archivo,$empleado->ToString()."\r\n");
//fclose($archivo);     