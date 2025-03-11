<?php

include("../MODELO/Modelo.php");

$instancia = new Usuario();

$matriz = $instancia -> CONSULTAR_CITA($_POST);

include ("../VISTA/form-consul-cita.html");

echo '<script>alert("La consulta fue exitosa")</script>';

echo "<table><thead><tr style='border:1px solid gray;'>
<th>id_cita</th><th>ceduladoctor</th><th>codigo_agenda</th>
<th>cedula_paciente</th><th>nombres</th><th>apellidos</th><th>estadousuario</th>
<th>fecha_atencion</th><th>hora_atencion</th><th>valor</th><th>consultorio</th>
<th>motivo</th></tr></thead><style>
table{backround-color:white; text-aling:left; border-collapse:collappse; width:100%;}
th,td{padding:20px;}
thead{
background-color:rgba(187, 211, 8, 0.65); 
border-bottom:solid 3px #0F362D; 
color:white;}
tr:nth-child(even){
    background-color:#ddd;}
</style>";
 
foreach($matriz as $fi)
{

    echo "<tbody><tr>";

    foreach($fi as $co)
    {
        echo "<td style='border:1px solid gray;'>$co</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

 ?>
 