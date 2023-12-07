<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Couch</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilosRegistroCoach.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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
              <img src="../src/CCUP.png" alt="Bootstrap" width="50" height="35" style="background-color: #071a83;" role="img">
            </a>
          </div>
      </nav>
        <label class="navbar-brand">Coding Cup</label>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.html">Inicio</a>
            </li>
          </ul>
        </div>
      </div>
  </nav>
      <pre><?php

        require_once('../../datos/daoCou.php');
        require_once('couUtil.php');
        // var_dump($_POST);
        ?></pre>

  <form method="post" class="mx-auto p-2 mt-3"  style="width: 50%;" novalidate class="needs-validation">   <!-- class="mx-auto p-2 needs-validation mt-3" novalidate -->
        <h1>Registrar Coach</h1>
        <div class="mt-3">
            * Nombre completo: <span id="spnClave"></span>
        </div>
        
        <div>
            <input type="text" id="txtNombre" class="form-control <?= $valnombreCompleto ?>"
             placeholder="Nombre Completo" required
            name="nombreCompleto" value="<?= $cou->nombreCompleto ?>">

            <div class="invalid-feedback">
          <ul>
              <li>El nombre completo es obligatorio</li>
              <li>Debe contener solo caracteres alfabéticos</li>
              <li>Debe tener entre 2 y 150</li>
          </ul>
        </div>
        </div>
        


        <div class="mt-3">* Correo:</div>
        <div class="input-group ">
        <!-- pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"   -->
            <input type="email" class="form-control <?= $valusername ?>" placeholder="Username" aria-label="Username" required name="username"
            value="<?= $cou->username ?>">
            <!-- <span class="input-group-text">@</span> -->
            <!-- <input type="text" class="form-control" placeholder="Server" aria-label="Server" required name="dominio" -->
            <!-- value=""> -->
            <div class="invalid-feedback">
                <ul>
                    <li>El correo electrónico es obligatorio</li>
                    <li>Debe tener un formato válido</li>
                </ul>
            </div>
          </div>        

        <div class="row mt-3">
            <div class="col mt-3">
                * Contraseña
                <input type="password" id="txtpass1" class="form-control <?= $valpass ?>" required name="pass"
                value="<?= $cou->pass ?>">

                <div class="invalid-feedback">
                        <ul>
                            <li>La contraseña es requerida</li>
                            <li>Contraseñas deben coincidir</li>
                            <li>Debe tener entre 6 y 18 caracteres</li>
                        </ul>
                    </div>
            </div>
            

            <div class="col mt-3">
                * Confirmar contraseña
                <input type="password" id="txtpass2" class="form-control <?= $valpass ?>" required  name="pass2"
                value="<?= ISSET($_POST["pass2"])?$_POST["pass2"]:"" ?>">

                <div class="invalid-feedback">
                        <ul>
                            <li>La contraseña es requerida</li>
                            <li>Contraseñas deben coincidir</li>
                            <li>Debe tener entre 6 y 18 caracteres</li>
                        </ul>
                    </div>
            </div>
            
        </div>

        

        <div class="mt-3">Institución: </div>
        <div class="col mt-3">
                <input type="text" id="txtinstitucion" class="form-control <?= $valinstitucion ?>" required placeholder="Institucion" name="institucion"
                value="<?= $cou->institucion ?>" >
                <div class="invalid-feedback">
                        <ul>
                            <li>La intitucion es requerida</li>
                            <li>Debe ser el nombre de la institucion</li>
                        </ul>
                    </div>
        </div>
        <!-- <div class="form-floating mt-1  ">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="institucion">
              <option selected>Cbtis 217</option>
              <option value="Conalep 128" value="<?= ISSET($_POST["institucion"])?$_POST["institucion"]:"" ?>">Conalep 128</option>
              <option value="Cecyteg">Cecyteg</option>
              <option value="Itsur">ITSUR</option>
            </select>
            <label for="floatingSelect">Selecciona tu Institución</label>
          </div> -->

        <div class="botones">
            <button formaction="registroCoach.php" type="submit" id="btnGuardar" class="btn" style="background-color: #071a83; color: white; width: 300px;">Guardar</button>
        <!-- <button type="reset" id="btnLimpiar" class="btn btn-warning">Limpiar</button> -->
            <button id="btnVolver" class="btn btn-dark" style="width: 300px;">Volver</button>
        </div>
        
    </form>


    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/coach.js"></script>
  </body>
</html>