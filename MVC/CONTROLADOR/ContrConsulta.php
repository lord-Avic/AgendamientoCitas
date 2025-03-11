<?php

if($_POST['txt2']=="Rol")
{
   if($_POST["txt1"] == 'Doctor' OR $_POST["txt1"] == 'Paciente' OR $_POST["txt1"] == 'Administrador' 
   OR $_POST["txt1"] == 'DOCTOR' OR $_POST["txt1"] == 'PACIENTE' OR $_POST["txt1"] == 'ADMINISTRADOR'
   OR $_POST["txt1"] == 'doctor' OR $_POST["txt1"] == 'paciente' OR $_POST["txt1"] == 'administrador')
   {
   include("../MODELO/Modelo.php");
    
   $ins = new Usuario();
    
   $mtrz = $ins -> CONSULTAR_ROL($_POST);
    
   


   include ("../VISTA/form-consul-usuario.html"); 

    echo "<table style='border:1px solid gray;'><tr style='border:1px solid gray;'><th>Cedula Usuario</th>
    <th>Nombres</th><th>Apellidos</th><th>Genero</th><th>Direccion</th>
    <th>Correo</th><th>Nombreusuario</th><th>Estadousuario</th><th>Tarjetaprofesional</th>
    <th>Especialidad</th><th>Fechanacimiento</th><th>Telefono</th></tr><style>
    table{backround-color:white; text-aling:left; border-collapse:collappse; width:100%;}
    th,td{padding:20px;}
    thead{
    background-color:rgba(187, 211, 8, 0.65); 
    border-bottom:solid 3px #0F362D; 
    color:white;}
    tr:nth-child(even){
        background-color:#ddd;}
    </style>";

    foreach($mtrz as $FILA)
    {
                      echo "<tr>";
                  foreach($FILA as $COLUMNA)
                    {
            
                      echo "<td style='border:1px solid gray;'>$COLUMNA</td>";
                    }
                      echo "</tr>";
    }
                      echo "</table>";
   }
   else
   {
      include("../VISTA/form-consul-usuario.html");
      echo "<script>alert('Lo que intenta consultar no existe')</script>";
   }        
}
else if($_POST['txt2']=='Numero documento')
{
    include ("../MODELO/Modelo.php");                 

    $inst = new Usuario();
        
    $Cr = $inst -> CONSULTAR($_POST);
        
        if (is_array($Cr))
        {
                    
            include ("../VISTA/form-consul-usuario.html"); 
        
                       echo "<table style='border:1px solid gray;'><tr style='border:1px solid gray;'><style>
                       table{backround-color:white; text-aling:left; border-collapse:collappse; width:100%;}
                       th,td{padding:20px;}
                       thead{
                       background-color:rgba(187, 211, 8, 0.65); 
                       border-bottom:solid 3px #0F362D; 
                       color:white;}
                       tr:nth-child(even){
                           background-color:#ddd;}
                       </style>";
                    foreach($Cr as $FILA)
                    {
                       echo "<tr>";
                    foreach($FILA as $COLUMNA)
                    {
                       echo "<td style='border:1px solid gray;'>$COLUMNA</td>";
                    }
                       echo "</tr>";
                    }
                       echo "</table>";       
        }
}
else
{
    echo '<script>alert("Lo que quiere consultar no es existente en la base de datos")</script>' ;
}

 ?>
