<?php
    session_start();
    if($_SESSION["DNIEmpleado"]){
        session_destroy();
    }
    header('Location: ../index.php');
?>