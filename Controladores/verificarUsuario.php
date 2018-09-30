<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validacion Usuario</title>
</head>
<body>
   <?php
        $existeEmpleado = false;

        if(isset($_POST["txtDni"])){
            $dni = $_POST["txtDni"];
        }else{
            $dni = null;
        }
        if(isset($_POST["txtApellido"])){
            $apellido = $_POST["txtApellido"];
        }else{
            $apellido = null;
        }
    
        if(file_exists("./Archivos/empleados.txt")){
            $archivo = fopen("./Archivos/empleados.txt","rb");
        }
        if(file_exists("../Archivos/empleados.txt")){
            $archivo = fopen("../Archivos/empleados.txt","rb");
        }

        if($archivo != null && $dni!=null && $apellido != null){
            while(!feof($archivo)){
                $linea = fgets($archivo);
                $arrayLinea = explode("-",$linea);
                if(isset($arrayLinea[1])){
                    if($apellido == $arrayLinea[1] && $dni == $arrayLinea[2]){
                        $existeEmpleado = true;
                        break;
                    }
                }

            }
            fclose($archivo);

        }
        if($existeEmpleado){
                if(file_exists("../Vistas/mostrar.php")) header("location:../Vistas/mostrar.php");
                if(file_exists("./Vistas/mostrar.php")) header("location:./Vistas/mostrar.php");
            }else{
                echo "<h2>No existe el empleado - Favor ingrese sus datos al sistema</h2><br><br>";
                echo "<a href=../Vistas/login.html>Inicio</a>";
            }
        
   ?>
</body>
</html>