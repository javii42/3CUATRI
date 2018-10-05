<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../tsc/funciones.js"></script>
    <link rel="stylesheet" type="text/css" href="../estilos/sheet.css">
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
                <th align="left" colspan="10">
                    <h2> Lista de EMPLEADOS </h2>
                </th>
            </tr>
            <tr>
                <th align="left" colspan="10">
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
                        <td class="mostrar" colspan="1"> <?php echo $empleado->GetNombre(); ?></td>
                        <td class="mostrar" > <?php echo $empleado->GetApellido(); ?> </td>
                        <td class="mostrar" > <?php echo  $empleado->GetDni();?> </td>
                        <td class="mostrar" > <?php switch(trim( $empleado->GetSexo())){
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
                        <td class="mostrar" > <?php echo  $empleado->GetLegajo(); ?> </td>
                        <td class="mostrar" > <?php echo  "$".$empleado->GetSueldo(); ?> </td>
                        <td class="mostrar" > <?php switch(trim( $empleado->GetTurno())){
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
                        <td class="mostrar" >
                            <img src=<?php echo $empleado->GetPathFoto();?> width="90px" height="90px" />
                        </td>
                        <td class="mostrar" >
                            <a class="button" href="../Controladores/eliminar.php?legajo=<?php echo  $empleado->GetLegajo(); ?>">Eliminar...</a>
                        </td>
                        <td>
                            <input type="button" value="Modificar" onclick="AdministrarModificar(<?php echo  $empleado->GetDni(); ?>)">
                        </td>
                    </tr>
                
                <?php
                }
            ?>
        </table>
    </div>
<a href="../index.php">Volver</a>

<form id="frmModificar" action="../index.php" method="POST">
    <input type="hidden" name="modificar" id="modificar">
</form>

</body>
</html>