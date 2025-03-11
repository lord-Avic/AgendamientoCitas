<?php

include("../MODELO/Modelo.php");

$instance = new Usuario();

$matrz = $instance -> CONSULTAR_AGENDA($_POST);

include ("../VISTA/form-consul-agenda.html");

echo '<script>alert("La consulta fue exitosa")</script>';

echo "<table><thead><tr style='border:1px solid gray;'>
<th>codigoagenda</th><th>ceduladoctor</th><th>id_cita</th>
<th>cedula_paciente</th><th>nombres</th><th>apellidos</th><th>hora_atencion</th>
<th>fecha_atencion</th><th>consultorio</th><th>motivo</th></tr></thead><style>
table{backround-color:white; text-aling:left; border-collapse:collappse; width:100%;}
th,td{padding:20px;}
thead{
background-color:rgba(187, 211, 8, 0.65); 
border-bottom:solid 3px #0F362D; 
color:white;}
tr:nth-child(even){
    background-color:#ddd;}
</style>";

foreach($matrz as $f)
{

    echo "<tbody><tr>";

    foreach($f as $c){
        echo "<td style='border:1px solid gray;'>$c</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

 ?>
 