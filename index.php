<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trabajo Practico - Javier Mollar</title>
</head>
<body>
    <?php
        include_once "./Entidades/Fabrica.php";

        $empleadoJavier = new Empleado("Javier","Mollar",35863182,"M",101,10000,"Tarde");
        $empleadoJavier2 = new Empleado("Javier","Mollar",35863182,"M",101,10000,"Tarde");
        $empleadoFernando = new Empleado("Fernando","Mollar",35863183,"M",103,10000,"Mañana");
        $empleadaMaria= new Empleado("Maria","Mollar",35863184,"F",104,10000,"Noche");

        $fabrica = new Fabrica("La Productora SRL");

        $fabrica->AgregarEmpleado($empleadoJavier);
        $fabrica->AgregarEmpleado($empleadoJavier2);
        $fabrica->AgregarEmpleado($empleadoFernando);
        $fabrica->AgregarEmpleado($empleadaMaria);

        echo "Empleados contratados: <br/>".$fabrica->ToString()."<br><br>";

        echo $empleadaMaria->Hablar(array("Español","Ruso","Ingles"))."<br><br>";

        $fabrica->EliminarEmpleado($empleadaMaria);
        echo "Empleados contratados: <br/>".$fabrica->ToString()."<br><br>";

      //  $fabrica->TraerDeArchivo("empleados.txt");
      //  $fabrica->GuardarEnArchivo("empleados.txt");

        header('Location: ./Vistas/formularioAltaEmpleados.html');
    ?>

</body>
</html>