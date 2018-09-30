<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    $existeEmpleado = false;
    if(isset($_REQUEST)){
        $legajo = $_REQUEST["legajo"];
    }else{
        $legajo = null;
    }

    if(file_exists("../Entidades/Fabrica.php")) include_once("../Entidades/Fabrica.php");
    if(file_exists("./Entidades/Fabrica.php")) include_once("./Entidades/Fabrica.php");

    if(file_exists("./Archivos/empleados.txt")){
        $archivo = fopen("./Archivos/empleados.txt","rb");
    }
    if(file_exists("../Archivos/empleados.txt")){
        $archivo = fopen("../Archivos/empleados.txt","rb");
    }

    if($archivo != null && $legajo!=null){
        while(!feof($archivo)){
            $linea = fgets($archivo);
            $arrayLinea = explode("-",$linea);
            if(isset($arrayLinea[1])){
                if($legajo == $arrayLinea[4]){
                    $existeEmpleado = true;
                    $empleado = new Empleado($arrayLinea[0],$arrayLinea[1],
                        $arrayLinea[2],$arrayLinea[3],$arrayLinea[4],$arrayLinea[5],$arrayLinea[6]);
                    break;
                }
            }

        }
        fclose($archivo);

    }
    if($existeEmpleado){
        $fabrica = new Fabrica("Fabrica");
        $fabrica->SetCantidadMaxima(7);
        $fabrica->TraerDeArchivo("empleados.txt");
        if($fabrica->eliminarEmpleado($empleado)){
            echo "Empleado: ".$legajo." eliminado!";
            $fabrica->GuardarEnArchivo("empleados.txt");
        }else{
            echo "No se pudo eliminar el empleado";
        }
    }else{
        echo "<p>El empleado NO existe</p>";
    }
    ?>
    <div id="referencias">
        <a href="../index.php">INICIO</a><br><br>
        <a href="../Vistas/mostrar.php">Listar empleados</a>
    </div>
</body>
</html>