<?php
    require_once('../datos/DAOAuxiliar.php');
    require_once('../datos/DAOCou2.php');
    
    //Verificar que llegan datos
    if(ISSET($_POST["correo"]) && ISSET($_POST["password"])){
        //Conectarme y buscar auxiliar
        $dao=new DAOAuxiliar();
        $auxiliar=$dao->autenticar($_POST["correo"],$_POST["password"]);

        $dao=new DAOCou2();
        $usuario=$dao->autenticar($_POST["correo"],$_POST["password"]);
        
    // Después de autenticar
    if($auxiliar){
        session_start();
        $_SESSION["usuario"] = $auxiliar->id;
        $_SESSION["nombre"] = $auxiliar->nombre." ".$auxiliar->apellido1;
       // Asignar valores numéricos a los tipos de usuario
        switch ($auxiliar->tipo) {
            case "Administrador":
                $_SESSION["tipo"] = 1;
                header("Location: auxiliar/tablaAuxiliar.php");
                break;
            case "Auxiliar":
                $_SESSION["tipo"] = 2;
                header("Location: equipos/admonEquipos.php");
                break;
            case "Coach":
                $_SESSION["tipo"] = 3;
                break;
            default:
                $_SESSION["tipo"] = 0; // Valor predeterminado para otros tipos
        }
        return;
    }else if($usuario){
        //EL USUARIO QUE HIZO LOGIN FUE UN COACH
        session_start();
        $_SESSION["id"]=$usuario->id;
        $_SESSION["usuario"]=$usuario->username;
        $_SESSION["nombre"]=$usuario->nombreCompleto;
        $_SESSION["institucion"]=$usuario->institucion;

        header("Location: equipos/tablaEquipos.php");        
        return;
    }     
    }
    header("Location: index.html");
?>


