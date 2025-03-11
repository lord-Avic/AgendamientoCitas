<?php

session_start();
$_SESSION['dato'] = 0;

include "../MODELO/Modelo.php";

$i = new Usuario();

$retornado = $i -> ACCESO($_POST);

if(is_array($retornado))
{
    if($retornado[0] == "Administrador")
    {
        $_SESSION['dato'] = "Administrador";
        include '../VISTA/Administrador.html';
    }
    else if($retornado[0] == "Paciente")
    {
        $_SESSION['dato'] = "Paciente";
        echo '<script>alert("El usuario es Paciente")</script>';
        include "../VISTA/form-inicio";
    }
    else if($retornado[0] == "Doctor")
    {
        $_SESSION['dato'] = "Doctor";
        echo '<script>alert("El Usuario es Doctor")</script>';
        include "../VISTA/form-inicio";
    }
}
else
{
    echo '<script>alert("la identificacion o la contraseña no coinciden")</script>' ;
    include '../VISTA/form-inicio.html';
}
?>