<?php 
    function validarSesion(){
        session_start();
        if(!$_SESSION["DNIEmpleado"]){
            return false;
        }else{
            return true;
         }

    }

?>