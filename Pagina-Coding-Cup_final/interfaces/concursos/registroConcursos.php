<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Couch</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
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
  <bodyds>
  <?php
    session_start();

    if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != 1) {
        header("Location: ../index.html");
        exit(); 
      } 
      require_once('../../datos/daoConcurso.php');
      require_once('concursoUtil.php');
  ?>
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
                <a class="nav-link active" aria-current="page" href="Concursos.php">Registros de Concursos</a>
              </li>
          </ul>
        </div>
        <div>
            <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 60px;">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <?=ISSET($_SESSION["nombre"])?$_SESSION["nombre"]:""?>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="../cerrarSesion.php">Cerrar Sesión</a></li>
                    </ul>
                  </li>
            </ul>
          </div>
      </div>
  </nav>

    <form action="" class="mx-auto p-2 needs-validation mt-3" novalidate style="width: 50%;" method="post" enctype="multipart/form-data">

        <!-- editar -->
        <input type="hidden" name="operation" value="<?php echo isset($_POST['id']) && is_numeric($_POST['id']) ? 'edit' : 'add'; ?>">
        <input type="hidden" name="iden" value="<?= $concurso->id ?>">
        <!--  -->

        <h1>Registrar Concurso</h1>
        <div class="mb-3">
            <label for="txtNombre" class="form-label">* Nombre del concurso</label>
            <input type="text" name="Nombre" id="txtNombre" required minlength="5" maxlength="50" class="form-control <?=$valNombre?>" 
                value="<?= $concurso->nombre ?>">
            <div id="validationServer01Feedback" class="invalid-feedback">
                <ul>
                    <li>El nombre de equipo es obligatorio</li>
                    <li>Longitud mínima 3 caracteres</li>
                    <li>Longitud máxima 50 caracteres</li>
                </ul>                 
            </div>
        </div>
        
        <div class="mb-3">
                <label for="txtNombre" class="form-label">* Fecha de apertura de inscripción:</label>
                <input type="date" id="txtFechaAp" name="FechaInicio" class="form-control <?=$valFechaInicio?>" placeholder="Fecha de apertura" required value="<?= $concurso->fechaInicio->format('Y-m-d') ?>">
                <div id="validationServer01Feedback" class="invalid-feedback">
                    <ul>
                      <li>Fecha de inico obligatoria</li>
                    </ul>                 
                </div>
        </div>
        
        <div class="mb-3">
                <label for="txtNombre" class="form-label">* Fecha de apertura de inscripción:</label>
                <input type="date" id="txtFechaCier" name="FechaLimite" class="form-control <?=$valFechaLimite?>" placeholder="Fecha de cierre" required value="<?= $concurso->fechaLimite->format('Y-m-d')  ?>">
                <div id="validationServer01Feedback" class="invalid-feedback">
                    <ul>
                      <li>Fecha de limite obligatoria</li>
                    </ul>                 
                </div>
        </div>

        <div class="botones">
            <button id="btnGuardar" class="btn" style="background-color: #071a83; color: white; width: 300px;">Guardar</button>
            <!-- <button type="reset" id="btnLimpiar" class="btn btn-warning">Limpiar</button> -->
            <button type="button" id="btnVolver" class="btn btn-secondary" style="width: 300px;">Cancelar</button>
        </div>
        
    </form>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/registroConcursos.js"></script>
  </body>
</html>