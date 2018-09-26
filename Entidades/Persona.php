<?php
abstract class Persona{
    private $_apellido;
    private $_nombre;
    private $_dni;
    private $_sexo;

    public function __construct($nombre,$apellido,$dni,$sexo){
        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_dni = $dni;
        $this->_sexo = $sexo;
    }
    
    public function GetApellido(){
        return $this->_apellido;
    }

    public function GetDni(){
        return $this->_dni;
    }

    public function GetNombre(){
        return $this->_nombre;
    }
    
    public function GetSexo(){
        return $this->_sexo;
    }
    
    public abstract function Hablar($idiomas);

    public function ToString(){
        return $this->GetApellido()."-".$this->GetNombre()."-".$this->GetDni()."-".$this->GetSexo();
    }

}