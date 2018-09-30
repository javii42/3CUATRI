<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../tsc/funciones.js"></script>
    <title>HTML5 - Lista Empleados</title>
    <style>
        td{
            padding:10px;
        }
    </style>
</head>
<body>
    <?php
         
        
        if(file_exists("./Controladores/validarSesion.php")) require_once("./Controladores/validarSesion.php");
        if(file_exists("../Controladores/validarSesion.php")) require_once("../Controladores/validarSesion.php");

         if(!validarSesion()){    
             if(file_exists("./login.html")) header('Location: ./login.html');
             if(file_exists("./Vistas/login.html")) header('Location: ./Vistas/login.html');
             if(file_exists("../Vistas/login.html")) header('Location: ../Vistas/login.html');
         }else{
         }
    ?>
    <div align = "right">
        <a href = "../Controladores/cerrarSesion.php">Desloguearse</a>
    </div>
    <div align = "center">
        <table>
            <tr>
                <th align="left" colspan="8">
                    <h2> Lista de empleados EMPLEADOS </h2>
                </th>
            </tr>
            <tr>
                <th align="left" colspan="8">
                    <h4>Info</h4>
                    <hr/>
                </th>
            </tr>
            <tr >
                <th colspan="1"></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php
                $archivo = fopen("../archivos/empleados.txt","rb");
                while(!feof($archivo)){
                    $linea = fgets($archivo);
                    $arrayLinea = explode("-",$linea);
                    if(isset($arrayLinea[1])){
                    ?>
                        <tr> 
                            <td colspan="1"> <?php echo $arrayLinea[0]; ?></td>
                            <td> <?php echo $arrayLinea[1]; ?> </td>
                            <td> <?php echo $arrayLinea[2]; ?> </td>
                            <td> <?php switch(trim($arrayLinea[3])){
                                    case "h":
                                        echo "Hombre";
                                        break;
                                    case "m":
                                        echo "Mujer";
                                        break;
                                    default:
                                        echo "Indefinido";
                                        break;
                            }  ?> </td>
                            <td> <?php echo $arrayLinea[4]; ?> </td>
                            <td> <?php echo $arrayLinea[5]; ?> </td>
                            <td> <?php switch(trim($arrayLinea[6])){
                                    case "M":
                                        echo "Mañana";
                                        break;
                                    case "T":
                                        echo "Tarde";
                                        break;
                                    case "N":
                                        echo "Noche";
                                        break;
                                    default:
                                        echo "-";
                                        break;
                            } ?> </td>
                            <td>
                                <a href="../Controladores/eliminar.php?legajo=<?php echo $arrayLinea[4]; ?>">Eliminar...</a>
                            </td>
                        </tr>
                    
                    <?php
                    }
                }
                fclose($archivo);  
            
            ?>
            <tr>
                <th colspan="8">
                    <hr/>
                </th>
            </tr>
        </table>
    </div>
<a href="../index.php">Volver</a>
</body>
</html>