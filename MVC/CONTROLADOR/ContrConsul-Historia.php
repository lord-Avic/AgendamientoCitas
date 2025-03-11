<?php

include("../MODELO/Modelo.php");

$instan = new Usuario();

$mtriz = $instan -> CONSULTAR_HISTORIA($_POST);

include ("../VISTA/form-consul-historia.html");

echo '<script>alert("la identificacion o la contraseña no coinciden")</script>';

echo "<table><thead><tr style='border:1px solid gray;'>
<th>id_historialclinico</th><th>cedula</th><th>nombres</th>
<th>apellidos</th><th>rol</th><th>estatura</th><th>peso</th>
<th>enfermedad_padecida</th><th>alergia</th><th>Thistorial_tratamiento</th></tr></thead><style>
table{backround-color:white; text-aling:left; border-collapse:collappse; width:100%;}
th,td{padding:20px;}
thead{
background-color:rgba(187, 211, 8, 0.65); 
border-bottom:solid 3px #0F362D; 
color:white;}
tr:nth-child(even){
    background-color:#ddd;}
</style>";

foreach($mtriz as $fil)
{

    echo "<tbody><tr>";

    foreach($fil as $col){
        echo "<td style='border:1px solid gray;'>$col</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

 ?>