<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once("./Entidades/Fabrica.php");

        $nombrePagina = "HTML 5 - Formulario Alta Empleado";
        $titulo = "Alta de empleado";
        $botonTxt = "Enviar";

        $dni = "";
        $apellido = "";
        $nombre = "";
        $sexo = "";
        $legajo = "";
        $sueldo = "";
        $turno="";
        $readOnly = "";

        $modificar = false;
       // var_dump($_POST);
        if(isset($_POST["modificar"])){
            $nombrePagina = "HTML 5 - Formulario Modificacion Empleado";
            $titulo = "Modificación de empleado";
            $botonTxt = "Modificar";
            
            $fabrica = new Fabrica("fabrica");
            $fabrica->TraerDeArchivo("empleados.txt");
            $empleados = $fabrica->GetEmpleados();
            foreach($empleados as $empleado){
                if($empleado->GetDni() == $_POST["modificar"]){
                    $dni = $empleado->GetDni();
                    $apellido = $empleado->GetApellido();
                    $nombre = $empleado->GetNombre();
                    $sexo = $empleado->GetSexo();
                    $legajo = $empleado->GetLegajo();
                    $sueldo = $empleado->GetSueldo();
                    $turno=$empleado->GetTurno(); 
                    $readOnly = "readonly";

                    $modificar = true;
                    break;                   
                }
            }
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./tsc/funciones.js"></script>
    <link rel="stylesheet" type="text/css" href="./estilos/sheet.css">

    <title><?php echo $nombrePagina; ?></title>
</head>
<body>
    <?php       
        
        require_once("./Controladores/validarSesion.php");

        if(!validarSesion()){           
            header('Location: ./Vistas/login.html');
        }
    ?>
        <div align = "right">
                    <a href = "./Controladores/cerrarSesion.php">Desloguearse</a>
                </div>
        <form id="frmAlta" enctype="multipart/form-data">
        <table align ="center">
                <tr align ="left">
                        <h2><?php echo $titulo; ?></h2>
                </tr>
                <tr>
                <th colspan="2" align = "left">
                    <h4>Datos Personales</h4>
                    <hr>
                    </th>
                </tr>
                <tr>
                    <td>
                        <label>DNI</label>
                    </td>
                    <td>
                        <input type="number" name="txtDni" id="txtDni" min=1000000 max=55000000 value=<?php echo $dni;?> <?php echo $readOnly;?>> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Apellido</label>
                    </td>
                    <td>
                        <input type="text" name="txtApellido" id="txtApellido" value=<?php echo $apellido;?>>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nombre</label>
                    </td>
                    <td>
                        <input type="text" name="txtNombre" id="txtNombre" value=<?php echo $nombre;?>>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Sexo</label>
                    </td>
                    <td>
                        <select name="CbSexo" id="CbSexo">
                            <option value="s">Seleccione</option>
                            <option value="h">Hombre</option>
                            <option value="m">Mujer</option>
                            <option value="t">No define</option>
                        </select>
                    </td>
                </tr>

                <tr>
                        <th colspan="2" align = "left">
                            <h4>Datos Laborales</h4>
                            <hr>
                        </th>
                    </tr>
                <tr>
                    <td>
                        <label>Legajo</label>
                    </td>
                    <td>
                        <input type="number" name="txtLegajo" id="txtLegajo" min=100 max=550 value=<?php echo $legajo;?> <?php echo $readOnly;?>>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Sueldo</label>
                    </td>
                    <td>
                            <input type="number" name="txtSueldo" id="txtSueldo" min = 8000 max = 25000 step=500 value=<?php echo $sueldo;?>>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Turno</label>
                    </td>
                    <td>
                        <input type="radio" name="rbTurnoM" id="rbTurno" value="M"> Mañana<br>
                        <input type="radio" name="rbTurnoT" id="rbTurno"  value="T"> Tarde<br>
                        <input type="radio" name="rbTurnoN" id="rbTurno"  value="N"> Noche
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <hr>    
                    </th>
                </tr>
                <tr>
                    <td colspan="1">
                    <label>Seleccione una imagen:</label>
                    </td>
                    <td>
                        <input type="file" name="archivo" id="archivo"><span hidden>*</span>
                    <?php
                        if($modificar){
                            echo '<input type="hidden" name="hdnModificar" id="hdnModificar" value='.$dni.'>';
                        }
                    ?>
                    </td>
                </tr>
                <tr align = "right">
                    <td></td>
                    <td>
                        <input type="reset" value="Limpiar">
                    </td>
                </tr>
                <tr align = "right">
                    <td></td>
                <td>
                    <input type="button" value=<?php echo $botonTxt; ?> onclick="AdministrarValidaciones()">
                    
                </td>
            </tr>
        </table>
    </form>
    <a id="volver" hidden>Volver</a>
    
</body>
</html>