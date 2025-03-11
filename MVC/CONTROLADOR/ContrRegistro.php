<?php
session_start();
$_SESSION['dato'] = "Administrador";

include("../MODELO/Modelo.php");

$i = new Usuario();

$R = $i -> REGISTRO($_POST);

if(empty($R))
{
    echo '<script>alert("El registro fue exitoso")</script>' ;
    include '../VISTA/form-regist.html';
}
else{
    echo $R;
}
?>
