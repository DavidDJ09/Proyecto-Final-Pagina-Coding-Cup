<?php
    $concurso=new Concurso();

    function validateDate($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    $valNombre=$valFechaInicio=$valFechaLimite="";

    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la info del usuario con ese id
        $dao=new DAOConcurso();
        $concurso=$dao->obtenerUno($_POST["id"]);

    }elseif(count($_POST)>1){
        
        $valNombre=$valFechaInicio=$valFechaLimite="is-invalid";
        $valido=true;

        if(ISSET($_POST["Nombre"]) && 
          (strlen(trim($_POST["Nombre"]))>2 && strlen(trim($_POST["Nombre"]))<51)){
            $valNombre="is-valid";
        }else{
            $valido=false;
        }
        if(ISSET($_POST["FechaInicio"]) && validateDate($_POST["FechaInicio"])){
            $fInicio=DateTime::createFromFormat('Y-m-d', $_POST["FechaInicio"]);
            $h = new DateTime();
            $dif = $h->diff($fInicio)->y;
            $valFechaInicio="is-valid";
        }else{
            $valido=false;
        }
        if(ISSET($_POST["FechaLimite"]) && validateDate($_POST["FechaLimite"])){
            $fLimite=DateTime::createFromFormat('Y-m-d', $_POST["FechaLimite"]);
            $h = new DateTime();
            $dif = $h->diff($fLimite)->y;
            $valFechaLimite="is-valid";
        }else{
            $valido=false;
        }
        
        $concurso->nombre=ISSET($_POST["Nombre"])?trim($_POST["Nombre"]):"";
        $concurso->fechaInicio=ISSET($_POST["FechaInicio"])?DateTime::createFromFormat('Y-m-d', $_POST["FechaInicio"]):new DateTime();
        $concurso->fechaLimite=ISSET($_POST["FechaLimite"])?DateTime::createFromFormat('Y-m-d', $_POST["FechaLimite"]):new DateTime();
        $concurso->estatus="Inactivo";

        //editar
        $concurso->id=$_POST['iden'];

        if($valido){
            //Crear un modelo Usuario con todos los datos
            $dao= new DAOConcurso();

            // Verificar operacion a realizar
            if ($_POST['operation'] === 'edit') {
                // Editar
                
                $concurso->id=$_POST['iden'];
                if ($dao->editar($concurso) == false) {
                    echo "Error al editar";
                    if($_POST['operation'] === 'edit'){
                        $_POST["id"]=$concurso->id;
                    }
                } else {
                    header("Location: Concursos.php");
                }
            } else {
                // Agregar
                if ($dao->agregar($concurso) == 0) {
                    echo "Error al guardar";
                } else {
                    header("Location: Concursos.php");
                }
            }
        }else{
            if($_POST['operation'] === 'edit'){
                $_POST["id"]=$concurso->id;
            }
            //$_POST["id"]=$concurso->id;
        }

      }
?>