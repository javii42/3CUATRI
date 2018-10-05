<?php
if(file_exists("../Entidades/Empleado.php")) include_once "../Entidades/Empleado.php";
if(file_exists("./Entidades/Empleado.php")) include_once "./Entidades/Empleado.php";

if(file_exists("../Entidades/interfaces.php")) include_once "../Entidades/interfaces.php";
if(file_exists("./Entidades/interfaces.php")) include_once "./Entidades/interfaces.php";

class Fabrica implements IArchivo{
    private $_cantidadMaxima;
    private $_empleados;
    private $_razonSocial;

    public function __construct($razonSocial){
        $this->_cantidadMaxima = 5;
      //  $this->_empleados[];
        $this->_razonSocial = $razonSocial;
    }
    
    public function SetCantidadMaxima($cant){
        if($cant > 0 ){
            $this->_cantidadMaxima = $cant;
        }
    }
    public function AgregarEmpleado($emp){
        $retorno = false;
        if(is_a($emp,'Empleado') && $this->_cantidadMaxima >= count($this->_empleados)){
            $this->_empleados[] = $emp;
            $retorno = true;
        }
        $this->_empleados = $this->EliminarEmpleadoRepetido();
        return $retorno;
    }
    
    public function GetEmpleados(){
        return $this->_empleados;
    }
    public function CalcularSueldos(){
        $sueldos = 0;
        foreach($this->_empleados as $empleado){
            $sueldos += $empleado->GetSueldo();
        }
        return $sueldos;
    }

    public function EliminarEmpleado($emp){
        $retorno = false;
        for($i = 0; $i <= count($this->_empleados); $i++){
            if(is_a($this->_empleados[$i],'Empleado') && !is_null($this->_empleados[$i])){
                if($emp->GetLegajo() == $this->_empleados[$i]->GetLegajo()){
                    unlink(trim($this->_empleados[$i]->GetPathFoto()));
                    unset($this->_empleados[$i]);
                    $retorno = true;
                }
            }
        }
        return $retorno;
    }

    private function EliminarEmpleadoRepetido(){
        return array_unique($this->_empleados, SORT_REGULAR);
    }
    
    public function ToString(){
        $retorno = "";
        foreach($this->_empleados as $empleado){
           if(is_a($empleado,'Empleado')) $retorno =$retorno. $empleado->ToString()."<br/>";
        }
        return $retorno;
    }

    public function GuardarEnArchivo($nombreDeArchivo){
        if(file_exists("./Archivos/".$nombreDeArchivo)){
            unlink("./Archivos/".$nombreDeArchivo);
            $archivo = fopen("./Archivos/".$nombreDeArchivo,"a+");
        }elseif(file_exists("./Archivos/")){
            $archivo = fopen("./Archivos/".$nombreDeArchivo,"a+");
        }
        if(file_exists("../Archivos/".$nombreDeArchivo)){
            unlink("../Archivos/".$nombreDeArchivo);
            $archivo = fopen("../Archivos/".$nombreDeArchivo,"a+");
        }elseif(file_exists("../Archivos/")){            
            $archivo = fopen("../Archivos/".$nombreDeArchivo,"a+");
        }
        foreach($this->_empleados as $empleado){
           if(is_a($empleado,'Empleado'))  $escribio = fwrite($archivo,trim($empleado->ToString())."\n");
        }       
        fclose($archivo); 
    }

    public function TraerDeArchivo($nombreDeArchivo){
            if(file_exists("./Archivos/".$nombreDeArchivo)){
                $archivo = fopen("./Archivos/".$nombreDeArchivo,"rb");
            }
            if(file_exists("../Archivos/".$nombreDeArchivo)){
                $archivo = fopen("../Archivos/".$nombreDeArchivo,"rb");
            }
           // echo "../Archivos/".$nombreDeArchivo;
            if($archivo != null){
                while(!feof($archivo) && $archivo != null){
                    $linea = trim(fgets($archivo));
                    $arrayLinea = explode("-",$linea);
                    if(isset($arrayLinea[1])){
                     /*   echo $arrayLinea[0] . "-". $arrayLinea[1] . "-". 
                        $arrayLinea[2] . "-". $arrayLinea[3] . "-". 
                        $arrayLinea[4] . "-". $arrayLinea[5] . "-". $arrayLinea[6];*/
                        $empleado = new Empleado($arrayLinea[0],$arrayLinea[1],
                            $arrayLinea[2],$arrayLinea[3],$arrayLinea[4],$arrayLinea[5],$arrayLinea[6]);
                        $empleado->SetPathFoto($arrayLinea[7]);
                        $this->AgregarEmpleado($empleado);
                    }
                }
                fclose($archivo);
            }
    }
}