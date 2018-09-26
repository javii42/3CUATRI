<?php

if(file_exists("../Entidades/Persona.php")) include_once "../Entidades/Persona.php";
if(file_exists("./Entidades/Persona.php")) include_once "./Entidades/Persona.php";

class Empleado extends Persona{
    protected $_legajo;
    protected $_sueldo;
    protected $_turno;

    public function __construct($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno){
        parent::__construct($nombre,$apellido,$dni,$sexo);
        $this->_legajo = $legajo;
        $this->_sueldo = $sueldo;
        $this->_turno = $turno;
    }

    public function GetLegajo(){
        return $this->_legajo;
    }
    public function GetSueldo(){
        return $this->_sueldo;
    }
    public function GetTurno(){
        return $this->_turno;
    }

    public function Hablar($idiomas){
        $c = 0;
        $retorno = "El empleado ".$this->GetNombre()." habla: ";
        foreach($idiomas as $idioma){
            if($c==0){
                $retorno = $retorno . $idioma;
            }else{                
                $retorno = $retorno .", ". $idioma;
            }
            $c++;
        }
        return $retorno .".";
    }

    public function ToString(){
        return parent::ToString()."-".$this->GetLegajo()."-".$this->GetSueldo()."-".$this->GetTurno();
    }

}