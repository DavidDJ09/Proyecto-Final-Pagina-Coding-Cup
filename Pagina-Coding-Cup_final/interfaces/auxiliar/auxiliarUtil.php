<?php


    $auxiliar=new Auxiliar();
       

    $valNombre=$valApe1=$valApe2=$valEmail=$valTipo=$valPassword=$valPassword2="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la info del usuario con ese id
        $dao=new DAOAuxiliar();
        $auxiliar=$dao->obtenerUno($_POST["id"]);
    }elseif(count($_POST)>1){
        $valNombre=$valApe1=$valApe2=$valEmail=$valTipo=$valPassword=$valPassword2="is-invalid";
        $valido=true;
        if(ISSET($_POST["Nombre"]) && 
          (strlen(trim($_POST["Nombre"]))>3 && strlen(trim($_POST["Nombre"]))<51) &&
            preg_match("/^[a-zA-Z.\s]+$/",$_POST["Nombre"])){
            $valNombre="is-valid";
        }else{
            $valido=false;
        }
        if(ISSET($_POST["Apellido1"]) && 
          (strlen(trim($_POST["Apellido1"]))>3 && strlen(trim($_POST["Apellido1"]))<51) &&
            preg_match("/^[a-zA-Z.\s]+$/",$_POST["Apellido1"])){
            $valApe1="is-valid";
        }else{
            $valido=false;
        }
        if(ISSET($_POST["Apellido2"]) && 
          (strlen(trim($_POST["Apellido2"]))==0) ||
          (strlen(trim($_POST["Apellido2"]))>3 && strlen(trim($_POST["Apellido2"]))<51) &&
            preg_match("/^[a-zA-Z.\s]+$/",$_POST["Apellido2"])){
            $valApe2="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["Email"]) && 
            filter_var($_POST["Email"],FILTER_VALIDATE_EMAIL)){
            $valEmail="is-valid";
        }else{
            $valido=false;
        }
        

         // Validar la contraseña solo si se está registrando un nuevo usuario o si se está editando y la contraseña no está vacía
    
        if (isset($_POST["Password"]) &&
            (strlen(trim($_POST["Password"])) >= 6 && strlen(trim($_POST["Password"])) < 16)) {
            $valPassword = "is-valid";
        } else {

            if (empty($_POST["Password"])) {
                // Conservar la contraseña anterior al editar solo si el campo de contraseña está vacío
                if ($_POST['operation'] === 'edit'){
                    $dao = new DAOAuxiliar();
                    $auxiliar = $dao->obtenerUno($_POST["iden"]);
                    $_POST["Password"] = $auxiliar->pass;
                    $valPassword = "is-valid"; // Marcar como válida porque se conserva la contraseña existente
                }                
            } else {
                $valido = false;
            }
        }
         
        if (ISSET($_POST["Password2"]) && 
            (strlen(trim($_POST["Password2"])) >= 6 && strlen(trim($_POST["Password2"])) < 16) &&
            $_POST["Password"] === $_POST["Password2"]) {
            $valPassword2 = "is-valid";
        } else {
            if (empty($_POST["Password2"])) {
                if ($_POST['operation'] === 'edit'){
                    // Conservar la contraseña anterior al editar solo si el campo de contraseña está vacío
                    $dao = new DAOAuxiliar();
                    $auxiliar = $dao->obtenerUno($_POST["iden"]);
                    $_POST["Password2"] = $auxiliar->pass;
                    $valPassword2 = "is-valid"; // Marcar como válida porque se conserva la contraseña existente
                }
            } else {
                $valido = false;
            }
        }


        if (ISSET($_POST["Tipo"]) && ($_POST["Tipo"] !=0)) {
            $valTipo = "is-valid";
        } else {
            $valido = false;
        }    

        $auxiliar->id=ISSET($_POST["Id"])?trim($_POST["Id"]):0;
        $auxiliar->nombre=ISSET($_POST["Nombre"])?trim($_POST["Nombre"]):"";
        $auxiliar->apellido1=ISSET($_POST["Apellido1"])?trim($_POST["Apellido1"]):"";
        $auxiliar->apellido2=ISSET($_POST["Apellido2"])?trim($_POST["Apellido2"]):"";        
        $auxiliar->email=ISSET($_POST["Email"])?$_POST["Email"]:"";        
        $auxiliar->tipo=ISSET($_POST["Tipo"])?$_POST["Tipo"]:"";
        $auxiliar->password=ISSET($_POST["Password"])?$_POST["Password"]:"";        

      //editar
      $auxiliar->id=$_POST['iden'];

      if($valido){
          $dao= new DAOAuxiliar();
          // Verificar operacion a realizar
          if ($_POST['operation'] === 'edit') {
              // Editar
             
              $auxiliar->id=$_POST['iden'];
              

              if(empty($_POST["Password"])){
                $auxiliar=$dao->obtenerUno($_POST["iden"]);
                $pass= $auxiliar->pass;                  
                  $auxiliar->pass=$pass;

              }
              if ($dao->editar($auxiliar) == false) {
                $valEmail = "is-invalid";
                $_SESSION["msj"]="danger-Correo electronico ya en uso";
                $_POST["Email"]="";
                
                  if($_POST['operation'] === 'edit'){
                      $_POST["id"]=$auxiliar->id;
                  }
                  
              } else {
                  header("Location: tablaAuxiliar.php");
              }
          } else {
              // Agregar
              //var_dump($_POST);
              if ($dao->agregar($auxiliar) == 0) {
                $valEmail = "is-invalid";
                $_SESSION["msj"]="danger-Correo electronico ya en uso";
                
              } else {
                  header("Location: tablaAuxiliar.php");
              }
          }
      }else{
          if($_POST['operation'] === 'edit'){
              $_POST["id"]=$auxiliar->id;
          }
          //$_POST["id"]=$equipo->id;
      }

  }

  
  if(ISSET($_SESSION["msj"])){
    $mensaje=explode("-",$_SESSION["msj"]);
  ?>
  <div id="mensajes" class="alert alert-<?=$mensaje[0]?>">
      <?=$mensaje[1]?>
  </div>
  <script>
    // Agrega un script para ocultar el mensaje después de 3 segundos
    setTimeout(function(){
        document.getElementById('mensajes').style.display = 'none';
    }, 3000);
  </script>
  <?php
    UNSET($_SESSION["msj"]);
  }

?>