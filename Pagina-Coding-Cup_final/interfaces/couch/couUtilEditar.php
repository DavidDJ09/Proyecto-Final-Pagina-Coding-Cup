<?php
    $cou=new Couch();

    $valnombreCompleto=$valusername=$valinstitucion="";
    
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la info del usuario con ese id
        $dao=new DAOCou();

        $cou=$dao->obtenerUno($_POST["id"]);
        
    }elseif(count($_POST)>1){

        $valnombreCompleto=$valusername=$valinstitucion="is-invalid";
        $valido=true;

        if(ISSET($_POST["nombreCompleto"]) &&
        (mb_strlen(trim($_POST["nombreCompleto"])) > 6 && mb_strlen(trim($_POST["nombreCompleto"])) < 150) &&
        preg_match("/^[\p{L}.\s]+$/u", $_POST["nombreCompleto"])
          ){
            $valnombreCompleto="is-valid";
        }else{
            $valido=false;
        }


        if(ISSET($_POST["username"]) && 
        filter_var($_POST["username"],FILTER_VALIDATE_EMAIL)){
        $valusername="is-valid";
        }else{
            $valido=false;
        }


        if(ISSET($_POST["institucion"]) &&
            (mb_strlen(trim($_POST["institucion"])) > 4 && mb_strlen(trim($_POST["institucion"])) < 150) &&
            preg_match("/^[\p{L}.\s]+$/u", $_POST["institucion"])){
            $valinstitucion="is-valid";
        }else{
            $valido=false;
        }

            //$cou=new Couch();
            $cou->nombreCompleto=ISSET($_POST["nombreCompleto"])?trim($_POST["nombreCompleto"]):"";
            $cou->username=ISSET($_POST["username"])?trim($_POST["username"]):"";
            $cou->institucion=ISSET($_POST["institucion"])?trim($_POST["institucion"]):"";


            //editar
        // $cou->id=$_POST['iden'];

        if($valido){
            $dao= new DAOCou();
            // Verificar operacion a realizar
            if ($_POST['operation'] === 'edit') {
                // Editar
                $cou->id=$_POST['iden'];
                if ($dao->editar($cou) == false) {
                    echo "Error al editar";
                    if($_POST['operation'] === 'edit'){
                        $_POST["id"]=$cou->id;
                    }
                } else {
                    header("Location: tabladecou copy.php");
                }
            } else {
                // Agregar
                //var_dump($_POST);
                if ($dao->agregar($equipo) == 0) {
                    echo "Error al guardar";
                } else {
                    header("Location: ../index.html");
                }
            }
        }else{
            if($_POST['operation'] === 'edit'){
                $_POST["id"]=$cou->id;
            }
            //$_POST["id"]=$equipo->id;
        }
       }
?>