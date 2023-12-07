<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Couch</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/estilosRegistroCoach.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      body{
        background-repeat: no-repeat;
        background-size: cover;
        /* filter: blur(5px); */
        backdrop-filter: blur(200%);
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg" style="background-color: #071a83;" data-bs-theme="dark">
      <div class="container-fluid">
        <nav class="navbar">
          <div class="container-nav" style="background-color: #071a83;">                  
              <img src="src/CCUP.png" alt="Bootstrap" width="50" height="35" style="background-color: #071a83;" role="img">
            </a>
          </div>
      </nav>
        <label class="navbar-brand">Coding Cup</label>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.html">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="tablaUsuarios.html">Registros de Usuarios</a>
              </li>
          </ul>
        </div>
      </div>
  </nav>

  <pre>
        <?php
            $valNombre = $valUsername = $valServer = $valUsuario = $valpass = $valpass2 = "";
            
            if(count($_POST)>0){
              $valNombre = $valUsername = $valServer = $valUsuario = $valpass = $valpass2 = "is-invalid";
                $valido=true;
                if(ISSET($_POST["Nombre"]) && 
                    (strlen(trim($_POST["Nombre"]))>5 && strlen(trim($_POST["Nombre"]))<50) &&
                    preg_match("/^[a-zA-Z.\s]+$/",$_POST["Nombre"])){
                        $valNombre="is-valid";
                }else{
                  $valido=false;
                }

                if (isset($_POST["Username"]) && (strlen(trim($_POST["Username"])) > 5 && strlen(trim($_POST["Username"])) < 50) &&
                  preg_match("/^[a-zA-Z0-9\s]+$/", $_POST["Username"])) {
                  $valUsername = "is-valid";
                } else {
                    $valido = false;
                }


              if (isset($_POST["Server"]) && (strlen(trim($_POST["Server"])) > 2 && strlen(trim($_POST["Server"])) < 50)) {
                $valServer = "is-valid";
              } else {
                  $valido = false;
              }
          
              if (isset($_POST["Usuario"]) && (strlen(trim($_POST["Usuario"])) > 5 && strlen(trim($_POST["Usuario"])) < 50) &&
              preg_match("/^[a-zA-Z0-9\s]+$/", $_POST["Usuario"])) {
              $valUsuario = "is-valid";
              } else {
                  $valido = false;
              }

              if (isset($_POST["pass1"]) && (strlen(trim($_POST["pass1"])) > 5 && strlen(trim($_POST["pass1"])) < 50) &&
              preg_match("/^[\p{L}\p{N}\s\S]+$/u", $_POST["pass1"])) {
              $valpass = "is-valid";
              } else {
                  $valido = false;
              }
              
              if (isset($_POST["pass2"]) && (strlen(trim($_POST["pass2"])) > 5 && strlen(trim($_POST["pass2"])) < 50) &&
              preg_match("/^[\p{L}\p{N}\s\S]+$/u", $_POST["pass2"]) && $_POST["pass1"] === $_POST["pass2"]) {
              $valpass2 = "is-valid";
              } else {
                  $valido = false;
              }
            }
        ?>
    </pre>


    <form action="" class="mx-auto p-2 needs-validation mt-3" novalidate="" style="width: 50%" method="post">

       <h1>Registrar Administrador</h1>
        <div class="mt-3">
            * Nombre completo: <span id="spnClave"></span>
        </div>
        <div>
            <input type="text" name = "Nombre" required minlength = "5" maxlength = "50" id="txtNombre" class="form-control <?=$valNombre?>" 
            value="<?php echo ISSET($_POST["Nombre"])?$_POST["Nombre"]:"" ?>" placeholder="Nombre" >
            <div id="validationServer01Feedback" class="invalid-feedback">
                    <ul>
                        <li>El nombre del administrador es obligatorio</li>
                        <li>Longitud mínima de 5 caracteres</li>
                        <li>Solo caracteres alfabéticos</li>
                    </ul>                 
              </div>
        </div>

        
      <div class="mt-3">
    <label for="txtUsername">* Correo:</label>
    <div class="row">
        <div class="col">
            <input type="text" name="Username" required minlength="5" maxlength="50" id="txtUsername" class="form-control <?=$valUsername?>" 
            value="<?php echo ISSET($_POST["Username"]) ? $_POST["Username"] : "" ?>" placeholder="Correo" aria-label="Username">
            <div id="validationServer02Feedback" class="invalid-feedback">
                <ul>
                    <li>El nombre nombre de usuario es obligatorio</li>
                    <li>Longitud mínima de 5 caracteres</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <span class="input-group-text">@</span>
                <input type="text" name="Server" required minlength="2" maxlength="10" id="txtServer" class="form-control <?=$valServer?>" 
                value="<?php echo ISSET($_POST["Server"]) ? $_POST["Server"] : "" ?>" placeholder="Server" aria-label="Server">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <ul>
                        <li>La extensión del correo electrónico es obligatoria</li>
                        <li>Longitud mínima de 2 caracteres</li>
                    </ul>
                </div>
            </div>
        </div>
      </div>
    </div>    
   
        <div class="mt-3">* Usuario:
            <div>
              <input type="text" name = "Usuario" required minlength = "5" maxlength = "50" id="txtUsuario" class="form-control <?=$valUsuario?>" 
              value="<?php echo ISSET($_POST["Usuario"])?$_POST["Usuario"]:"" ?>" placeholder="Usuario">
              <div id="validationServer04Feedback" class="invalid-feedback">
                      <ul>
                          <li>El nombre de usuario es obligatorio</li>
                          <li>Longitud mínima de 5 caracteres</li>
                      </ul>                 
              </div>
            </div> 
        </div>
        
          
        <div class="row mt-3">
            <div class="col mt-3">
                * Contraseña
                <input type="password" name = "pass1" required minlength = "8" maxlength = "50" id="txtpass1" class="form-control <?=$valpass?>" 
                 value="<?php echo ISSET($_POST["pass1"])?$_POST["pass1"]:"" ?>">
              <div id="validationServer05Feedback" class="invalid-feedback">
                      <ul>
                          <li>Este campo es obligatorio</li>
                          <li>Longitud mínima de 8 caracteres</li>
                      </ul>                 
              </div>
            </div>


            <div class="col mt-3">
                * Confirmar contraseña
                <input type="password" name = "pass2" required minlength = "8" maxlength = "50" id="txtpass2" class="form-control <?=$valpass2?>" 
                 value="<?php echo ISSET($_POST["pass2"])?$_POST["pass2"]:"" ?>">
              <div id="validationServer06Feedback" class="invalid-feedback">
                      <ul>
                            <li>Este campo es obligatorio</li>
                            <li>Las contraseñas no coinciden</li>
                      </ul>                 
              </div>
            </div>
        </div>

        <div class="botones">
            <button id="btnGuardar" class="btn" style="background-color: #071a83; color: white; width: 300px;">Guardar</button>
            <!-- <button type="reset" id="btnLimpiar" class="btn btn-warning">Limpiar</button>
            <button id="btnVolver" class="btn btn-dark">Volver</button> -->
        </div>
        
    </form>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>