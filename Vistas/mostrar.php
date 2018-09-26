<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div align = "center">
        <h2> Lista de empleados EMPLEADOS </h2>
        <table border="1">
            <tr >
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Sexo</th>
                <th>Legajo</th>
                <th>Turno</th>
            </tr>
            <?php
                $archivo = fopen("../archivos/empleados.txt","rb");
                while(!feof($archivo)){
                    $linea = fgets($archivo);
                    $arrayLinea = explode("-",$linea);
                    if($arrayLinea[0]!=""){
                    ?>
                        <tr> 
                            <td> <?php echo $arrayLinea[0]; ?> </td>
                            <td> <?php echo $arrayLinea[1]; ?> </td>
                            <td> <?php echo $arrayLinea[2]; ?> </td>
                            <td> <?php echo $arrayLinea[3]; ?> </td>
                            <td> <?php echo $arrayLinea[4]; ?> </td>
                            <td> <?php echo $arrayLinea[5]; ?> </td>
                        </tr>
                    
                    <?php
                    }
                }
                fclose($archivo);  
            
            ?>
        </table>
    </div>
<a href="../index.php">Volver</a>
</body>
</html>