<?php

Class Usuario
{
    public function REGISTRO ($datos)
    {
       try{
        include "conexion.php";   
        $registro = $conexion -> prepare("CALL RegistrarUsuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $registro -> bindParam(1, $datos['4'], PDO::PARAM_INT);
            $registro -> bindParam(2, $datos['2']);
            $registro -> bindParam(3, $datos['3']);
            $registro -> bindParam(4, $datos['6']);
            $registro -> bindParam(5, $datos['7']);
            $registro -> bindParam(6, $datos['8']);
            $registro -> bindParam(7, $datos['10']);
            $registro -> bindParam(8, $datos['11']);
            $registro -> bindParam(9, $datos['12']);
            $registro -> bindParam(10, $datos['13']);
            $registro -> bindParam(11, $datos['15']);
            $registro -> bindParam(12, $datos['1']);
            $registro -> bindParam(13, $datos['14']);
            $registro -> bindParam(14, $datos['5']);
            $registro -> bindParam(15, $datos['9']);
            $registro -> execute();
            $R = $registro -> fetch();
            return $R;
           }
        catch(Exception $e){
          return $e->getMessage();
        }
    }
    public function ACCESO ($datos)
    {
        try{
        include "conexion.php";   
        $acceso = $conexion -> prepare("CALL AccesoUsuarios(?,?)");
        $acceso -> bindParam(1, $datos['t1']);
        $acceso -> bindParam(2, $datos['t2']);
        $acceso -> execute();
        $D = $acceso -> fetch();
        return $D;      
        }
        catch(Exception $e){
            return $e ->getMessage();
        }
    }
    public function CONSULTAR($identificacion)
    {
           include "conexion.php";
           $consulta = $conexion -> prepare("CALL ConsultaUsuarios(?)");
           $consulta -> bindParam(1, $identificacion['txt1']);
           $consulta->execute();+
           $valores = $consulta -> fetchAll(PDO::FETCH_ASSOC); //convierte array unica fila dev uelta
           return $valores; 
    }
    public function CONSULTAR_ROL($rol)
    {
        include "conexion.php";
        $consulrol = $conexion -> prepare("CALL ConsultaRol(?)");
        $consulrol->bindParam(1, $rol['txt1']);
        $consulrol->execute();
        $matriz = $consulrol->fetchALL(PDO::FETCH_ASSOC); //convierte array unica todos los valores devueltos en una matriz
        return $matriz; 
    }
    public function CONSULTAR_HISTORIA($documento)
    {
           include "conexion.php";
           $consultaH = $conexion-> prepare("CALL ConsultaHistoria(?)");                                                                                                                                          
           $consultaH->bindParam(1, $documento['txt1']);
           $consultaH->execute();
           $valor = $consultaH->fetchALL(PDO::FETCH_ASSOC); //convierte array unica fila dev uelta
           return $valor; 
    }
    public function CONSULTAR_AGENDA($identificacions)
    {
           include "conexion.php";
           $consultaA = $conexion -> prepare("CALL ConsultaAgenda(?)");
           $consultaA->bindParam(1, $identificacions['txt1']);
           $consultaA->execute();
           $val = $consultaA -> fetchAll(PDO::FETCH_ASSOC); //convierte array unica fila dev uelta
           return $val; 
    }
    public function CONSULTAR_CITA($rol)
    {
        include "conexion.php";
        $consulC = $conexion -> prepare("CALL ConsultaCita(?)");
        $consulC->bindParam(1, $rol['txt1']);
        $consulC->execute();
        $matriz = $consulC->fetchALL(PDO::FETCH_ASSOC); //convierte array unica todos los valores devueltos en una matriz
        return $matriz; 
    }
                                                                                                                                                        
    // public function TODO()
    // {
    //     try{
    //     include "conexion.php";   
    //     $Todo = $conexion -> prepare("CALL AccesoUsuarios()");
    //     $Todo -> execute();
    //     $T = $Todo -> fetchAll(PDO::FETCH_ASSOC);
    //     return $T;      
    //     }
    //     catch(Exception $e){
    //         return $e ->getMessage();
    //     }
    // }
    // public function ActualizarUsuario($datos)
    // {
    //     try{
    //     include "conexion.php";   
    //     $update = $conexion -> prepare("CALL ConsultarCedula(?)");
    //     $update -> bindParam(1, $datos['4'], PDO::PARAM_INT);
    //     $update -> execute();
    //     $A = $update -> fetch();
    //     echo $A;
    //     return $A;
    //     }
    //     catch(Exception $e){
    //     return $e->getMessage();
    //     }
    //     if($encontrado){
    //     try{
    //         include "conexion.php";   
    //             $update = $conexion -> prepare("CALL ActualizarUsuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    //             $update -> bindParam(1, $datos['4'], PDO::PARAM_INT);
    //             $update -> bindParam(2, $datos['2']);
    //             $update -> bindParam(3, $datos['3']);
    //             $update -> bindParam(4, $datos['6']);
    //             $update -> bindParam(5, $datos['7']);
    //             $update -> bindParam(6, $datos['8']);
    //             $update -> bindParam(7, $datos['10']);
    //             $update -> bindParam(8, $datos['11']);
    //             $update -> bindParam(9, $datos['12']);
    //             $update -> bindParam(10, $datos['13']);
    //             $update -> bindParam(11, $datos['15']);
    //             $update -> bindParam(12, $datos['1']);
    //             $update -> bindParam(13, $datos['14']);
    //             $update -> bindParam(14, $datos['5']);
    //             $update -> bindParam(15, $datos['9']);
    //             $update -> execute();
    //             $U = $update -> fetch();
    //             echo $U;
    //             return $U;
    //         }
    //         catch(Exception $e){
    //         return $e->getMessage();
    //         }
    //     }
    // }
    public function ELIMINAR ( )
    {
        
    }

} 

?>