<?php
    $equipo=new Equipo();

    $valNombre=$valEstu1=$valEstu2=$valEstu3=$valFoto1=$valFoto2=$valFoto3="";

    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la info del usuario con ese id
        $dao=new DAOEquipo();
        $equipo=$dao->obtenerUno($_POST["id"]);

    }elseif(count($_POST)>1){
        $valNombre=$valEstu1=$valEstu2=$valEstu3=$valFoto1=$valFoto2=$valFoto3="is-invalid";
        $valido=true;
        if(ISSET($_POST["Nombre"]) && 
            (strlen(trim($_POST["Nombre"]))>=5 && strlen(trim($_POST["Nombre"]))<70)){
                $valNombre="is-valid";
        }else{
        $valido=false;
        }

        if(ISSET($_POST["Estu1"]) &&
            (mb_strlen(trim($_POST["Estu1"])) > 6 && mb_strlen(trim($_POST["Estu1"])) < 71) &&
            preg_match("/^[\p{L}.\s]+$/u", $_POST["Estu1"])){
                $valEstu1="is-valid";
        }else{
        $valido=false;
        }

        if(ISSET($_POST["Estu2"]) &&
            (mb_strlen(trim($_POST["Estu2"])) > 6 && mb_strlen(trim($_POST["Estu2"])) < 71) &&
            preg_match("/^[\p{L}.\s]+$/u", $_POST["Estu2"])){
                $valEstu2="is-valid";
        }else{
        $valido=false;
        }

        if(ISSET($_POST["Estu3"]) &&
            (mb_strlen(trim($_POST["Estu3"])) > 6 && mb_strlen(trim($_POST["Estu3"])) < 71) &&
            preg_match("/^[\p{L}.\s]+$/u", $_POST["Estu3"])){
                $valEstu3="is-valid";
        }else{
        $valido=false;
        }

        //$obj = new Equipo();
            $equipo->nombre=ISSET($_POST["Nombre"])?trim($_POST["Nombre"]):"";
            $equipo->integrante1=ISSET($_POST["Estu1"])?trim($_POST["Estu1"]):"";
            $equipo->integrante2=ISSET($_POST["Estu2"])?trim($_POST["Estu2"]):"";
            $equipo->integrante3=ISSET($_POST["Estu3"])?trim($_POST["Estu3"]):"";
            $equipo->estatus="No Aprobado";
            $equipo->id_couch=$_POST["id_couch"];
            $equipo->institucion=$_POST["institucion"];
        
        //editar
        $equipo->id=$_POST['iden'];


        if($valido){
            $dao= new DAOEquipo();
            // Verificar operacion a realizar
            if ($_POST['operation'] === 'edit') {
                // Editar
                $equipo->id=$_POST['iden'];
                if ($dao->editar($equipo) == false) {
                    echo "Error al editar";
                    if($_POST['operation'] === 'edit'){
                        $_POST["id"]=$equipo->id;
                    }
                } else {
                    header("Location: tablaEquipos.php");
                }
            } else {
                // Agregar
                //var_dump($_POST);
                if ($dao->agregar($equipo) == 0) {
                    echo "Error al guardar";
                } else {
                    header("Location: tablaEquipos.php");
                }
            }
        }else{
            if($_POST['operation'] === 'edit'){
                $_POST["id"]=$equipo->id;
            }
            //$_POST["id"]=$equipo->id;
        }

    }
?>