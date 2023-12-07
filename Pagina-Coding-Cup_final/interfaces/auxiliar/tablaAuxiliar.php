<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de registro para administradores</title>    
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../dt/Buttons-2.4.2/css/buttons.bootstrap5.min.css">

    <style>
        .btn-verde{
            background-color: rgb(8, 218, 148)!important;
        }
    </style>
</head>
<body>
<body>
      <?php
        session_start();
        if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != 1) {
          header("Location: ../index.html");
          exit();
        } 

        require('menuAuxiliar.php');
        require_once('../../datos/daoAuxiliar.php');
        $dao=new DAOAuxiliar();


        if(ISSET($_POST["id"]) && is_numeric($_POST["id"])){
          //Eliminar
          if($dao->eliminar($_POST["id"])){
            $_SESSION["msj"]="success-El usuario ha sido eliminado correctamente";
          }else{
            $_SESSION["msj"]="danger-No se ha podido eliminar el usuario seleccionado";
          }
        }
        $listaUsuarios=$dao->obtenerTodos();
      ?>

      <div class="container">
        <?php
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
        <a class="btn btn-success mt-5 mb-3" href="registroAuxiliar.php">Agregar</a>
        <table id="lista" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
              <?php
                
                foreach ($listaUsuarios as $auxiliar){
                  $nombreUsuario = trim($auxiliar->nombre . " " . $auxiliar->apellido1) . " " . $auxiliar->apellido2;
                  echo "<tr><td>".trim($auxiliar->nombre." ".$auxiliar->apellido1)." ".$auxiliar->apellido2."</td>".
                           "<td>".$auxiliar->email."</td>".
                           "<td>".$auxiliar->tipo."</td>".                            
                           "<td><form method='post'>".
                               "<button formaction='registroAuxiliar.php' class='btn btn-primary' name='id' value='".$auxiliar->id."'>Editar</button>".                               
                               "<button type='button' class='btn btn-danger' onclick='confirmar(this)' name='id' value='".$auxiliar->id."'>Eliminar</button>".
                               "</form></td></tr>";
                   }
                 ?>
                   
               </tbody>
           </table>
       </div>
       <div class="modal" id="mdlConfirmacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-danger text-white">
               <h5 class="modal-title">Confirmar eliminación</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               <p>Está a punto de eliminar a <strong id="spnPersona"></strong> 
                  ¿Desea continuar?</p>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
               <form action="" method="post">
              <button class="btn btn-danger" data-bs-dismiss="modal" id="btnConfirmar" name="id">Si, continuar con la eliminación</button>
            </form>
             </div>
           </div>
         </div>
       </div>
  
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
    <script src="../dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="../dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script src="../dt/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="../dt/JSZip-3.10.1/jszip.min.js"></script>
    <script src="../dt/pdfmake-0.2.7/pdfmake.min.js"></script>
    <script src="../dt/pdfmake-0.2.7/vfs_fonts.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.html5.min.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.print.min.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.colVis.min.js"></script>
    <script src="../js/registroAuxiliar.js"></script>
</body>
</html>