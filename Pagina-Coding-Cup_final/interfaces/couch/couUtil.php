<?php
    $cou=new Couch();

    $valnombreCompleto=$valusername=$valpass=$valinstitucion="";
    
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la info del usuario con ese id
        $dao=new DAOCou();

        $cou=$dao->obtenerUno($_POST["id"]);
        
    }elseif(count($_POST)>1){

        $valnombreCompleto=$valusername=$valpass=$valinstitucion="is-invalid";
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

        if(ISSET($_POST["pass"]) && (($_POST["pass"])==($_POST["pass2"])) && 
          (strlen(trim($_POST["pass"]))>=6 && strlen(trim($_POST["pass"]))<65)){
            $valpass="is-valid";
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
            $cou->pass=ISSET($_POST["pass"])?trim($_POST["pass"]):"";
            $cou->institucion=ISSET($_POST["institucion"])?trim($_POST["institucion"]):"";


            //editar
        // $cou->id=$_POST['iden'];

        if($valido){
            $dao= new DAOCou();
                if($dao->agregar($cou)==0){
                    echo "Error al guardar ";                    
                }else{
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: ../index.html");
                }

        }

        

       }
?>