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

         if(file_exists("./Entidades/Fabrica.php")) require_once("./Entidades/Fabrica.php");
         if(file_exists("../Entidades/Fabrica.php")) require_once("../Entidades/Fabrica.php");
 
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
                $fabrica = new Fabrica("fabrica");
                $fabrica->TraerDeArchivo("empleados.txt");
                $empleados = $fabrica->GetEmpleados();
                foreach($empleados as $empleado){
                    ?>
                    <tr> 
                        <td colspan="1"> <?php echo $empleado->GetNombre(); ?></td>
                        <td> <?php echo $empleado->GetApellido(); ?> </td>
                        <td> <?php echo  $empleado->GetDni();?> </td>
                        <td> <?php switch(trim( $empleado->GetSexo())){
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
                        <td> <?php echo  $empleado->GetLegajo(); ?> </td>
                        <td> <?php echo  "$".$empleado->GetSueldo(); ?> </td>
                        <td> <?php switch(trim( $empleado->GetTurno())){
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
                            <img src=<?php echo $empleado->GetPathFoto();?> width="90px" height="90px" />
                        </td>
                        <td>
                            <a href="../Controladores/eliminar.php?legajo=<?php echo $arrayLinea[4]; ?>">Eliminar...</a>
                        </td>
                    </tr>
                
                <?php
                }
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